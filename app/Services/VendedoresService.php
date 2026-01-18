<?php

namespace App\Services;

use App\Models\Vendedor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use App\Models\Lote;

class VendedoresService
{
    /**
     * Funcion para obtener todos los vendedores.
     * * @param array{
     *     orderBy?: string,
     *     orderDirection?: 'asc'|'desc',
     *     q?: string,
     *     where?: array<string, ñmixed>
     * } $data
     * @return Collection<int, Vendedor>
     */
    public function getAll(array $data): Collection
    {
        // Construir la consulta con posibles filtros
        $query = Vendedor::query();
        // Aplicar Ordenamiento
        $query->orderBy($data['orderBy'] ?? 'id', $data['orderDirection'] ?? 'desc');
        // Aplicar Quick Search
        if (!empty($data['q'])) {
            $query->where('nombre', 'like', '%' . $data['q'] . '%');
        }
        // Aplicar filtros Where
        if (!empty($data['where'])) {
            foreach ($data['where'] as $field => $value) {
                $query->where($field, $value);
            }
        }
        return $query->get();
    }

    /**
     * Funcion para obtener un vendedor por su ID.
     * @return Vendedor|null
     */
    public function getById(int $id): ?Vendedor
    {
        return $this->getAll(['where' => ['id' => $id]])->first();  
    }

    /**
     * Funcion para crear un nuevo vendedor.
     * @return Vendedor
     */
    public function create(array $data): Vendedor
    {
        return Vendedor::create($data);
    }

    /**
     * Funcion para actualizar un vendedor existente.
     * @return Vendedor|null
     */
    public function update(array $data): ?Vendedor
    {
        $vendedor = Vendedor::find($data['id']);
        return $vendedor->update($data) ? $vendedor->fresh() : null;
    }

    /**
     * Funcion para eliminar un vendedor por su ID.
     * @return bool
     */
    public function delete(int $id): bool
    {
        $vendedor = Vendedor::find($id);
        if ($vendedor) {
            return $vendedor->delete();
        }
        return false;
    }

    public function sync(array $data): void
    {
        $url = config('services.vendedores_api.base_url');
        $apiVendedores = Http::get($url)->json();

        foreach ($apiVendedores as $v) {
            \App\Models\Vendedor::updateOrCreate(
                ['external_id' => $v['id']], // buscar por ID externo
                [
                    'nombre' => $v['name'],
                    'email' => $v['email'],
                    'telefono' => $v['phone'],
                    'direccion' => $v['address'],
                    'lote_id' => $data['lote_id'],
                ]
            );
        }
    }
}