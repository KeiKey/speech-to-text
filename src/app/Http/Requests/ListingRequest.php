<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
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
            'title'          => ['required', 'max:255'],
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
