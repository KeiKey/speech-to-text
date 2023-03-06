<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'brand' => ['nullable', 'exists:brands,id'],
            'size'  => ['nullable', 'exists:vehicles,size'],
            'model' => ['nullable', 'exists:vehicles,model'],
            'year'  => ['nullable', 'exists:vehicles,year']
        ];
    }
}
