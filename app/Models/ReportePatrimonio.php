<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MigData; // Importar tu modelo MigData

class ReportePatrimonio extends Model
{
    use HasFactory;

    protected $table = 'reportes_patrimonio';
    protected $primaryKey = 'id';
    public $timestamps = true; // si usas created_at / updated_at

    protected $fillable = [
        'codigo', // campo que referencia a mig_data.codbien
        'fecha',
        'usuario_id',
        'accion',
        'detalle',
    ];

    // Relación: muchos reportes_patrimonio pertenecen a un MigData (1:1 / belongsTo)
    public function migData()
    {
        return $this->belongsTo(MigData::class, 'codigo', 'codbien');
        // Parametros: belongsTo( RelatedModel, 'foreign_key', 'owner_key' )
        // 'codigo' es la foreign key en reportes_patrimonio
        // 'codbien' es la primary key en mig_data
    }
}
