<?php

namespace App\Factories\Import;

use App\Enums\ImportStatus;
use App\Models\Import\Import as ImportModel;

abstract class BaseImport
{
    public function __construct(public ImportModel $importModel)
    {
        $this->importModel->update(['status' => ImportStatus::PROCESSING]);
    }

    abstract public function import(): self;

    abstract public function validateRow(array $rowData): array;

    /**
     * Notify the user that created the Import about the result of the import.
     *
     * @return $this
     */
    public function notifyImportResult(): self
    {
        //todo: implement notification with the result to the importer user

        return $this;
    }
}
