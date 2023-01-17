<?php

use App\Http\Controllers\Api\ApiSiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Models\Siswa;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('Syn', [ApiSiswaController::class, 'getData']);
    Route::get('dashboard', [ApiSiswaController::class, 'ViewSiswa'])->name('dashboard');
    Route::get('syn', [ApiSiswaController::class, 'setting'])->name('syn');


    // Controller Siswa
    Route::get('siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::delete('siswa/{siswa}', [SiswaController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
