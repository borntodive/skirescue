<?php

use App\Http\Controllers\Api\SensorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SampleController;
use App\Http\Controllers\Api\SkiareaController;
use App\Http\Controllers\Api\UserController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');



Route::middleware('auth:sanctum')->group(
    function () {
        Route::prefix('skiarea')->group(
            function () {
                Route::get('/', [SkiareaController::class, 'index']);
            }
        );
        Route::prefix('sensor')->group(
            function () {
                Route::get('/', [SensorController::class, 'index']);
            }
        );
        Route::prefix('user')->group(
            function () {
                Route::get('/rescuers', [UserController::class, 'getRescuers']);
                Route::get('/rescuers/{id}', [UserController::class, 'getRescuer']);
            }
        );
        Route::prefix('sample')->group(
            function () {
                Route::post('/', [SampleController::class, 'store']);
            }
        );
    }
);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
