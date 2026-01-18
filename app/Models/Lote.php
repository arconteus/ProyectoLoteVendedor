<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    // Table name
    public $table = 'lotes';

    // Mass assignable attributes
    protected $fillable = [
        'nombre',
        'direccion',
        'identificador',
        'activo',
    ];

    // Timestamps enabled
    public $timestamps = true;

    // Casting 'activo' to boolean
    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relación con vendedores
    public function vendedores()
    {
        return $this->hasMany(Vendedor::class);
    }
}
