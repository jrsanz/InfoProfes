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
        return view('profesores/profesoresIndex');
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
        $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'cu' => 'required',

            'materia' => 'required|alpha_num',
            'nrc' => 'required|numeric',

            'puntualidad' => 'required|numeric',
            'personalidad' => 'required|numeric',
            'aprendizaje_obtenido' => 'required|numeric',
            'manera_evaluar' => 'required|numeric',
            'calificacion_obtenida' => 'required|numeric',
            'conocimiento' => 'required|numeric',
            'categoria' => 'required|alpha'
        ]);

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

        return view('profesores.profesoresShow', compact('profesor', 'materias'));
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
        $search = mb_strtoupper($request->get('nombre'));
        $profesores = Profesor::with('grades')->
                    where('profesors.nombre', 'LIKE', "%$search%")->
                    orWhere('profesors.apellido_paterno', 'LIKE', "%$search%")->
                    orWhere('profesors.apellido_materno', 'LIKE', "%$search%")->get();

        $a = array();
        $b = array();
        $c = array();
        $d = array();
        $e = array();
        $f = array();
        $g = array();
        
        foreach($profesores as $profesor) {
            array_push($a, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('puntualidad'));
            array_push($b, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('personalidad'));
            array_push($c, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('aprendizaje_obtenido'));
            array_push($d, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('manera_evaluar'));
            array_push($e, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('calificacion_obtenida'));
            array_push($f, $profesor->id, DB::table('grades')->where('profesor_id', $profesor->id)->avg('conocimiento'));
        }

        $puntualidad = array_chunk($a, 2);
        $personalidad = array_chunk($b, 2);
        $aprendizaje_obtenido = array_chunk($c, 2);
        $manera_evaluar = array_chunk($d, 2);
        $calificacion_obtenida = array_chunk($e, 2);
        $conocimiento = array_chunk($f, 2);

        //dd($profesores);
        //dd($puntualidad);
        //dd($calificaciones_promedio);

        if(!$profesores->count())
            return view('profesores.profesoresNotFound');
        else
            return view('profesores.profesoresSearch', compact(
                'profesores', 'puntualidad', 'personalidad', 'aprendizaje_obtenido', 
                'manera_evaluar', 'calificacion_obtenida', 'conocimiento'));
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

        return redirect()->route('profesor.showAll');
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
