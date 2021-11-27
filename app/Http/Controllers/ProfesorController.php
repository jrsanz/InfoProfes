<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Profesor;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return redirect()->route('admin.index');

        $top_10 = DB::table('grades')->join('profesors', 'grades.profesor_id', '=', 'profesors.id')
            ->select('grades.profesor_id', 'profesors.nombre', 'profesors.apellido_paterno', 'profesors.apellido_materno','profesors.cu',
            DB::raw(
            'AVG(grades.puntualidad + grades.personalidad + grades.aprendizaje_obtenido + grades.manera_evaluar +
            grades.calificacion_obtenida + grades.conocimiento)/6 as promedio'
            ))->groupBy('grades.profesor_id')->orderBy('promedio', 'desc')->limit(10)->get();

        return view('profesores.profesoresIndex', compact('top_10'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

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
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

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
            'categoria' => 'required',
            'comentario' => 'required'
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
                'nrc.numeric' => 'El nrc debe ser un número',
                'nrc.min' => 'El nrc debe tener mínimo 5 números',
                'nrc.max' => 'El nrc debe tener máximo 6 números',
                'nrc.required' => 'El campo nrc está vacío',

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
                'categoria.required' => 'El campo categoría está vacío',
                'comentario.required' => 'Apoyanos escribiendo tu opinión sobre este profesor'
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
            'user_id' => (Auth::check()) ? Auth::user()->id : '1',
            'puntualidad' => $request->puntualidad,
            'personalidad' => $request->personalidad,
            'aprendizaje_obtenido' => $request->aprendizaje_obtenido,
            'manera_evaluar' => $request->manera_evaluar,
            'calificacion_obtenida' => $request->calificacion_obtenida,
            'conocimiento' => $request->conocimiento,
            'categoria' => $request->categoria,
            'comentario' => $request->comentario,
        ]);

        Alert::success('Profesor Agregado', 'Gracias por apoyar a la comunidad UDG');

        return redirect()->route('profesor.show', compact('profesor'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor)
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);
        
        $usuarios = User::all();
        $materias = Subject::where('profesor_id', $profesor->id)->get();
        $calificaciones = Grade::where('profesor_id', $profesor->id)->orderBy('created_at', 'desc')->get();

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
        foreach($promedios as $promedio) {
            foreach($promedio as $prom) {
                if($i==0)
                    $grafica[$i] = ['name' => 'puntualidad', 'y' => floatval($prom[0])];
                elseif($i==1)
                    $grafica[$i] = ['name' => 'personalidad', 'y' => floatval($prom[0])];
                elseif($i==2)
                    $grafica[$i] = ['name' => 'aprendizaje_obtenido', 'y' => floatval($prom[0])];
                elseif($i==3)
                    $grafica[$i] = ['name' => 'manera_evaluar', 'y' => floatval($prom[0])];
                elseif($i==4)
                    $grafica[$i] = ['name' => 'calificacion_obtenida', 'y' => floatval($prom[0])];
                elseif($i==5)
                    $grafica[$i] = ['name' => 'conocimiento', 'y' => floatval($prom[0])];
            }
            $i++;
        }

        return view('profesores.profesoresShow', compact(
            'profesor', 'materias', 'calificaciones', 'usuarios', 'puntualidad', 'personalidad', 'aprendizaje_obtenido', 
            'manera_evaluar', 'calificacion_obtenida', 'conocimiento'), ["data" => json_encode($grafica)]);
    }

    public function show_all_dp()
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        $profesores = Profesor::all();

        return view('profesores.profesoresShowDP', compact('profesores'));
    }

    public function show_all_de()
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        $profesores = Profesor::with('subjects')->get();

        return view('profesores.profesoresShowDE', compact('profesores'));
    }

    public function show_all_dc()
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        $profesores = Profesor::with('grades')->get();

        return view('profesores.profesoresShowDC', compact('profesores'));
    }

    public function search(Request $request)
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

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

        $i=0;
        foreach($profesores as $profesor) {

        $promedios[$i] = DB::table('grades')->join('profesors', 'grades.profesor_id', '=', 'profesors.id')
            ->select('grades.profesor_id',
            DB::raw(
            'AVG(grades.puntualidad + grades.personalidad + grades.aprendizaje_obtenido + grades.manera_evaluar +
            grades.calificacion_obtenida + grades.conocimiento)/6 as promedio'
            ))->where('grades.profesor_id', '=', $profesor->id)->groupBy('grades.profesor_id')->orderBy('promedio', 'desc')->get();
            $i++;
        }

        if(!$profesores->count())
            return view('profesores.profesoresNotFound');
        else
            return view('profesores.profesoresSearch', compact(
                'profesores', 'puntualidad', 'personalidad', 'aprendizaje_obtenido', 
                'manera_evaluar', 'calificacion_obtenida', 'conocimiento', 'promedios'));
    }

    public function evaluate(Profesor $profesor)
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        return view('profesores.profesoresEvaluate', compact('profesor'));
    }

    public function evaluation(Request $request, Profesor $profesor)
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        //Validar Datos
        $request->validate(
            [
            'puntualidad' => 'required|numeric|min:0|max:100',
            'personalidad' => 'required|numeric|min:0|max:100',
            'aprendizaje_obtenido' => 'required|numeric|min:0|max:100',
            'manera_evaluar' => 'required|numeric|min:0|max:100',
            'calificacion_obtenida' => 'required|numeric|min:0|max:100',
            'conocimiento' => 'required|numeric|min:0|max:100',
            'categoria' => 'required',
            'comentario' => 'required'
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
                'categoria.required' => 'El campo categoría está vacío',
                'comentario.required' => 'Apoyanos escribiendo tu opinión sobre este profesor'
            ]
        );
        
        //Crear registro utilizando el modelo
        Grade::create([
            'profesor_id' => $profesor->id,
            'user_id' => (Auth::check()) ? Auth::user()->id : '1',
            'puntualidad' => $request->puntualidad,
            'personalidad' => $request->personalidad,
            'aprendizaje_obtenido' => $request->aprendizaje_obtenido,
            'manera_evaluar' => $request->manera_evaluar,
            'calificacion_obtenida' => $request->calificacion_obtenida,
            'conocimiento' => $request->conocimiento,
            'categoria' => $request->categoria,
            'comentario' => $request->comentario
        ]);

        Alert::success('Evaluación Exitosa', 'Gracias por apoyar a la comunidad UDG');

        return redirect()->route('profesor.show', $profesor);
    }

    public function create_materia(Profesor $profesor)
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        return view('profesores.profesoresCreateMateria', compact('profesor'));
    }

    public function store_materia(Request $request, Profesor $profesor)
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        //Validar Datos
        $request->validate(
            [
            'materia' => 'required|alpha_num|min:5|max:10',
            'nrc' => 'required|numeric|min:10000|max:999999'
            ],
            [
                'materia.required' => 'El campo materia está vacío',
                'materia.min' => 'La materia debe tener mínimo 5 caracteres',
                'materia.max' => 'La materia debe tener máximo 10 caracteres',
                'materia.alpha_num' => 'La materia no puede incluir espacios',
                'nrc.required' => 'El campo nrc está vacío',
                'nrc.numeric' => 'El nrc debe ser un número',
                'nrc.min' => 'El nrc debe tener mínimo 5 números',
                'nrc.max' => 'El nrc debe tener máximo 6 números'
            ]
        );

        //Crear registro utilizando la relación
        $profesor->subjects()->create([
            'profesor_id' => $profesor->id,
            'materia' => $request->materia,
            'nrc' => $request->nrc,
        ]);

        Alert::success('Materia Agregada', 'Gracias por apoyar a la comunidad UDG');

        return redirect()->route('profesor.show', compact('profesor'));
    }

    public function mi_perfil()
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        $usuarios = User::where('id', Auth::user()->id)->get();

        foreach($usuarios as $usuario)
            $user = $usuario;

        return view('profesores.miPerfil', compact('user'));
    }

    public function update_mi_perfil(Request $request, User $usuario)
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        //Validar Datos
        $request->validate(
            [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            ],
            [
                'name.required' => 'El campo nombre está vacío',
                'name.regex' => 'El campo nombre solo acepta letras',
                'email.required' => 'El campo correo electrónico está vacío',
                'email.email' => 'Escribe un correo electrónico válido',
            ]
        );

        //Storage::disk('public')->delete('/img/avatares/' . Auth::user()->profile_photo_path);

        if($request->profile_photo_path == null)
            $nombre = '';
        else {
            $imagen = $request->file('profile_photo_path');
            $nombre = time() . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path('img\avatares');
            $ruta = $request->profile_photo_path->move($destino, $nombre);
        }

        //Actualizar registro utilizando el modelo
        User::where('id', $usuario->id)->update(['name' => $request->name, 'email' => $request->email, 'profile_photo_path' => $nombre]);

        Alert::success('Usuario Editado', 'Datos Actualizados Exitosamente');

        return redirect()->route('profesor.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor $profesor)
    {
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

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
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

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
        if(Auth::check() && Auth::user()->type_of_user == "admin")
            return abort(404);

        $profesor->delete();
        return redirect()->back();
    }
}
