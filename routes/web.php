<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardBeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardKategoriBeritaController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardWeldersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WeldingController;
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

Route::resource('/', BeritaController::class);
Route::get('/show/{berita}',[ BeritaController::class, 'show'])->name('show');
Route::get('/kategori/{kategori_id}', [BeritaController::class, 'beritaByKategori'])->name('berita.by_kategori');
Route::resource('/welding', WeldingController::class);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::resource('/user', DashboardUserController::class);
    Route::post('/user/reset/{user}', [DashboardUserController::class, 'reset'])->name('user.reset');

    Route::resource('/berita', DashboardBeritaController::class);

    Route::resource('/welder', DashboardWeldersController::class);

    Route::resource('/kategori-berita', DashboardKategoriBeritaController::class);
});
