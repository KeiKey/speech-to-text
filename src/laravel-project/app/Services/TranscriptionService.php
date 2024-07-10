<?php

namespace App\Services;

use App\Models\Transcription;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use KeiKey\WhisperUtils\Facades\Whisper;
use KeiKey\WhisperUtils\Services\CreateTranscriptionPayload;

class TranscriptionService
{
    public function createTranscription(array $data, User $creator)
    {
        return DB::transaction(function () use ($data, $creator){
            /** @var UploadedFile $file */
            $file = $data['file'];
            $filePath = $file->store('import-files');
            $fileName = $file->getClientOriginalName();

            /** @var Transcription $translation */
            $translation = Transcription::query()->create([
                'user_id'               => $creator->id,
                'name'                  => $data['name'],
                'file_name'             => $fileName,
                'file_path'             => $filePath,
                'prompt'                => $data['prompt'],
                'response_format'       => $data['response_format'],
                'temperature'           => $data['temperature'],
                'language'              => $data['language'],
                'timestamp_granularity' => $data['timestamp_granularity']
            ]);

            $payload = new CreateTranscriptionPayload(
                file_get_contents($file),
                $fileName,
                Config::get('whisper.tts_model', 'whisper-1'),
                $data['language'],
                $data['prompt'],
                $data['response_format'],
                $data['temperature'],
                $data['timestamp_granularity'],
            );

            $response = Whisper::createTranscription($payload);

            $translation->update([
                'transcription' => json_encode($response->getData())
            ]);

            return $translation;
        });
    }

    /**
     * Delete a Transcription only if it's your resource.
     *
     * @param Transcription $transcription
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function deleteTranslation(Transcription $transcription, User $user): void
    {
        if ($user->id !== $transcription->user_id) {
            throw new Exception('You can`t delete resources that don`t belong to you~');
        }

        $transcription->delete();
    }
}
