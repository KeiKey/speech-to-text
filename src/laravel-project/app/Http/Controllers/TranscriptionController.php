<?php

namespace App\Http\Controllers;

use App\Models\Transcription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use KeiKey\WhisperUtils\Enums\Languages;
use KeiKey\WhisperUtils\Enums\ResponseFormat;
use KeiKey\WhisperUtils\Enums\TimestampGranularity;

class TranscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transcriptions.index', [
            'transcriptions' => Transcription::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transcriptions.create', [
            'languages'              => Languages::cases(),
            'responseFormats'        => ResponseFormat::cases(),
            'timestampGranularities' => TimestampGranularity::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName = $request->file('file')->store('import-files');

        DB::transaction(function () use ($request, $fileName){

            Transcription::query()->create([
                'user_id'       => auth()->id(),
                'name'          => $request->get('name'),
                'file_name'     => $fileName,
                'Transcription' => '',
            ]);
        });

        return view('transcriptions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transcription  $transcription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transcription $transcription)
    {
        return view('transcriptions.index');
    }
}
