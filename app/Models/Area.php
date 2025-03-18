<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas'; // Aseguramos que use la tabla correcta

    protected $primaryKey = 'cod_are_ent';

    public $timestamps = false; // Desactivar timestamps si la tabla no tiene created_at y updated_at

    protected $fillable = [
        'cod_are_ent', 'codigo', 'nombre'
    ];

    // Casting para preservar los ceros a la izquierda
    protected $casts = [
        'cod_are_ent' => 'string',
    ];
}
