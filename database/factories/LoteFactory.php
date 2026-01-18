<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LoteFactory extends Factory
{
    protected $model = \App\Models\Lote::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company(),
            'direccion' => $this->faker->address(),
            'identificador' => Str::uuid(),
            'activo' => true,
        ];
    }
}
