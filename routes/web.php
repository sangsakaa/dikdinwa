<?php

use App\Http\Controllers\Api\ApiSiswaController;
use App\Http\Controllers\Api\RekapHarianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [WelcomeController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/Sync', [ApiSiswaController::class, 'setting'])->name('Sync');
    Route::get('/Syn', [ApiSiswaController::class, 'getData']);
    Route::get('/Syn-rekap-harian', [RekapHarianController::class, 'getDataRekap']);
    Route::get('data-siswa', [SiswaController::class, 'index'])->name('data-siswa');
    Route::get('rekap-siswa-harian', [SiswaController::class, 'RekapHarian'])->name('rekap-siswa-harian');
    Route::delete('data-siswa', [SiswaController::class, 'destroy']);
    Route::delete('rekap-siswa-harian', [SiswaController::class, 'destroyRekap']);
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
