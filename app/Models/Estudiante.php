<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_programa'
    ];

    /**
     * Relación: Un Estudiante pertenece a una Persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id'); // 'id' es la clave foránea en estudiantes que referencia personas.id
    }

    /**
     * Relación: Un Estudiante pertenece a un ProgramaEstudio.
     */
    public function programaEstudio()
    {
        return $this->belongsTo(ProgramaEstudio::class, 'id_programa');
    }

    /**
     * Relación: Un Estudiante puede tener muchas EFSRT.
     */
    public function efsrts()
    {
        return $this->hasMany(EFSRT::class, 'id_estudiante');
    }
}