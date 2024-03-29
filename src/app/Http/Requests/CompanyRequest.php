<?php

namespace App\Http\Requests;

use App\Enums\TransactionStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="CompanyRequest",
 *     title="CompanyRequest",
 *     @OA\Property(property="name", type="string", example="example"),
 *     @OA\Property(property="email", type="string", example="example"),
 *     @OA\Property(property="address", type="string", example="example"),
 *     @OA\Property(property="vat_number", type="string", example="example"),
 *     @OA\Property(property="contact_name", type="string", example="example"),
 *     @OA\Property(property="contact_phone", type="string", example="example"),
 *     @OA\Property(property="contact_email", type="string", example="example"),
 * )
 */
class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'          => ['required', 'max:45'],
            'email'         => ['required', 'max:255', 'unique:companies,email'],
            'address'       => ['required', 'max:255'],
            'vat_number'    => ['required', 'max:255'],
            'contact_name'  => ['required', 'max:45'],
            'contact_phone' => ['required', 'max:255'],
            'contact_email' => ['required', 'max:255', 'unique:companies,contact_email'],
        ];
    }
}
