<?php
/**
 * Archivo que contiene las rutas del administrador
 */

use App\Http\Controllers\Admin\AdministradorController;
use App\Http\Controllers\Admin\DeporteController;
use App\Http\Controllers\Admin\CampeonatoController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PublicidadController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;

//middleware para proteger la ruta
Route::get('',[HomeController::class, 'index'])->middleware('can:admin.index')->name('admin.home');
Route::resource('deportes', DeporteController::class)->names('admin.deportes');
Route::resource('campeonatos', CampeonatoController::class)->names('admin.campeonatos');
Route::resource('administradores', AdministradorController::class)->names('admin.administradores');
Route::get('/administradores/{id}/editProfile', [AdministradorController::class, 'editProfile'])->name('admin.administradores.editProfile');
Route::put('/administradores/updateProfile/{id}', [AdministradorController::class, 'updateProfile'])->name('admin.administradores.updateProfile');
Route::post('/administradores/updatePassword', [AdministradorController::class, 'updatePassword'])->name('admin.administradores.updatePassword');
Route::resource('videos', VideoController::class)->names('admin.videos');
Route::get('/videos/{idVideo}/createLiveStream', [VideoController::class, 'createLiveStream'])->name('admin.videos.createLiveStream');
Route::post('/videos/storeLiveStream', [VideoController::class, 'storeLiveStream'])->name('admin.videos.storeLiveStream');
Route::get('/videos/{idVideo}/retrieveLiveStream', [VideoController::class, 'retrieveLiveStream'])->name('admin.videos.retrieveLiveStream');
Route::resource('clientes', ClienteController::class)->names('admin.clientes');
Route::put('clientes/{idCliente}/subscribeVideo/{idVideo}', [ClienteController::class, 'subscribeVideo'])->name('admin.clientes.subscribeVideo');
Route::put('clientes/{idCliente}/unsubscribeVideo/{idVideo}', [ClienteController::class, 'unsubscribeVideo'])->name('admin.clientes.unsubscribeVideo');
Route::resource('roles', RolController::class)->names('admin.roles');
Route::resource('publicidades', PublicidadController::class)->names('admin.publicidades');



