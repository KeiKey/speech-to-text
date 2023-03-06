<?php

namespace App\Factories\Import;

use App\Enums\ImportType;
use App\Models\Import\Import as ImportModel;

class ImportFactory
{
    /**
     * Generate the dedicated Import.
     *
     * @param ImportModel $importModel
     * @return BaseImport
     */
    public static function factory(ImportModel $importModel): BaseImport
    {
        return match ($importModel->import_type) {
            ImportType::PART => new PartImport($importModel),
            default          => new VehicleImport($importModel)
        };
    }
}
