<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Profesor;
use App\Models\Subject;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profesores.profesoresIndex');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profesores.profesoresForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar Datos
        $request->validate(
            [
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
            'apellido_paterno' => 'required|regex:/^[\pL\s\-]+$/u',
            'apellido_materno' => 'required|regex:/^[\pL\s\-]+$/u',
            'cu' => 'required',

            'materia' => 'required|alpha_num|min:5|max:10',
            'nrc' => 'required|numeric|min:10000|max:999999',

            'puntualidad' => 'required|numeric|min:0|max:100',
            'personalidad' => 'required|numeric|min:0|max:100',
            'aprendizaje_obtenido' => 'required|numeric|min:0|max:100',
            'manera_evaluar' => 'required|numeric|min:0|max:100',
            'calificacion_obtenida' => 'required|numeric|min:0|max:100',
            'conocimiento' => 'required|numeric|min:0|max:100',
            'categoria' => 'required'
            ],
            [
                'nombre.required' => 'El campo nombre está vacío',
                'nombre.regex' => 'El campo nombre solo acepta letras',
                'apellido_paterno.required' => 'El campo apellido paterno está vacío',
                'apellido_paterno.regex' => 'El campo apellido paterno solo acepta letras',
                'apellido_materno.required' => 'El campo apellido materno está vacío',
                'apellido_materno.regex' => 'El campo apellido materno solo acepta letras',
                'cu.required' => 'El campo centro universitario está vacío',

                'materia.required' => 'El campo materia está vacío',
                'materia.min' => 'La materia debe tener mínimo 5 caracteres',
                'materia.max' => 'La materia debe tener máximo 10 caracteres',
                'materia.alpha_num' => 'La materia no puede incluir espacios',
                'nrc.required' => 'El campo nrc está vacío',
                'nrc.min' => 'El nrc debe tener mínimo 5 números',
                'nrc.max' => 'El nrc debe tener máximo 6 números',

                'puntualidad.required' => 'El campo puntualidad está vacío',
                'puntualidad.numeric' => 'El campo puntualidad debe ser numérico',
                'puntualidad.min' => 'La calificación debe ser entre 0-100',
                'puntualidad.max' => 'La calificación debe ser entre 0-100',
                'personalidad.required' => 'El campo personalidad está vacío',
                'personalidad.numeric' => 'El campo personalidad debe ser numérico',
                'personalidad.min' => 'La calificación debe ser entre 0-100',
                'personalidad.max' => 'La calificación debe ser entre 0-100',
                'aprendizaje_obtenido.required' => 'El campo aprendizaje obtenido está vacío',
                'aprendizaje_obtenido.numeric' => 'El campo aprendizaje obtenido debe ser numérico',
                'aprendizaje_obtenido.min' => 'La calificación debe ser entre 0-100',
                'aprendizaje_obtenido.max' => 'La calificación debe ser entre 0-100',
                'manera_evaluar.required' => 'El campo manera de evaluar está vacío',
                'manera_evaluar.numeric' => 'El campo manera de evaluar debe ser numérico',
                'manera_evaluar.min' => 'La calificación debe ser entre 0-100',
                'manera_evaluar.max' => 'La calificación debe ser entre 0-100',
                'calificacion_obtenida.required' => 'El campo calificación obtenida está vacío',
                'calificacion_obtenida.numeric' => 'El campo calificación obtenida debe ser numérico',
                'calificacion_obtenida.min' => 'La calificación debe ser entre 0-100',
                'calificacion_obtenida.max' => 'La calificación debe ser entre 0-100',
                'conocimiento.required' => 'El campo conocimiento está vacío',
                'conocimiento.numeric' => 'El campo conocimiento debe ser numérico',
                'conocimiento.min' => 'La calificación debe ser entre 0-100',
                'conocimiento.max' => 'La calificación debe ser entre 0-100',
                'categoria.required' => 'El campo categoría está vacío'
            ]
        );

        //Crear registro utilizando el modelo
        $profesor = Profesor::create($request->all());

        //Vincularlo con la tabla materias
        $profesor->subjects()->create([
            'profesor_id' => $profesor->id,
            'materia' => $request->materia,
            'nrc' => $request->nrc,
        ]);

        //Vincularlo con la tabla grades
        $profesor->grades()->create([
            'profesor_id' => $profesor->id,
            'puntualidad' => $request->puntualidad,
            'personalidad' => $request->personalidad,
            'aprendizaje_obtenido' => $request->aprendizaje_obtenido,
            'manera_evaluar' => $request->manera_evaluar,
            'calificacion_obtenida' => $request->calificacion_obtenida,
            'conocimiento' => $request->conocimiento,
            'categoria' => $request->categoria,
        ]);

        Alert::success('Profesor Agregado', 'Gracias por apoyar a la comunidad UDG');

        return redirect()->route('profesor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor)
    {
        $materias = Subject::where('profesor_id', $profesor->id)->get();
        $calificaciones = Grade::where('profesor_id', $profesor->id)->get();

        $opcion = "Busqueda Particular";

        $puntualidad = Profesor::puntualidad($calificaciones, $opcion);
        $personalidad = Profesor::personalidad($calificaciones, $opcion);
        $aprendizaje_obtenido = Profesor::aprendizaje_obtenido($calificaciones, $opcion);
        $manera_evaluar = Profesor::manera_evaluar($calificaciones, $opcion);
        $calificacion_obtenida = Profesor::calificacion_obtenida($calificaciones, $opcion);
        $conocimiento = Profesor::conocimiento($calificaciones, $opcion);

        $promedios = array();
        array_push($promedios, $puntualidad, $personalidad, $aprendizaje_obtenido, $manera_evaluar, $calificacion_obtenida, $conocimiento);
        
        $i = 0;
        foreach($promedios as $prom) {
            foreach($prom as $pr) {
                if($i==0)
                    $prueba[$i] = ['name' => 'puntualidad', 'y' => floatval($pr[0])];
                elseif($i==1)
                    $prueba[$i] = ['name' => 'personalidad', 'y' => floatval($pr[0])];
                elseif($i==2)
                    $prueba[$i] = ['name' => 'aprendizaje_obtenido', 'y' => floatval($pr[0])];
                elseif($i==3)
                    $prueba[$i] = ['name' => 'manera_evaluar', 'y' => floatval($pr[0])];
                elseif($i==4)
                    $prueba[$i] = ['name' => 'calificacion_obtenida', 'y' => floatval($pr[0])];
                elseif($i==5)
                    $prueba[$i] = ['name' => 'conocimiento', 'y' => floatval($pr[0])];
            }
            $i++;
        }
                
        //dd($prueba);

        return view('profesores.profesoresShow', compact(
            'profesor', 'materias', 'puntualidad', 'personalidad', 'aprendizaje_obtenido', 
            'manera_evaluar', 'calificacion_obtenida', 'conocimiento'), ["data" => json_encode($prueba)]);
    }

    public function show_all_dp()
    {
        $profesores = Profesor::all();

        return view('profesores.profesoresShowDP', compact('profesores'));
    }

    public function show_all_de()
    {
        $profesores = Profesor::with('subjects')->get();

        return view('profesores.profesoresShowDE', compact('profesores'));
    }

    public function show_all_dc()
    {
        $profesores = Profesor::with('grades')->get();

        return view('profesores.profesoresShowDC', compact('profesores'));
    }

    public function search(Request $request)
    {
        if($request->get('nombre') == null) {
            Alert::warning('Campo de búsqueda vacío', 'Debes escribir como mínimo una letra para realizar la búsqueda');
            return redirect()->back();
        }
        
        $search = mb_strtoupper($request->get('nombre'));
        $profesores = Profesor::with('grades')->
                    where('profesors.nombre', 'LIKE', "%$search%")->
                    orWhere('profesors.apellido_paterno', 'LIKE', "%$search%")->
                    orWhere('profesors.apellido_materno', 'LIKE', "%$search%")->get();

        $opcion = "Busqueda General";

        //Obtener promedios
        $puntualidad = Profesor::puntualidad($profesores, $opcion);
        $personalidad = Profesor::personalidad($profesores, $opcion);
        $aprendizaje_obtenido = Profesor::aprendizaje_obtenido($profesores, $opcion);
        $manera_evaluar = Profesor::manera_evaluar($profesores, $opcion);
        $calificacion_obtenida = Profesor::calificacion_obtenida($profesores, $opcion);
        $conocimiento = Profesor::conocimiento($profesores, $opcion);

        $promedios = array();
        array_push($promedios, $puntualidad, $personalidad, $aprendizaje_obtenido, $manera_evaluar, $calificacion_obtenida, $conocimiento);

        $i = 0;
        foreach($promedios as $prom) {
            foreach($prom as $pr) {
                if($i==0)
                    $prueba[$i] = ['name' => 'puntualidad', 'y' => floatval($pr[1])];
                elseif($i==1)
                    $prueba[$i] = ['name' => 'personalidad', 'y' => floatval($pr[1])];
                elseif($i==2)
                    $prueba[$i] = ['name' => 'aprendizaje_obtenido', 'y' => floatval($pr[1])];
                elseif($i==3)
                    $prueba[$i] = ['name' => 'manera_evaluar', 'y' => floatval($pr[1])];
                elseif($i==4)
                    $prueba[$i] = ['name' => 'calificacion_obtenida', 'y' => floatval($pr[1])];
                elseif($i==5)
                    $prueba[$i] = ['name' => 'conocimiento', 'y' => floatval($pr[1])];
            }
            $i++;
        }
                
        //dd($prueba);

        if(!$profesores->count())
            return view('profesores.profesoresNotFound');
        else
            return view('profesores.profesoresSearch', compact(
                'profesores', 'puntualidad', 'personalidad', 'aprendizaje_obtenido', 
                'manera_evaluar', 'calificacion_obtenida', 'conocimiento'));
    }

    public function evaluate(Profesor $profesor)
    {
        return view('profesores.profesoresEvaluate', compact('profesor'));
    }

    public function evaluation(Request $request, Profesor $profesor)
    {
        //Validar Datos
        $request->validate(
            [
            'puntualidad' => 'required|numeric|min:0|max:100',
            'personalidad' => 'required|numeric|min:0|max:100',
            'aprendizaje_obtenido' => 'required|numeric|min:0|max:100',
            'manera_evaluar' => 'required|numeric|min:0|max:100',
            'calificacion_obtenida' => 'required|numeric|min:0|max:100',
            'conocimiento' => 'required|numeric|min:0|max:100',
            'categoria' => 'required'
            ],
            [
                'puntualidad.required' => 'El campo puntualidad está vacío',
                'puntualidad.numeric' => 'El campo puntualidad debe ser numérico',
                'puntualidad.min' => 'La calificación debe ser entre 0-100',
                'puntualidad.max' => 'La calificación debe ser entre 0-100',
                'personalidad.required' => 'El campo personalidad está vacío',
                'personalidad.numeric' => 'El campo personalidad debe ser numérico',
                'personalidad.min' => 'La calificación debe ser entre 0-100',
                'personalidad.max' => 'La calificación debe ser entre 0-100',
                'aprendizaje_obtenido.required' => 'El campo aprendizaje obtenido está vacío',
                'aprendizaje_obtenido.numeric' => 'El campo aprendizaje obtenido debe ser numérico',
                'aprendizaje_obtenido.min' => 'La calificación debe ser entre 0-100',
                'aprendizaje_obtenido.max' => 'La calificación debe ser entre 0-100',
                'manera_evaluar.required' => 'El campo manera de evaluar está vacío',
                'manera_evaluar.numeric' => 'El campo manera de evaluar debe ser numérico',
                'manera_evaluar.min' => 'La calificación debe ser entre 0-100',
                'manera_evaluar.max' => 'La calificación debe ser entre 0-100',
                'calificacion_obtenida.required' => 'El campo calificación obtenida está vacío',
                'calificacion_obtenida.numeric' => 'El campo calificación obtenida debe ser numérico',
                'calificacion_obtenida.min' => 'La calificación debe ser entre 0-100',
                'calificacion_obtenida.max' => 'La calificación debe ser entre 0-100',
                'conocimiento.required' => 'El campo conocimiento está vacío',
                'conocimiento.numeric' => 'El campo conocimiento debe ser numérico',
                'conocimiento.min' => 'La calificación debe ser entre 0-100',
                'conocimiento.max' => 'La calificación debe ser entre 0-100',
                'categoria.required' => 'El campo categoría está vacío'
            ]
        );

        //Crear registro utilizando el modelo
        Grade::create([
            'profesor_id' => $profesor->id,
            'puntualidad' => $request->puntualidad,
            'personalidad' => $request->personalidad,
            'aprendizaje_obtenido' => $request->aprendizaje_obtenido,
            'manera_evaluar' => $request->manera_evaluar,
            'calificacion_obtenida' => $request->calificacion_obtenida,
            'conocimiento' => $request->conocimiento,
            'categoria' => $request->categoria
        ]);

        Alert::success('Evaluación Exitosa', 'Gracias por apoyar a la comunidad UDG');

        return redirect()->route('profesor.show', $profesor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor $profesor)
    {
        return view('profesores.profesoresEdit', compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profesor $profesor)
    {
        //Validar Datos
        $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'cu' => 'required'
        ]);

        //Actualizar registro utilizando el modelo
        Profesor::where('id', $profesor->id)->update($request->except('_method', '_token'));

        Alert::success('Profesor Editado', 'El profesor fue actualizado correctamente');

        return redirect()->route('profesor.showAllDP');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesor $profesor)
    {
        $profesor->delete();
        return redirect()->back();
    }
}
