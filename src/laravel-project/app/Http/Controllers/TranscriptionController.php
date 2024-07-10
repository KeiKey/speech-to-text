<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranscriptionStoreRequest;
use App\Models\Transcription;
use App\Models\Translation;
use App\Services\TranscriptionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use KeiKey\WhisperUtils\Enums\Languages;
use KeiKey\WhisperUtils\Enums\ResponseFormat;
use KeiKey\WhisperUtils\Enums\TimestampGranularity;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TranscriptionController extends Controller
{
    public function __construct(
        private readonly TranscriptionService $transcriptionService
    ) { }

    /**
     * Display a listing of Transcriptions.
     *
     * @return View
     */
    public function index(): View
    {
        return view('transcriptions.index', [
            'transcriptions' => Transcription::all()
        ]);
    }

    /**
     * Show the form for creating a new Transcription.
     *
     * @return View
     */
    public function create(): View
    {
        return view('transcriptions.create', [
            'languages'              => Languages::toArray(),
            'responseFormats'        => ResponseFormat::toArray(),
            'timestampGranularities' => TimestampGranularity::toArray(),
        ]);
    }

    /**
     * Store a newly created Transcription.
     *
     * @param TranscriptionStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TranscriptionStoreRequest $request): RedirectResponse
    {
        $this->transcriptionService->createTranscription($request->validated(), $request->user());

        return redirect()->route('transcriptions.index');
    }

    /**
     * Remove the specified Transcription.
     *
     * @param Transcription $transcription
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Transcription $transcription): RedirectResponse
    {
        $this->transcriptionService->deleteTranslation($transcription, request()->user());

        return redirect()->route('transcriptions.index');
    }

    /**
     * @param Transcription $transcription
     * @return StreamedResponse
     */
    public function download(Transcription $transcription): StreamedResponse
    {
        $fileName = 'transcription_' . $transcription->name . '.json';

        Storage::disk('local')->put($fileName, $transcription->transcription);

        return Storage::download($fileName);
    }

    /**
     * @param Transcription $transcription
     * @return StreamedResponse
     */
    public function downloadFile(Transcription $transcription): StreamedResponse
    {
        $fileName = 'transcription_' . $transcription->name . '.json';

        Storage::disk('local')->put($fileName, $transcription->transcription);

        return Storage::download($fileName);
    }
}
