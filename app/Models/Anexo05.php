<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo05 extends Model
{
    use HasFactory;

    protected $table = 'anexos_05';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'total_horas',
        'idEmpresa',
        'lugar_oficina',
        'lugar_laboratorio',
        'lugar_almacen',
        'lugar_campo',
        'lugar_otros',
        'lugar_taller',
        'detalle_otros',
        'horario',
        'tareas',
        'total_puntaje',
        'fecha_anexo',
        'lugar_anexo',
        'id_EFSRT'
    ];

    /**
     * Relación: Un Anexo05 pertenece a una Empresa (opcional).
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'idEmpresa');
    }

    /**
     * Relación: Un Anexo05 pertenece a una EFSRT (opcional).
     */
    public function efsrt()
    {
        return $this->belongsTo(EFSRT::class, 'id_EFSRT');
    }

    /**
     * Relación: Un Anexo05 puede tener muchos IndicadoresAnexo.
     */
    public function indicadoresAnexo()
    {
        return $this->hasMany(IndicadorAnexo::class, 'id_anexo');
    }
}