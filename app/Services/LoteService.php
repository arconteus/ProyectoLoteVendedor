<?php

namespace App\Services;

use App\Models\Lote;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Expr\Throw_;

class LoteService
{
    /**
     * Funcion para obtener todos los lotes.
     * * @param array{
     *     orderBy?: string,
     *     orderDirection?: 'asc'|'desc',
     *     q?: string,
     *     where?: array<string, mixed>
     * } $data
     * @return Collection<int, Lote>
     */
    public function getAll(array $data): Collection
    {
        // Construir la consulta con posibles filtros
        $query = Lote::query()->with('vendedores');
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
     * Funcion para obtener un lote por su ID.
     * @return Lote|null
     */
    public function getById(int $id): ?Lote
    {
        return $this->getAll(['where' => ['id' => $id]])->first();  
    }

    /**
     * Funcion para crear un nuevo lote.
     * @return Lote
     */
    public function create(array $data): Lote
    {
        return Lote::create($data);
    }

    /**
     * Funcion para actualizar un lote existente.
     * @return Lote|null
     */
    public function update(array $data): ?Lote
    {
        $lote = Lote::find($data['id']);
        return $lote->update($data) ? $lote->fresh() : null;
    }

    /**
     * Funcion para eliminar un lote por su ID.
     * @return bool
     */
    public function delete(int $id): bool
    {
        $lote = Lote::find($id);
        if ($lote->vendedores()->count() > 0) {
            throw new \Exception("No se puede eliminar el lote porque tiene vendedores asociados.");
        }
        return $lote->delete();
    }
}