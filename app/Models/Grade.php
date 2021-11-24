<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'profesor_id',
        'puntualidad',
        'personalidad',
        'aprendizaje_obtenido',
        'manera_evaluar',
        'calificacion_obtenida',
        'conocimiento',
        'categoria',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
