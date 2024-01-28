<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Apis\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api', 'throttle:5,1']], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::delete('/logout', [AuthController::class, 'logout']);
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/add', [CategoryController::class, 'store']);
        Route::post('/edit/{id}', [CategoryController::class, 'update']);
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
    });
});
