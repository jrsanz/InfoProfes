<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\Grade;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    public function show_all_dp()
    {
        $profesores = Profesor::all();

        return view('administrador.profesoresShowDP', compact('profesores'));
    }

    public function show_all_de()
    {
        $profesores = Profesor::with('subjects')->get();

        return view('administrador.profesoresShowDE', compact('profesores'));
    }

    public function show_all_dc()
    {
        $profesores = Profesor::with('grades')->get();

        return view('administrador.profesoresShowDC', compact('profesores'));
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
            return view('administrador.profesoresSearch', compact(
                'profesores', 'puntualidad', 'personalidad', 'aprendizaje_obtenido', 
                'manera_evaluar', 'calificacion_obtenida', 'conocimiento'));
    }

    public function evaluate(Profesor $profesor)
    {
        return view('administrador.profesoresEvaluate', compact('profesor'));
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

        return redirect()->route('administrador.show', $profesor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
