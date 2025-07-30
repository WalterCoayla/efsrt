<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_programa',
        'especialidad'
    ];

    /**
     * Relación: Un Docente pertenece a una Persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id');
    }

    /**
     * Relación: Un Docente pertenece a un ProgramaEstudio.
     */
    public function programaEstudio()
    {
        return $this->belongsTo(ProgramaEstudio::class, 'id_programa');
    }

    /**
     * Relación: Un Docente puede asesorar muchas EFSRT.
     */
    public function efsrtsAsesoradas()
    {
        return $this->hasMany(EFSRT::class, 'id_docente_asesor');
    }
}