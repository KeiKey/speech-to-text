<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslationStoreRequest;
use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use KeiKey\WhisperUtils\Enums\ResponseFormat;

class TranslationController extends Controller
{
    public function __construct(
        private readonly TranslationService $translationService
    ) { }

    /**
     * Display a listing of Translations.
     *
     * @return View
     */
    public function index(): View
    {
        return view('translations.index', [
            'translations' => request()->user()->translations
        ]);
    }

    /**
     * Show the form for creating a new Translation.
     *
     * @return View
     */
    public function create(): View
    {
        return view('translations.create', [
            'responseFormats' => ResponseFormat::toArray(),
        ]);
    }

    /**
     * Store a newly created Translation.
     *
     * @param TranslationStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TranslationStoreRequest $request): RedirectResponse
    {
        $translation = $this->translationService->createTranslation($request->validated(), $request->user());

        return redirect()->route('translations.index');
    }

    /**
     * Remove the specified Translation.
     *
     * @param Translation $translation
     * @return RedirectResponse
     */
    public function destroy(Translation $translation): RedirectResponse
    {
        $this->translationService->deleteTranslation($translation, request()->user());

        return redirect()->route('translations.index');
    }

    public function download(Translation $translation)
    {
        $fileName = 'translation_' . $translation->name . '.json';

        Storage::disk('local')->put($fileName, $translation->translation);

        return Storage::download($fileName);
    }
}
