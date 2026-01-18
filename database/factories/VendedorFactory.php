<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lote;

class VendedorFactory extends Factory
{
    protected $model = \App\Models\Vendedor::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'external_id' => $this->faker->unique()->randomNumber(),
            'lote_id' => Lote::factory(), // crea un lote automáticamente
        ];
    }
}
