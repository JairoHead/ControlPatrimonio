<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados_sbn'; // Aseguramos que use la tabla correcta

    protected $primaryKey = 'CODIGO'; 

    public $timestamps = false; // Desactivar timestamps si la tabla no tiene created_at y updated_at

    protected $fillable = [
        'CODIGO', 'NOMBRES', 'APELLIDO_PATERNO', 'APELLIDO_MATERNO', 'TIPO_DOC_IDENTIDAD', 'NRO_DOC_IDENT_PERSONAL'
    ];

    // Casting para preservar los ceros a la izquierda
    protected $casts = [
        'CODIGO' => 'string',
    ];
}
