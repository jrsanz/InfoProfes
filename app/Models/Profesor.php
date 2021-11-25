<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Profesor extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function puntualidad($profesores, $opcion)
    {
        $arreglo = array();

        if($opcion == "Busqueda General") {
            foreach($profesores as $profesor)
                array_push($arreglo, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('puntualidad'));
        }
        else if($opcion == "Busqueda Particular")
            array_push($arreglo, $profesores->avg('puntualidad'));
        
        $puntualidad = array_chunk($arreglo, 2);

        return $puntualidad;
    }

    public function personalidad($profesores, $opcion)
    {
        $arreglo = array();

        if($opcion == "Busqueda General") {
            foreach($profesores as $profesor)
                array_push($arreglo, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('personalidad'));
        }
        else if($opcion == "Busqueda Particular")
            array_push($arreglo, $profesores->avg('personalidad'));
        
        $personalidad = array_chunk($arreglo, 2);

        return $personalidad;
    }

    public function aprendizaje_obtenido($profesores, $opcion)
    {
        $arreglo = array();

        if($opcion == "Busqueda General") {
            foreach($profesores as $profesor)
                array_push($arreglo, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('aprendizaje_obtenido'));
        }
        else if($opcion == "Busqueda Particular")
            array_push($arreglo, $profesores->avg('aprendizaje_obtenido'));
        
        $aprendizaje_obtenido = array_chunk($arreglo, 2);

        return $aprendizaje_obtenido;
    }

    public function manera_evaluar($profesores, $opcion)
    {
        $arreglo = array();

        if($opcion == "Busqueda General") {
            foreach($profesores as $profesor)
                array_push($arreglo, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('manera_evaluar'));
        }
        else if($opcion == "Busqueda Particular")
            array_push($arreglo, $profesores->avg('manera_evaluar'));
        
        $manera_evaluar = array_chunk($arreglo, 2);

        return $manera_evaluar;
    }

    public function calificacion_obtenida($profesores, $opcion)
    {
        $arreglo = array();

        if($opcion == "Busqueda General") {
            foreach($profesores as $profesor)
                array_push($arreglo, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('calificacion_obtenida'));
        }
        else if($opcion == "Busqueda Particular")
            array_push($arreglo, $profesores->avg('calificacion_obtenida'));
        
        $calificacion_obtenida = array_chunk($arreglo, 2);

        return $calificacion_obtenida;
    }

    public function conocimiento($profesores, $opcion)
    {
        $arreglo = array();

        if($opcion == "Busqueda General") {
            foreach($profesores as $profesor)
                array_push($arreglo, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('conocimiento'));
        }
        else if($opcion == "Busqueda Particular")
            array_push($arreglo, $profesores->avg('conocimiento'));
        
        $conocimiento = array_chunk($arreglo, 2);

        return $conocimiento;
    }
}