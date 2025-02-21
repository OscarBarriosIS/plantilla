<?php

use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OcrController;

Route::post('auth/login', [AuthenticatedSessionController::class, 'apiLogin']);

// App de Asistencia
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/obtener_datos', [AppController::class, 'obtener_datos']);
    Route::post('/registrar_asistencia', [AppController::class, 'registrar_asistencia']);
    Route::post('/obtener_asistencias', [AppController::class, 'obtener_asistencias']); 

    // APP de Formularios Mor
    Route::post('/guardarINE', [AppController::class, 'guardarINE']);
});

//OCR
Route::middleware('auth:sanctum')->post('procesar_ine', [OcrController::class, 'procesar_ine']);


