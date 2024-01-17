<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\ColeccionController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::get('/elemento/{elementoID}', [ElementoController::class, 'elementoJSON'])->name('elementoJSON');
Route::get('/elemento/coleccion/{coleccionID}/{userID}', [ElementoController::class, 'coleccionesElementosJSON'])->name('coleccionesElementosJSON');
Route::get('/elemento/coleccion/{elementoID}', [ElementoController::class, 'coleccionElementoJSON'])->name('coleccionElementoJSON');
Route::get('/elemento/grafico/numero', [ElementoController::class, 'coleccionElementosJSON'])->name('coleccionElementosJSON');
Route::get('/elemento/nouser/coleccion/{coleccionID}/{userID}', [ElementoController::class, 'coleccionNouserJSON'])->name('coleccionNouserJSON');
Route::get('/elemento/user/{userID}/1', [ElementoController::class, 'elementoUsuarioJSON'])->name('elementoUsuarioJSON');
Route::get('/elemento', [ElementoController::class, 'elementosJSON'])->name('elementosJSON');
Route::post('/elemento/nuevo/{selectedValue}', [ElementoController::class, 'elementoNuevo'])->name('elementoNuevo');
Route::post('/elemento/user/nuevo/{userID}', [ElementoController::class, 'elementoUsuarioNuevo'])->name('elementoUsuarioNuevo');
Route::post('/elemento/actualizacion/{elementoID}/{coleccionID}', [ElementoController::class, 'elementoUpdate'])->name('elementoUpdate');
Route::post('/elemento/actualizacion/comentario/{elementoID}/1', [ElementoController::class, 'elementoComentario'])->name('elementoComentario');
Route::delete('/elemento/borrado/{elementoID}', [ElementoController::class, 'elementoDelete'])->name('elementoDelete');
Route::delete('/elemento/borrado/user/{elementoID}/{userID}', [ElementoController::class, 'elementoUserDelete'])->name('elementoUserDelete');

Route::get('/usuario/{userID}', [UsuarioController::class, 'usuarioJSON'])->name('usuarioJSON');
Route::post('/usuario/update/{userID}', [UsuarioController::class, 'usuarioUpdateJSON'])->name('usuarioUpdateJSON');

Route::get('/coleccion/{coleccionID}', [ColeccionController::class, 'coleccionJSON'])->name('coleccionJSON');
Route::get('/coleccion/tipo/{tipo}', [ColeccionController::class, 'tipoColeccionJSON'])->name('tipoColeccionJSON');
Route::get('/coleccion', [ColeccionController::class, 'coleccionesJSON'])->name('coleccionesJSON');
Route::post('/coleccion/nueva', [ColeccionController::class, 'coleccionNueva'])->name('coleccionNueva');
Route::post('/coleccion/actualizacion/{coleccionID}', [ColeccionController::class, 'coleccionUpdate'])->name('coleccionUpdate');
Route::delete('/coleccion/borrado/{coleccionID}', [ColeccionController::class, 'coleccionDelete'])->name('coleccionDelete');

Route::post('/registro', [UsuarioController::class, 'register']);
Route::post('/login', [UsuarioController::class, 'login']);
