<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{   
    use HasFactory;

    // Table name
    public $table = 'vendedores';

    // Mass assignable attributes
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'external_id',
        'lote_id',
    ];

    // Timestamps enabled
    public $timestamps = true;

    // Relación con Lote
    public function lote()
    {
        return $this->belongsTo(Lote::class, 'lote_id');
    }
}
