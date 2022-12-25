<?php

use App\Http\Controllers\ClientAreaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UsersController;
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
    return to_route('login.index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/validar-login', [LoginController::class, 'autenticar']);
Route::get('/registrar', [UsersController::class, 'create'])->name('users.create');
Route::post('/registrar', [UsersController::class, 'store'])->name('users.store');
Route::get('/dashboard', [PanelController::class, 'index'])->name('panel.index');
Route::get('/area-cliente', [ClientAreaController::class, 'index'])->name('client-area.index');
