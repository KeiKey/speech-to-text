<?php

use App\Http\Controllers\Api\V1\ListingController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassportAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

// V1 API Routes
Route::group(['prefix' => 'v1', 'middleware' => ['auth:api']], function () {
    Route::get('users', [UserController::class, 'index'])->name('api.v1.users.index');
    Route::get('users/{user:uuid}', [UserController::class, 'show'])->name('api.v1.users.show');

    Route::apiResource('listings', ListingController::class, ['as' => 'api.v1'])->scoped(['listing' => 'uuid']);
});
