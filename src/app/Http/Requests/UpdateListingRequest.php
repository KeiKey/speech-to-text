<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
