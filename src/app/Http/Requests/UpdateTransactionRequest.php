<?php

namespace App\Http\Requests;

use App\Enums\TransactionStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="UpdateTransactionRequest",
 *     title="UpdateTransactionRequest",
 *     @OA\Property(property="description", type="string", example="example"),
 *     @OA\Property(property="status", type="string", example="example")
 * )
 */
class UpdateTransactionRequest extends FormRequest
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
            'description' => ['nullable'],
            'status'      => ['nullable', Rule::in(TransactionStatusEnum::toArray())],
        ];
    }
}
