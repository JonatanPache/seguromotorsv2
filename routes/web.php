<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Solicitud;
use App\Http\Controllers\WelcomeController;
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
Route::get('/',WelcomeController::class)->name('welcome');



Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/solicitudCotizacion', [Solicitud::class,'index'])->name('solicitud');

require __DIR__.'/auth.php';
