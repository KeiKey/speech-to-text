<?php

namespace App\Http\Requests;

use App\Enums\TransactionStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="IndividualRequest",
 *     title="IndividualRequest",
 *     @OA\Property(property="name", type="string", example="example"),
 *     @OA\Property(property="email", type="string", example="example"),
 *     @OA\Property(property="address", type="string", example="example"),
 *     @OA\Property(property="phone_number", type="string", example="example"),
 *     @OA\Property(property="vat_number", type="string", example="example"),
 * )
 */
class IndividualRequest extends FormRequest
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
            'email'         => ['required', 'max:255', 'unique:individuals,email'],
            'address'       => ['required', 'max:255'],
            'phone_number'  => ['required', 'max:255'],
            'vat_number'    => ['required', 'max:255'],
        ];
    }
}
