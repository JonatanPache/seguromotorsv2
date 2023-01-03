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
Route::get('/notifications',[WelcomeController::class,'index_notifications'])
    ->name('notifications');
Route::get('/ver_notification/{id}',[WelcomeController::class,'show_notification'])
    ->name('ver_notification');
Route::get('/salir',WelcomeController::class)->name('salir');
Route::get('/contrato/{id}',[WelcomeController::class,'contrato'])->name('contrato');
Route::post('/contrato/contrato_firma/{id}',[WelcomeController::class,'contrato_firma'])->name('contrato_firma');
Route::get('/pagos',[WelcomeController::class,'pagos_index'])->name('pagos');
Route::post('/checkout',[WelcomeController::class,'pagos_store'])->name('checkout');
Route::post('/pay',[WelcomeController::class,'pagos_pay'])->name('pay');

Route::get('/facturas/{id}/generate',[WelcomeController::class,'factura_generate'])->name('factura_print');
Route::get('/facturas/{id}/ver',[WelcomeController::class,'factura_ver'])->name('factura_ver');


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/solicitudCotizacion', [Solicitud::class,'index'])->name('solicitud');

require __DIR__.'/auth.php';
