<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas API para Lotes y Vendedores
Route::middleware(['auth:sanctum'])->apiResource('lotes', App\Http\Controllers\LoteController::class);
Route::middleware(['auth:sanctum'])->apiResource('vendedores', App\Http\Controllers\VendedorController::class);
// Ruta para obtener vendedores de un lote específico
Route::middleware(['auth:sanctum'])->get('lotes/{id}/vendedores', [App\Http\Controllers\LoteController::class, 'getVendedoresByLote']);
// Ruta para sincronizar vendedores con la API externa
Route::middleware(['auth:sanctum'])->post('vendedores/sync', [App\Http\Controllers\VendedorController::class, 'sync']);

// Endpoint rápido: retorna JSON de vendedores de un lote (solo para pruebas rápidas)
Route::get('quick/lotes/{id}/vendedores', function ($id) {
    $lote = \App\Models\Lote::with('vendedores')->find($id);
    if (!$lote) {
        return response()->json(['message' => 'Lote not found'], 404);
    }
    return response()->json($lote->vendedores, 200);
});