<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    use HasFactory;

    protected $table = 'mig_data'; // Usamos la misma tabla que en Consultas
    protected $primaryKey = 'codbien';
    public $timestamps = false;

    protected $fillable = [
        'codbien', 
        'sit_binv', 
        'descripcio', 
        'color', 
        'est_bien', 
        'marca', 
        'modelo', 
        'serie',
        'fec_reg', 
        'doc_alta', 
        'inventariado', 
        'ubicacioncompleta', 
        'nombrecompleto',
        'codarea',              // Nuevo campo de área
        'reporte_generado'      // Campo para saber si se generó el reporte
    ];

    protected $casts = [
        'codbien' => 'string',
        'reporte_generado' => 'boolean',
    ];
}
