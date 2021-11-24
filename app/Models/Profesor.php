<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'cu', 'verificado',
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function setNombreAttribute($nombre)
    {
        return $this->attributes['nombre'] = mb_strtoupper($nombre);
    }

    public function setApellidoPaternoAttribute($apellido_paterno)
    {
        return $this->attributes['apellido_paterno'] = mb_strtoupper($apellido_paterno);
    }

    public function setApellidoMaternoAttribute($apellido_materno)
    {
        return $this->attributes['apellido_materno'] = mb_strtoupper($apellido_materno);
    }
}