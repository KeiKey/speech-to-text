<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateListingRequest",
 *     title="CreateListingRequest",
 *     @OA\Property(property="inspector_uuid", type="string", example="389ffffe-b89c-47b6-bc63-cf5fd2a88218"),
 *     @OA\Property(property="title", type="string", example="title"),
 *     @OA\Property(property="description", type="string", example="description"),
 *     @OA\Property(property="address", type="string", example="test address"),
 *     @OA\Property(property="start", type="string", example="2024-04-04 19:07"),
 *     @OA\Property(property="end", type="string", example="2024-04-04 19:07"),
 *     @OA\Property(property="contact_name", type="string", example="Contact name"),
 *     @OA\Property(property="contact_phone", type="string", example="Contact phone"),
 *     @OA\Property(property="contact_email", type="string", example="Contact email"),
 * )
 */
class CreateListingRequest extends FormRequest
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
            'title'          => ['required', 'max:45'],
            'description'    => ['required', 'max:255'],
            'address'        => ['required', 'max:45'],
            'start'          => ['required', 'date_format:Y-m-d H:i'],
            'end'            => ['required', 'date_format:Y-m-d H:i'],
            'contact_name'   => ['required', 'max:255'],
            'contact_phone'  => ['required', 'max:255'],
            'contact_email'  => ['required', 'max:255']
        ];
    }
}
