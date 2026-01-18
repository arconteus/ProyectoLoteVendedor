<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas API para Lotes y Vendedores
Route::middleware(['auth:sanctum'])->apiResource('lotes', App\Http\Controllers\LoteController::class);
Route::middleware(['auth:sanctum'])->apiResource('vendedores', App\Http\Controllers\VendedorController::class);
// Ruta para sincronizar vendedores con la API externa
Route::middleware(['auth:sanctum'])->post('vendedores/sync', [App\Http\Controllers\VendedorController::class, 'sync']);
