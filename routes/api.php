<?php

use App\Http\Controllers\Api\v1\ImageController;
use App\Http\Controllers\Api\v1\LoginController;
use App\Http\Controllers\Api\v1\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
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


Route::middleware('auth:sanctum')->prefix('v1')->as('api.')->group(function (){
    Route::get('/images', [ImageController::class, 'index'])->name('index');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::prefix('v1')->as('api.')->group(function (){
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});
