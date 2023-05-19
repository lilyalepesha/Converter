<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:auth', 'guest'])->prefix('register')->as('register.')
    ->group(function () {
        Route::get('/', [RegisterController::class, 'index'])->name('index');
        Route::post('/store', [RegisterController::class, 'store'])->name('store');
    });

Route::post('/logout', [LogoutController::class, 'logout'])->middleware(['throttle:auth', 'auth'])
    ->name('logout');

Route::middleware(['throttle:auth', 'guest'])->prefix('forget-password')->as('forget.')
    ->group(function () {
        Route::get('/', [ForgetPasswordController::class, 'index'])->name('index');
        Route::post('/store', [ForgetPasswordController::class, 'store'])->name('store');
    });

Route::middleware(['throttle:auth', 'guest'])->prefix('reset-password')->as('password.')
    ->group(function () {
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('reset');
        Route::post('/reset-password/update', [ResetPasswordController::class, 'store'])->name('update');
    });

Route::middleware(['throttle:auth', 'auth'])->prefix('profile')->as('profile.')
    ->group(function () {
        Route::get('/user', [UserProfileController::class, 'index'])->name('index');
        Route::patch('/update/{user}', [UserProfileController::class, 'update'])->name('update');
    });

Route::middleware(['throttle:auth', 'guest'])->prefix('login')->as('login.')
    ->group(function () {
        Route::get('/', [LoginController::class, 'index'])->name('index');
        Route::post('/store', [LoginController::class, 'store'])->name('store');
    });
