<?php

namespace App\Factories\Import;

use App\Enums\ImportStatus;
use App\Models\Brand\Brand;
use App\Models\Vehicle\Vehicle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Imports\VehiclesImport;
use Exception;

class VehicleImport extends BaseImport
{
    /**
     * Implementation to import an Import of type Vehicle.
     *
     * @return self
     */
    public function import(): self
    {
        $vehiclesData = Excel::toArray(app(VehiclesImport::class), Storage::path("import-files/{$this->importModel->file_name}"))[0];
        $result = [];

        foreach ($vehiclesData as $vehicleData) {
            try {
                DB::beginTransaction();
                $vehicleData = $this->validateRow($vehicleData);

                /** @var Brand $brand */
                $brand = Brand::query()->firstOrCreate(['name' => $vehicleData['bike_producer']]);

                Vehicle::query()->updateOrCreate(['vehicle_code' => $vehicleData['vehicle_id']], [
                    'brand_id'           => $brand->id,
                    'vehicle_code'       => $vehicleData['vehicle_id'],
                    'series'             => $vehicleData['series'],
                    'size'               => $vehicleData['size'] ?: null,
                    'configuration'      => $vehicleData['configuration'] ?: null,
                    'model'              => $vehicleData['bike_model'],
                    'sales_name'         => $vehicleData['sales_name'] ?: null,
                    'year'               => $vehicleData['year'],
                    'cylinder'           => $vehicleData['cylinder'] ?: null,
                    'type_of_drive'      => $vehicleData['type_of_drive'],
                    'engine_output'      => $vehicleData['engine_output'] ?: null,
                    'country'            => $vehicleData['country'],
                    'primary_category'   => $vehicleData['category_1'],
                    'secondary_category' => $vehicleData['category_2']
                ]);

                DB::commit();

                $result[$vehicleData['vehicle_id']] = 'Vehicle imported.';
            } catch (Exception $exception) {
                $result[$vehicleData['vehicle_id']] = $exception->getMessage();

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
     * Validate each Vehicle row data and return the validated data.
     *
     * @throws Exception
     */
    public function validateRow(array $rowData): array
    {
        $validator = Validator::make($rowData, [
            'vehicle_id'    => ['required'],
            'bike_producer' => ['required', 'string', 'max:255'],
            'series'        => ['required', 'string', 'max:255'],
            'size'          => ['nullable', 'integer'],
            'configuration' => ['nullable', 'string', 'max:255'],
            'bike_model'    => ['required', 'string', 'max:255'],
            'sales_name'    => ['nullable', 'string', 'max:255'],
            'year'          => ['required', 'string', 'max:255'],
            'cylinder'      => ['nullable', 'integer'],
            'type_of_drive' => ['required', 'string', 'max:255'],
            'engine_output' => ['nullable', 'string', 'max:255'],
            'country'       => ['required', 'string', 'max:255'],
            'category_1'    => ['required', 'string', 'max:255'],
            'category_2'    => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors()->toJson());
        }

        return $validator->validated();
    }
}
