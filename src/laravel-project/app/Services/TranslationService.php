<?php

namespace App\Services;

use App\Models\Translation;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use KeiKey\WhisperUtils\Facades\Whisper;
use KeiKey\WhisperUtils\Services\CreateTranslationPayload;

class TranslationService
{
    /**
     * Create a new Translation model and translate the contents in OpenAi.
     *
     * @param array $data
     * @param User $creator
     * @return Translation
     */
    public function createTranslation(array $data, User $creator): Translation
    {
        return DB::transaction(function () use ($data, $creator){
            /** @var UploadedFile $file */
            $file = $data['file'];
            $filePath = $file->store('import-files');
            $fileName = $file->getClientOriginalName();

            /** @var Translation $translation */
            $translation = Translation::query()->create([
                'user_id'         => $creator->id,
                'name'            => $data['name'],
                'file_name'       => $fileName,
                'file_path'       => $filePath,
                'prompt'          => $data['prompt'],
                'response_format' => $data['response_format'],
                'temperature'     => $data['temperature'],
            ]);

            $payload = new CreateTranslationPayload(
                file_get_contents($file),
                $fileName,
                Config::get('whisper.tts_model', 'whisper-1'),
                $data['prompt'],
                $data['response_format'],
                $data['temperature'],
            );

            $response = Whisper::createTranslation($payload);

            $translation->update([
                'translation' => json_encode($response->getData())
            ]);

            return $translation;
        });
    }

    /**
     * Delete a Translation only if it's your resource.
     *
     * @param Translation $translation
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function deleteTranslation(Translation $translation, User $user): void
    {
        if ($user->id !== $translation->user_id) {
            throw new Exception('You can`t delete resources that don`t belong to you~');
        }

        $translation->delete();
    }
}
