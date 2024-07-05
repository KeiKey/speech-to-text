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
    Route::resource('transcriptions', TranscriptionController::class)->except(['edit', 'update', 'show']);
});
