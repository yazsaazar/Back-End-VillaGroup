<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//importar
use App\Http\Controllers\ResortsController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\ResguardosController;
use App\Http\Controllers\DictamenesController;

//rutas
Route::resource('resorts', ResortsController::class);
Route::resource('tipos', TiposController::class);
Route::resource('departamentos', DepartamentosController::class);
Route::resource('areas', AreasController::class);
Route::resource('colaboradores', ColaboradoresController::class);
Route::resource('equipos', EquiposController::class);
Route::resource('resguardos', ResguardosController::class);
Route::resource('dictamenes', DictamenesController::class);




use App\Http\Controllers\UsuariosController;

Route::post('login', [UsuariosController::class, 'login']);
Route::post('register', [UsuariosController::class, 'register']);
Route::post('logout', [UsuariosController::class, 'logout']);


    Route::get('usuarios', [UsuariosController::class, 'index']);
    Route::get('usuarios/{id}', [UsuariosController::class, 'show']);
    Route::put('usuarios/{id}', [UsuariosController::class, 'update']);
    Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy']);

