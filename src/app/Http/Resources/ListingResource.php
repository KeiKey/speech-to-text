<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Listings",
 *     title="Listings",
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
class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid'          => $this->uuid,
            'title'         => $this->title,
            'description'   => $this->description,
            'address'       => $this->address,
            'start'         => $this->start->format('Y-m-d H:i'),
            'end'           => $this->end->format('Y-m-d H:i'),
            'contact_name'  => $this->contact_name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'creator'       => new UserResource($this->creator),
            'inspector'     => $this->inspector_id ? new UserResource($this->inspector) : null,
        ];
    }
}
