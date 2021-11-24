<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'profesor_id', 'materia', 'nrc',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
