<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranscriptionStoreRequest;
use App\Models\Transcription;
use App\Services\TranscriptionService;
use Illuminate\Contracts\View\View;
use KeiKey\WhisperUtils\Enums\Languages;
use KeiKey\WhisperUtils\Enums\ResponseFormat;
use KeiKey\WhisperUtils\Enums\TimestampGranularity;

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
     * @return View
     */
    public function store(TranscriptionStoreRequest $request): View
    {
        $this->transcriptionService->createTranscription($request->validated(), $request->user());

        return view('transcriptions.index');
    }

    /**
     * Remove the specified Transcription.
     *
     * @param Transcription $transcription
     * @return View
     */
    public function destroy(Transcription $transcription): View
    {
        $this->transcriptionService->deleteTranslation($transcription, request()->user());

        return view('transcriptions.index');
    }
}
