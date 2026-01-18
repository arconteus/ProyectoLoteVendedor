<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendedor;
use App\Models\Lote;
use Illuminate\Support\Facades\Http;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch vendedores data from external API
        $response = Http::get('https://jsonplaceholder.typicode.com/users');

        // Get all lotes to assign to vendedores
        $lotes = Lote::all();
        $numLotes = $lotes->count();

        // Create vendedores using the fetched data
        foreach ($response->json() as $index => $vendedorData) {
            Vendedor::updateOrCreate(
                ['external_id' => $vendedorData['id']], // evita duplicados
                [
                    'nombre' => $vendedorData['name'],
                    'email' => $vendedorData['email'],
                    'telefono' => $vendedorData['phone'],
                    'lote_id' => $lotes[$index % $numLotes]->id,
                ]
            );
        }
    }
}
