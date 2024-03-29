<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Transaction",
 *     title="Transaction",
 *     @OA\Property(property="uuid", type="string", example="389ffffe-b89c-47b6-bc63-cf5fd2a88218"),
 *     @OA\Property(property="amount", type="string", example="example"),
 *     @OA\Property(property="description", type="string", example="example"),
 *     @OA\Property(property="currency", type="string", example="example"),
 *     @OA\Property(property="status", type="string", example="example"),
 *     @OA\Property(property="issuer", type="string", example="example"),
 *     @OA\Property(property="transaction_date", type="string", example="example"),
 * )
 */
class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'uuid'              => $this->uuid,
            'amount'            => $this->amount,
            'description'       => $this->description,
            'currency'          => $this->currency,
            'status'            => $this->status,
            'issuer'            => $this->issuer,
            'transaction_date'  => $this->transaction_date,
        ];
    }
}
