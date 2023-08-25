<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VouncherController;
use App\Http\Controllers\VouncherRecordsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

    Route::get(
        'test',
        // fn () => Storage()
    );
    Route::prefix('user')->group(function () {

        Route::post('register', [ApiAuthController::class, 'Register']);
        Route::apiResource('brand', BrandController::class);
        // Route::delete('brand/{id}', 'BrandController@destroy')->middleware('isAdmin');
        Route::apiResource('product', ProductController::class);
        Route::apiResource('photo', PhotoController::class);
        Route::post('product/sale_product', [ProductController::class, 'SaleProduct']);
        // Route::apiResource('stock', StockController::class)->only(['index', 'store']);
        Route::apiResource('stock', StockController::class);
        Route::apiResource('vouncher', VouncherController::class);
        Route::apiResource('vouncher-record', VouncherRecordsController::class);
        Route::get('devices', [ApiAuthController::class, 'devices']);
        Route::get('delete-account', [ApiAuthController::class, 'DeleteAccount']);
        Route::post('update/{id}', [ApiAuthController::class, 'Update']);
        Route::post('ban-user', [ApiAuthController::class, 'BanUser']);
        Route::get('user-profile', [ApiAuthController::class, 'userProfile']);
        Route::get('all-users', [ApiAuthController::class, 'allUsers']);
        Route::post('reset', [ApiAuthController::class, 'reset']);
        Route::post('new-pw', [ApiAuthController::class, 'newPw']);
        Route::get('logout', [ApiAuthController::class, 'logout']);
        Route::get('logout-all', [ApiAuthController::class, 'logOutAll']);
    });


    Route::post("login", [ApiAuthController::class, 'login']);
});
