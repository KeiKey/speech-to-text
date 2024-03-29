<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Company",
 *     title="Company",
 *     @OA\Property(property="uuid", type="string", example="389ffffe-b89c-47b6-bc63-cf5fd2a88218"),
 *     @OA\Property(property="name", type="string", example="example"),
 *     @OA\Property(property="email", type="string", example="example"),
 *     @OA\Property(property="address", type="string", example="example"),
 *     @OA\Property(property="vat_number", type="string", example="example"),
 *     @OA\Property(property="contact_name", type="string", example="example"),
 *     @OA\Property(property="contact_phone", type="string", example="example"),
 *     @OA\Property(property="contact_email", type="string", example="example"),
 * )
 */
class CompanyResource extends JsonResource
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
            'uuid'          => $this->uuid,
            'name'          => $this->name,
            'email'         => $this->email,
            'address'       => $this->address,
            'vat_number'    => $this->vat_number,
            'contact_name'  => $this->contact_name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
        ];
    }
}
