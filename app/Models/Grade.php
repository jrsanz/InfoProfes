<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'profesor_id',
        'user_id',
        'puntualidad',
        'personalidad',
        'aprendizaje_obtenido',
        'manera_evaluar',
        'calificacion_obtenida',
        'conocimiento',
        'categoria',
        'comentario',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
