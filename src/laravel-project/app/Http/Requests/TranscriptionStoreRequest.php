<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use KeiKey\WhisperUtils\Enums\Languages;
use KeiKey\WhisperUtils\Enums\ResponseFormat;
use KeiKey\WhisperUtils\Enums\TimestampGranularity;

class TranscriptionStoreRequest extends FormRequest
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
            'name'                  => ['required'],
            'file'                  => ['required', 'mimes:m4a,mp3,webm,mp4,mpga,wav,mpeg'],
            'prompt'                => ['nullable', 'max:255'],
            'response_format'       => ['nullable', Rule::in(ResponseFormat::toArray())],
            'temperature'           => ['nullable'],
            'language'              => [Rule::in(Languages::toArray())],
            'timestamp_granularity' => ['nullable', Rule::in(TimestampGranularity::toArray())],
        ];
    }

    protected function prepareForValidation()
    {
        if (!isset($this->response_format)) {
            $this->merge([
                'response_format' => ResponseFormat::default()
            ]);
        }

        if (!isset($this->temperature)) {
            $this->merge([
                'temperature' => 0
            ]);
        }

        if (!isset($this->language)) {
            $this->merge([
                'language' => Languages::default()
            ]);
        }

        if (!isset($this->timestamp_granularity)) {
            $this->merge([
                'timestamp_granularity' => TimestampGranularity::default()
            ]);
        }
    }
}
