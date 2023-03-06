<?php

namespace App\Console\Commands;

use App\Enums\ImportStatus;
use App\Enums\ImportType;
use App\Events\ImportCreated;
use App\Models\Import\Import as ImportModel;
use App\Models\User\User;
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
            'uploader_id' => User::query()->inRandomOrder()->first()->id,
            'file_name'   => 'import-files/vehicles.xlsx',
            'import_type' => ImportType::VEHICLE,
            'status'      => ImportStatus::default()
        ]);
        event(new ImportCreated($vehicleImportModel));

        /** @var ImportModel $partImportModel */
        $partImportModel = ImportModel::query()->create([
            'uploader_id' => User::query()->inRandomOrder()->first()->id,
            'file_name'   => 'import-files/parts.csv',
            'import_type' => ImportType::PART,
            'status'      => ImportStatus::default()
        ]);
        event(new ImportCreated($partImportModel));
    }
}
