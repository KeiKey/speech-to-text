<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateListingRequest",
 *     title="UpdateListingRequest",
 *     @OA\Property(property="name", type="string", example="example"),
 *     @OA\Property(property="email", type="string", example="example"),
 *     @OA\Property(property="address", type="string", example="example"),
 *     @OA\Property(property="vat_number", type="string", example="example"),
 *     @OA\Property(property="contact_name", type="string", example="example"),
 *     @OA\Property(property="contact_phone", type="string", example="example"),
 *     @OA\Property(property="contact_email", type="string", example="example"),
 * )
 */
class UpdateListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'inspector_uuid' => ['nullable', 'exists:users,uuid'],
            'title'          => ['nullable', 'max:45'],
            'description'    => ['nullable', 'max:255'],
            'address'        => ['nullable', 'max:45'],
            'start'          => ['nullable', 'date_format:Y-m-d H:i'],
            'end'            => ['nullable', 'date_format:Y-m-d H:i'],
            'contact_name'   => ['nullable', 'max:255'],
            'contact_phone'  => ['nullable', 'max:255'],
            'contact_email'  => ['nullable', 'max:255']
        ];
    }
}
