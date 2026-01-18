<?php

namespace App\Http\Controllers;

// Request
use App\Http\Requests\LoteService\{CreateRequest, SearchRequest, UpdateRequest,};
// Service
use App\Services\LoteService;

class LoteController extends Controller
{
    // Inyección de la dependencia LoteService
    public function __construct(private LoteService $loteService) {}

    /**
     * Display a listing of the resource.
     * @param  \App\Http\Requests\LoteService\SearchRequest  $request
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - orderBy: Campo por el cual ordenar (id, nombre, direccion, identificador, activo, created_at, updated_at)
     * - orderDirection: Dirección de ordenamiento (asc, desc)
     * - q: Término de búsqueda para filtrar lotes
     * - where: Array de campos para filtrar resultados (id, nombre, direccion, identificador, activo, created_at, updated_at)
     */
    public function index(SearchRequest $request)
    {
        $lotes = $this->loteService->getAll($request->validated());
        return response()->json($lotes);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - nombre: Nombre del lote (string, requerido)
     * - direccion: Dirección del lote (string, requerido)
     * - identificador: Identificador único del lote (string, requerido)
     * - activo: Estado del lote (boolean, opcional, por defecto true)
     */
    public function store(CreateRequest $request)
    {
        $lote = $this->loteService->create($request->validated());
        if(!$lote) {
            return response()->json(['message' => 'Lote could not be created.'], 400);
        }
        return response()->json($lote, 201);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - id: ID del lote a actualizar (integer, requerido)
     * - nombre: Nombre del lote (string, opcional)
     * - direccion: Dirección del lote (string, opcional)
     * - identificador: Identificador único del lote (string, opcional)
     * - activo: Estado del lote (boolean, opcional)
     */
    public function update(UpdateRequest $request)
    {
        $lote = $this->loteService->update($request->validated());
        if(!$lote) {
            return response()->json(['message' => 'Lote not found'], 404);
        }
        return response()->json($lote, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - id: ID del lote a eliminar (integer, requerido)
     */
    public function destroy($id)
    {
        // Elimina el lote
        $response = $this->loteService->delete($id);
        if(!$response) {
            return response()->json(['message' => 'Lote can not be deleted.'], 404);
        }
        return response()->json(null, 204);
    }

    /**
     * Get vendedores associated with a specific lote.
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - id: ID del lote (integer, requerido)
     */
    public function getVendedoresByLote($id)
    {
        $lote = $this->loteService->getById($id);
        if(!$lote) {
            return response()->json(['message' => 'Lote not found'], 404);
        }
        $vendedores = $lote->vendedores;
        return response()->json($vendedores, 200);
    }
}
