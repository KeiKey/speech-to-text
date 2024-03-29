<?php

use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\IndividualController;
use App\Http\Controllers\Api\V1\TransactionController;
use App\Http\Controllers\Api\PassportAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

// V1 API Routes
Route::group(['prefix' => 'v1', 'middleware' => ['auth:api']], function () {
    Route::apiResource('transactions', TransactionController::class, ['as' => 'api.v1'])->scoped(['transaction' => 'uuid']);
    Route::apiResource('companies', CompanyController::class, ['as' => 'api.v1'])->scoped(['company' => 'uuid']);
    Route::apiResource('individuals', IndividualController::class, ['as' => 'api.v1'])->scoped(['individual' => 'uuid']);
});
