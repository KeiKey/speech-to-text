<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Individual",
 *     title="Individual",
 *     @OA\Property(property="uuid", type="string", example="389ffffe-b89c-47b6-bc63-cf5fd2a88218"),
 *     @OA\Property(property="name", type="string", example="example"),
 *     @OA\Property(property="email", type="string", example="example"),
 *     @OA\Property(property="address", type="string", example="example"),
 *     @OA\Property(property="phone_number", type="string", example="example"),
 *     @OA\Property(property="vat_number", type="string", example="example"),
 * )
 */
class IndividualResource extends JsonResource
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
            'uuid'         => $this->uuid,
            'name'         => $this->name,
            'email'        => $this->email,
            'address'      => $this->address,
            'phone_number' => $this->phone_number,
            'vat_number'   => $this->vat_number,
        ];
    }
}
