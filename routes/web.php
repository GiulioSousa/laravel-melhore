<?php

use App\Http\Controllers\{
    AccountController,
    ClientAreaController, 
    ClientInfoController, 
    DiagnosticController, 
    LoginController, 
    MetricController, 
    PanelController, 
    VideoController
};

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

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::post('/validar-login', 'autenticar')->name('login.autenticar');
    Route::get('/registrar', 'create')->name('login.create');
    Route::post('/registrar', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('login.destroy');
});

Route::controller(DiagnosticController::class)->group(function () {
    Route::get('/novo-diagnostico/{id}', 'create')->name('diagnostic.create');
    Route::post('/adicionar-diagnostico', 'store')->name('diagnostic.store');
    Route::get('/editar-diagnostico/{id}/editar', 'edit')->name('diagnostic.edit');
    Route::put('/atualizar-diagnostico/{id}', 'update')->name('diagnostic.update');
    Route::delete('/excluir-diagnostico/{id}', 'destroy')->name('diagnostic.destroy');
});

Route::controller(MetricController::class)->group(function () {
    Route::get('/nova-metrica/{id}', 'create')->name('metric.create');
    Route::post('/adicionar-metrica', 'store')->name('metric.store');
    Route::get('/editar-metrica/{id}/editar', 'edit')->name('metric.edit');
    Route::put('/atualizar-metrica/{id}', 'update')->name('metric.update');
    Route::delete('/excluir-metrica/{id}', 'destroy')->name('metric.destroy');
});

Route::controller(VideoController::class)->group(function () {
    Route::post('/Adicionar-video', 'store')->name('video.store');
    Route::get('/novo-video/{tag}', 'create')->name('video.create');
    Route::get('/editar-video/{id}/editar', 'edit')->name('video.edit');
    Route::put('/atualizar-video/{id}', 'update')->name('video.update');
    Route::delete('/excluir-video/{id}', 'destroy')->name('video.destroy');
});

Route::get('/dashboard', [PanelController::class, 'index'])->name('panel.index');
Route::get('/area-cliente', [ClientAreaController::class, 'index'])->name('client-area.index');
Route::get('/cliente-info/{id}', [ClientInfoController::class, 'index'])->name('client-info.index');
Route::get('/info-conta', [AccountController::class, 'index'])->name('account-info.index');
