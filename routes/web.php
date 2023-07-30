<?php

use Illuminate\Support\Facades\Route;
use App\Controller\UserController;
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
// Listado de rutas hacía las vistas.

Route::get('/', function () {
    return redirect('/events');
});
Route::get('/home', function () {
    return redirect('/events');
});

//Rutas de Usuarios
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index')->middleware('auth');

Route::post('/users/create', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');

Route::delete('/users/{id}', [App\Http\Controllers\UserController::class,'destroy'])->name('users.destroy');

Route::post('/users/{id}', [App\Http\Controllers\UserController::class,'update'])->name('users.update');

//Rutas de Eventos
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events.index')->middleware('auth');

Route::post('/events/create', [App\Http\Controllers\EventController::class, 'store'])->name('events.store');

Route::delete('/events/{id}', [App\Http\Controllers\EventController::class,'destroy'])->name('events.destroy');

Route::post('/events/{id}', [App\Http\Controllers\EventController::class,'update'])->name('events.update');

//Rutas de Tipo de Eventos
Route::get('/tipe_events', [App\Http\Controllers\TipeEventController::class, 'index'])->name('tipe_events.index')->middleware('auth');

Route::post('/tipe_events/create', [App\Http\Controllers\TipeEventController::class, 'store'])->name('tipe_events.store');

Route::delete('/tipe_events/{id}', [App\Http\Controllers\TipeEventController::class,'destroy'])->name('tipe_events.destroy');

Route::post('/tipe_events/{id}', [App\Http\Controllers\TipeEventController::class,'update'])->name('tipe_events.update');

Auth::routes();


