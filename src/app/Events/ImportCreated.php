<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Import\Import;

class ImportCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public Import $import)
    {

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return null
     */
    public function broadcastOn()
    {
        return null;
    }
}
