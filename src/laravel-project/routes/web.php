<?php

use App\Http\Controllers\TranscriptionController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect(\route('translations.index'));
    });

    Route::resource('translations', TranslationController::class)->except(['edit', 'update', 'show']);
    Route::get('translations/download/{translation}', [TranslationController::class, 'download'])->name('translations.download');
    Route::get('translations/file_download/{translation}', [TranslationController::class, 'downloadFile'])->name('translations.file_download');

    Route::resource('transcriptions', TranscriptionController::class)->except(['edit', 'update', 'show']);
    Route::get('transcriptions/download/{transcription}', [TranscriptionController::class, 'download'])->name('transcriptions.download');
    Route::get('transcriptions/file_download/{transcription}', [TranscriptionController::class, 'downloadFile'])->name('transcriptions.file_download');
});
