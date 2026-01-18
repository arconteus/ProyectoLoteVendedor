<?php

namespace App\Http\Controllers;

// Request
use App\Http\Requests\VendedoresService\{
    CreateRequest, 
    DeleteRequest, 
    SearchRequest,
    SyncRequest, 
    UpdateRequest,};
// Service
use App\Services\VendedoresService;

class VendedorController extends Controller
{
    // Inyección de la dependencia VendedoresService
    public function __construct(private VendedoresService $vendedoresService) {}

    /**
     * Display a listing of the resource.
     * @param  \App\Http\Requests\VendedoresService\SearchRequest  $request
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - orderBy: Campo por el cual ordenar (id, nombre, email, telefono, external_id, lote_id, created_at, updated_at)
     * - orderDirection: Dirección de ordenamiento (asc, desc)
     * - q: Término de búsqueda para filtrar vendedores
     * - where: Array de campos para filtrar resultados (id, nombre, email, telefono, external_id, lote_id, created_at, updated_at)
     */
    public function index(SearchRequest $request)
    {
        $vendedores = $this->vendedoresService->getAll($request->validated());
        return response()->json($vendedores);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - nombre: Nombre del vendedor (string, requerido)
     * - email: Email del vendedor (string, requerido, único)
     * - telefono: Teléfono del vendedor (string, opcional)
     * - external_id: ID externo del vendedor (integer, requerido, único)
     * - lote_id: ID del lote asociado (integer, requerido, debe existir en la tabla lotes)
     */
    public function store(CreateRequest $request)
    {
        $vendedor = $this->vendedoresService->create($request->validated());
        if(!$vendedor) {
            return response()->json(['message' => 'Vendedor could not be created.'], 400);
        }
        return response()->json($vendedor, 201);
    }

    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - id: ID del vendedor a actualizar (integer, requerido)
     * - nombre: Nombre del vendedor (string, opcional)
     * - email: Email del vendedor (string, opcional, único)
     * - telefono: Teléfono del vendedor (string, opcional)
     * - external_id: ID externo del vendedor (integer, opcional, único)
     * - lote_id: ID del lote asociado (integer, opcional, debe existir en la tabla lotes)
     */
    public function update(UpdateRequest $request)
    {
        $vendedor = $this->vendedoresService->update($request->validated());
        if(!$vendedor) {
            return response()->json(['message' => 'Vendedor not found'], 404);
        }
        return response()->json($vendedor, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - id: ID del vendedor a eliminar (integer, requerido)
     */
    public function destroy(DeleteRequest $request)
    {
        $response = $this->vendedoresService->delete($request->validated());
        if(!$response) {
            return response()->json(['message' => 'Vendedor can not be deleted.'], 404);
        }   
        return response()->json(null, 204);
    }

    /**
     * Sync vendedores data.
     * @return \Illuminate\Http\Response
     * 
     * Parámetros esperados en la request:
     * - lote_id: ID del lote asociado (integer, requerido, debe existir en la tabla lotes)
     * 
     * Estructura esperada del array 'vendedores':
     * - vendedores: Array de objetos con la siguiente estructura:
     *   - nombre: Nombre del vendedor (string, requerido)
     *   - email: Email del vendedor (string, requerido, único)
     *   - telefono: Teléfono del vendedor (string, opcional)
     *   - external_id: ID externo del vendedor (integer, requerido, único)
     * 
     * Nota: El lote_id se aplica a todos los vendedores en el array.
     */
    public function sync(SyncRequest $request)
    {
        $result = $this->vendedoresService->sync($request->validated());
        return response()->json($result, 200);
    }
}
