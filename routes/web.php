<?php

use App\Http\Controllers\DashboardBeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardKategoriBeritaController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardWeldersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard/index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('/dashboard')->group(function () {
    Route::resource('/user', DashboardUserController::class);
    Route::resource('/berita', DashboardBeritaController::class);
    Route::resource('/welder', DashboardWeldersController::class);
    Route::resource('/kategori-berita', DashboardKategoriBeritaController::class);
});
