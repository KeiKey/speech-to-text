<?php

namespace App\Listeners;

use App\Events\TransactionCreated;

class SendTransactionIssuerConfirmation
{
    /**
     * Handle the event.
     *
     * @param TransactionCreated $event
     */
    public function handle(TransactionCreated $event): void
    {

    }
}
