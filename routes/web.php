<?php

use App\Http\Controllers\ClientAreaController;
use App\Http\Controllers\ClientInfoController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MetricController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\VideoController;
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
Route::get('/registrar', [LoginController::class, 'create'])->name('login.create');
Route::post('/registrar', [LoginController::class, 'store'])->name('login.store');
Route::get('/dashboard', [PanelController::class, 'index'])->name('panel.index');
Route::get('/area-cliente', [ClientAreaController::class, 'index'])->name('client-area.index');
Route::get('/novo-video/{id}/{tag}', [VideoController::class, 'create'])->name('video.create');
Route::post('/Adicionar-video', [VideoController::class, 'store'])->name('video.store');
Route::get('/cliente-info/{id}', [ClientInfoController::class, 'index'])->name('client-info.index');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
Route::get('/novo-video/{tag}', [VideoController::class, 'create'])->name('video.create');
Route::get('/nova-metrica/{id}', [MetricController::class, 'create'])->name('metric.create');
Route::post('/adicionar-metrica', [MetricController::class, 'store'])->name('metric.store');
Route::get('/novo-diagnostico/{id}', [DiagnosticController::class, 'create'])->name('diagnostic.create');
Route::post('/adicionar-diagnostico', [DiagnosticController::class, 'store'])->name('diagnostic.store');