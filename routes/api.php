<?php

use App\Http\Controllers\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {

    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
    // });

    Route::middleware('auth:sanctum')->prefix('user')->group(function () {
        Route::post('register', [ApiAuthController::class, 'Register']);
    });


    Route::post("login", [ApiAuthController::class, 'login']);
    Route::post('reset', [ApiAuthController::class, 'reset']);
    Route::post('new-pw', [ApiAuthController::class, 'newPw']);
});
