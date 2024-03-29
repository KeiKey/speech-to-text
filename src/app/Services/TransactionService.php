<?php

namespace App\Services;

use App\Events\TransactionCreated;
use App\Models\Company\Company;
use App\Models\Individual\Individual;
use App\Models\Transaction\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * Create a new Transaction.
     *
     * @param array $data
     * @return Transaction
     */
    public function createTransaction(array $data): Transaction
    {
        $transaction = DB::transaction(function () use ($data){
            $transaction = new Transaction();
            $transaction->amount = $data['amount'];
            $transaction->description = $data['description'];
            $transaction->currency = $data['currency'];
            $transaction->status = $data['status'];
            $transaction->transaction_date = $data['transaction_date'];

            $issuer = Individual::query()->byUUID($data['issuer'])->first()
                ?: Company::query()->byUUID($data['issuer'])->first();

            $issuer->transactions()->save($transaction);

            return $transaction;
        });

        TransactionCreated::dispatch($transaction);

        return $transaction;
    }

    /**
     * Update an existing Transaction.
     *
     * @param Transaction $transaction
     * @param array $data
     * @return Transaction
     */
    public function updateTransaction(Transaction $transaction, array $data): Transaction
    {
        $fieldsToBeUpdated = [];

        if (isset($data['description'])) {
            $fieldsToBeUpdated['description'] = $data['description'];
        }
        if (isset($data['status'])) {
            $fieldsToBeUpdated['status'] = $data['status'];
        }

        $transaction->update($fieldsToBeUpdated);

        return $transaction;
    }

    /**
     * Delete a Transaction.
     *
     * @param Transaction $transaction
     * @return Transaction
     */
    public function deleteTransaction(Transaction $transaction): Transaction
    {

    }
}
