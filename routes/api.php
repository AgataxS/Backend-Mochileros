<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RolController;
use App\Http\Controllers\API\UsuarioController;
use App\Http\Controllers\API\PaisController;
use App\Http\Controllers\API\DestinoController;
use App\Http\Controllers\API\ExperienciaController;
use App\Http\Controllers\API\ComentarioController;
use App\Http\Controllers\API\ForoTemaController;
use App\Http\Controllers\API\ForoRespuestaController;
use App\Http\Controllers\API\ValoracionController;



Route::apiResource('roles', RolController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('paises', PaisController::class);
Route::apiResource('destinos', DestinoController::class);
Route::apiResource('experiencias', ExperienciaController::class);
Route::apiResource('comentarios', ComentarioController::class);
Route::apiResource('foro-temas', ForoTemaController::class);
Route::apiResource('foro-respuestas', ForoRespuestaController::class);
Route::apiResource('valoraciones', ValoracionController::class);