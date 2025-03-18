<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigData extends Model
{
    use HasFactory;

    protected $table = 'mig_data'; // Aseguramos que use la tabla correcta

    protected $primaryKey = 'codbien'; 
    public $timestamps = false; // Desactivar timestamps si la tabla no tiene created_at y updated_at

    protected $fillable = [
        'codbien', 'descripcio', 'color', 'est_bien', 'marca', 'modelo', 'serie',
        'fec_reg', 'doc_alta', 'inventariado', 'ubicacioncompleta', 'nombrecompleto'
    ];
}
