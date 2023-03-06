<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use App\Factories\Import\ImportFactory;
use App\Events\ImportCreated;
use Illuminate\Bus\Queueable;

class ProcessImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Handle the event.
     *
     * @param  ImportCreated  $event
     * @return void
     */
    public function handle(ImportCreated $event): void
    {
        $import = $event->import;

        ImportFactory::factory($import)->import()->notifyImportResult();
    }
}
