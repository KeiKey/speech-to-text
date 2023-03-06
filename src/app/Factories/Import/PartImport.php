<?php

namespace App\Factories\Import;

use App\Enums\ImportStatus;
use App\Imports\PartsImport;
use App\Models\Brand\Brand;
use App\Models\Part\Part;
use App\Models\Vehicle\Vehicle;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class PartImport extends BaseImport
{
    /**
     * Implementation to import an Import of type Part.
     *
     * @return self
     */
    public function import(): self
    {
        $partsData = Excel::toArray(app(PartsImport::class), Storage::path("import-files/{$this->importModel->file_name}"))[0];
        $result = [];

        foreach ($partsData as $partData) {
            try {
                DB::beginTransaction();
                $partData = $this->validateRow($partData);

                /** @var Part $part */
                $part = Part::query()->updateOrCreate(['part_code' => $partData['id']], [
                    'name'   => $partData['name'],
                    'active' => $partData['active']
                ]);

                Vehicle::query()
                    ->whereIn('vehicle_code', $partData['vehicle_ids'])
                    ->pluck('id')
                    ->whenEmpty(
                        fn() => $part->vehicles()->detach(),
                        fn($vehicleIds) => $part->vehicles()->sync($vehicleIds)
                    );

                DB::commit();

                $result[$partData['id']] = 'Part imported.';
            } catch (Exception $exception) {
                $result[$partData['id']] = $exception->getMessage();

                DB::rollBack();
            }
        }

        $this->importModel->update([
            'status' => ImportStatus::PROCESSED,
            'result' => json_encode($result)
        ]);

        return $this;
    }

    /**
     * Validate each Part row data and return the validated data.
     *
     * @throws Exception
     */
    public function validateRow(array $rowData): array
    {
        $rowData['vehicle_ids'] = $rowData['vehicle_ids'] ? explode(',', $rowData['vehicle_ids']) : [];

        $validator = Validator::make($rowData, [
            'id'            => ['required'],
            'name'          => ['required', 'string', 'max:255'],
            'active'        => ['required', 'boolean'],
            'vehicle_ids'   => ['array'],
            'vehicle_ids.*' => ['exists:vehicles,vehicle_code']
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->toJson());
        }

        return $validator->validated();
    }
}
