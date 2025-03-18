<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;

    protected $table = 'oficinas'; // Aseguramos que use la tabla correcta

    protected $primaryKey = 'cod_ofi_ent'; 

    public $timestamps = false; // Desactivar timestamps si la tabla no tiene created_at y updated_at

    protected $fillable = [
        'cod_ofi_ent', 'codigo', 'nombre', 'cod_are_ent'
    ];

    // Casting para preservar los ceros a la izquierda
    protected $casts = [
        'cod_ofi_ent' => 'string',
    ];
}
