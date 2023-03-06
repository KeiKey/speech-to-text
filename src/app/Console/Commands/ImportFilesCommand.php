<?php

namespace App\Console\Commands;

use App\Enums\ImportStatus;
use App\Enums\ImportType;
use App\Events\ImportCreated;
use App\Models\Import\Import as ImportModel;
use Illuminate\Console\Command;

class ImportFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Files from Storage';

    public function handle()
    {
        /** @var ImportModel $vehicleImportModel */
        $vehicleImportModel = ImportModel::query()->create([
            'file_name'   => 'vehicles.xlsx',
            'import_type' => ImportType::VEHICLE,
            'status'      => ImportStatus::default()
        ]);
        event(new ImportCreated($vehicleImportModel));

        /** @var ImportModel $partImportModel */
        $partImportModel = ImportModel::query()->create([
            'file_name'   => 'parts.csv',
            'import_type' => ImportType::PART,
            'status'      => ImportStatus::default()
        ]);
        event(new ImportCreated($partImportModel));
    }
}
