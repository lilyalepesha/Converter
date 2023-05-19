<?php

use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\Images\ImageController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\ZipArchives\ZipController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ImageOperationsController;
use Illuminate\Support\Facades\Http;
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
Route::get('/', [ImageOperationsController::class, 'index'])->name('service.index');
Route::middleware(['throttle:auth', 'auth'])->prefix('service')->as('service.')->group(function () {
    Route::post('/store', [ImageOperationsController::class, 'store'])->name('store');
    Route::get('/download', [ImageOperationsController::class, 'downloadFiles'])->name('download');
});

Route::middleware(['can:isAdmin', 'auth'])->namespace('Admin')->prefix('admin')
    ->as('admin.')->group(function () {
    Route::get('/', [AdminPanelController::class, 'index'])->name('index');
});
Route::middleware(['can:isAdmin', 'auth'])->as('users.')->group(function () {
    Route::resource('/user', UserController::class);
});

Route::middleware(['can:isAdmin', 'auth'])->as('images.')->group(function () {
    Route::get('/images/index', [ImageController::class, 'index'])->name('index');
});
Route::middleware(['can:isAdmin', 'auth'])->as('zips.')->group(function () {
    Route::get('/zips/index', [ZipController::class, 'index'])->name('index');
});



