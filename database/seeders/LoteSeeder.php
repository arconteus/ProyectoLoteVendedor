<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lote;

class LoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lote::factory()->create([
            'nombre' => 'Sucursal Rancho Grande',
            'direccion' => 'Av. Rancho Grande',
            'identificador' => 'LOTE001',
        ]);

        Lote::factory()->create([
            'nombre' => 'Sucursal Chimalhuacan',
            'direccion' => 'Av. Chimalhuacan',
            'identificador' => 'LOTE002',
        ]);

        Lote::factory()->create([
            'nombre' => 'Sucursal Texcoco',
            'direccion' => 'Av. Texcoco',
            'identificador' => 'LOTE003',
        ]);
    }
}
