<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profesor;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        $usuarios = User::all()->count();
        $mi_usuario = User::where('id', Auth::user()->id)->get();
        $profesores = Profesor::all()->count();
        $profesores_verificados = Profesor::where('verificado', 1)->count();
        $calificaciones = Grade::all()->count();

        $profesores_cucei = Profesor::where('cu', 'CUCEI')->count();
        $profesores_cucea = Profesor::where('cu', 'CUCEA')->count();
        $profesores_cucs = Profesor::where('cu', 'CUCS')->count();
        $profesores_cuaad = Profesor::where('cu', 'CUAAD')->count();
        $profesores_cucba = Profesor::where('cu', 'CUCBA')->count();
        $profesores_cucsh = Profesor::where('cu', 'CUCSH')->count();

        $verificados[0] = ['name' => 'No Verificados', 'y' => $profesores];
        $verificados[1] = ['name' => 'Verificados', 'y' => $profesores_verificados];

        $profesores_cu[0] = ['name' => 'CUCEI', 'y' => $profesores_cucei];
        $profesores_cu[1] = ['name' => 'CUCEA', 'y' => $profesores_cucea];
        $profesores_cu[2] = ['name' => 'CUCS', 'y' => $profesores_cucs];
        $profesores_cu[3] = ['name' => 'CUAAD', 'y' => $profesores_cuaad];
        $profesores_cu[4] = ['name' => 'CUCBA', 'y' => $profesores_cucba];
        $profesores_cu[5] = ['name' => 'CUCSH', 'y' => $profesores_cucsh];

        return view('administrador.dashboard', compact('usuarios', 'profesores', 'calificaciones', 'mi_usuario'), ["verificados" => json_encode($verificados), "centro_univ" => json_encode($profesores_cu)]);
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

    public function profesor_create()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        return view('administrador.profesoresForm');
    }

    public function profesor_store(Request $request)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
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
                'nombre.required' => 'El campo nombre est?? vac??o',
                'nombre.regex' => 'El campo nombre solo acepta letras',
                'apellido_paterno.required' => 'El campo apellido paterno est?? vac??o',
                'apellido_paterno.regex' => 'El campo apellido paterno solo acepta letras',
                'apellido_materno.required' => 'El campo apellido materno est?? vac??o',
                'apellido_materno.regex' => 'El campo apellido materno solo acepta letras',
                'cu.required' => 'El campo centro universitario est?? vac??o',

                'materia.required' => 'El campo materia est?? vac??o',
                'materia.min' => 'La materia debe tener m??nimo 5 caracteres',
                'materia.max' => 'La materia debe tener m??ximo 10 caracteres',
                'materia.alpha_num' => 'La materia no puede incluir espacios',
                'nrc.required' => 'El campo nrc est?? vac??o',
                'nrc.numeric' => 'El nrc debe ser un n??mero',
                'nrc.min' => 'El nrc debe tener m??nimo 5 n??meros',
                'nrc.max' => 'El nrc debe tener m??ximo 6 n??meros',

                'puntualidad.required' => 'El campo puntualidad est?? vac??o',
                'puntualidad.numeric' => 'El campo puntualidad debe ser num??rico',
                'puntualidad.min' => 'La calificaci??n debe ser entre 0-100',
                'puntualidad.max' => 'La calificaci??n debe ser entre 0-100',
                'personalidad.required' => 'El campo personalidad est?? vac??o',
                'personalidad.numeric' => 'El campo personalidad debe ser num??rico',
                'personalidad.min' => 'La calificaci??n debe ser entre 0-100',
                'personalidad.max' => 'La calificaci??n debe ser entre 0-100',
                'aprendizaje_obtenido.required' => 'El campo aprendizaje obtenido est?? vac??o',
                'aprendizaje_obtenido.numeric' => 'El campo aprendizaje obtenido debe ser num??rico',
                'aprendizaje_obtenido.min' => 'La calificaci??n debe ser entre 0-100',
                'aprendizaje_obtenido.max' => 'La calificaci??n debe ser entre 0-100',
                'manera_evaluar.required' => 'El campo manera de evaluar est?? vac??o',
                'manera_evaluar.numeric' => 'El campo manera de evaluar debe ser num??rico',
                'manera_evaluar.min' => 'La calificaci??n debe ser entre 0-100',
                'manera_evaluar.max' => 'La calificaci??n debe ser entre 0-100',
                'calificacion_obtenida.required' => 'El campo calificaci??n obtenida est?? vac??o',
                'calificacion_obtenida.numeric' => 'El campo calificaci??n obtenida debe ser num??rico',
                'calificacion_obtenida.min' => 'La calificaci??n debe ser entre 0-100',
                'calificacion_obtenida.max' => 'La calificaci??n debe ser entre 0-100',
                'conocimiento.required' => 'El campo conocimiento est?? vac??o',
                'conocimiento.numeric' => 'El campo conocimiento debe ser num??rico',
                'conocimiento.min' => 'La calificaci??n debe ser entre 0-100',
                'conocimiento.max' => 'La calificaci??n debe ser entre 0-100',
                'categoria.required' => 'El campo categor??a est?? vac??o',
                'comentario.required' => 'Apoyanos escribiendo tu opini??n sobre este profesor'
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

        return redirect()->route('admin.profesorShow', compact('profesor'));
    }

    public function profesor_show(Profesor $profesor)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
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

        return view('administrador.profesoresShow', compact(
            'profesor', 'materias', 'calificaciones', 'usuarios', 'puntualidad', 'personalidad', 'aprendizaje_obtenido', 
            'manera_evaluar', 'calificacion_obtenida', 'conocimiento'), ["data" => json_encode($prueba)]);
    }

    public function show_all_dp()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        $profesores = Profesor::all();

        return view('administrador.profesoresShowDP', compact('profesores'));
    }

    public function show_all_de()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        $profesores = Profesor::with('subjects')->get();

        return view('administrador.profesoresShowDE', compact('profesores'));
    }

    public function show_all_dc()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        $profesores = Profesor::with('grades')->get();

        return view('administrador.profesoresShowDC', compact('profesores'));
    }

    public function user_all()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        $usuarios = User::all();

        return view('administrador.usuariosShowAll', compact('usuarios'));
    }

    public function search()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        return view('administrador.profesoresSearch');
    }

    public function profesor_find(Request $request)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        if($request->get('nombre') == null) {
            Alert::warning('Campo de b??squeda vac??o', 'Debes escribir como m??nimo una letra para realizar la b??squeda');
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
            return view('administrador.profesoresNotFound');
        else
            return view('administrador.profesoresFind', compact(
                'profesores', 'puntualidad', 'personalidad', 'aprendizaje_obtenido', 
                'manera_evaluar', 'calificacion_obtenida', 'conocimiento', 'promedios'));
    }

    public function evaluate(Profesor $profesor)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        return view('administrador.profesoresEvaluate', compact('profesor'));
    }

    public function evaluation(Request $request, Profesor $profesor)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
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
            'categoria' => 'required'
            ],
            [
                'puntualidad.required' => 'El campo puntualidad est?? vac??o',
                'puntualidad.numeric' => 'El campo puntualidad debe ser num??rico',
                'puntualidad.min' => 'La calificaci??n debe ser entre 0-100',
                'puntualidad.max' => 'La calificaci??n debe ser entre 0-100',
                'personalidad.required' => 'El campo personalidad est?? vac??o',
                'personalidad.numeric' => 'El campo personalidad debe ser num??rico',
                'personalidad.min' => 'La calificaci??n debe ser entre 0-100',
                'personalidad.max' => 'La calificaci??n debe ser entre 0-100',
                'aprendizaje_obtenido.required' => 'El campo aprendizaje obtenido est?? vac??o',
                'aprendizaje_obtenido.numeric' => 'El campo aprendizaje obtenido debe ser num??rico',
                'aprendizaje_obtenido.min' => 'La calificaci??n debe ser entre 0-100',
                'aprendizaje_obtenido.max' => 'La calificaci??n debe ser entre 0-100',
                'manera_evaluar.required' => 'El campo manera de evaluar est?? vac??o',
                'manera_evaluar.numeric' => 'El campo manera de evaluar debe ser num??rico',
                'manera_evaluar.min' => 'La calificaci??n debe ser entre 0-100',
                'manera_evaluar.max' => 'La calificaci??n debe ser entre 0-100',
                'calificacion_obtenida.required' => 'El campo calificaci??n obtenida est?? vac??o',
                'calificacion_obtenida.numeric' => 'El campo calificaci??n obtenida debe ser num??rico',
                'calificacion_obtenida.min' => 'La calificaci??n debe ser entre 0-100',
                'calificacion_obtenida.max' => 'La calificaci??n debe ser entre 0-100',
                'conocimiento.required' => 'El campo conocimiento est?? vac??o',
                'conocimiento.numeric' => 'El campo conocimiento debe ser num??rico',
                'conocimiento.min' => 'La calificaci??n debe ser entre 0-100',
                'conocimiento.max' => 'La calificaci??n debe ser entre 0-100',
                'categoria.required' => 'El campo categor??a est?? vac??o'
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

        Alert::success('Evaluaci??n Exitosa', 'Gracias por apoyar a la comunidad UDG');

        return redirect()->route('admin.profesorShow', $profesor);
    }

    public function usuario_edit(User $usuario)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        return view('administrador.usuarioEdit', compact('usuario'));   
    }

    public function usuario_update(Request $request, User $usuario)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        //Validar Datos
        $request->validate(
            [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'type_of_user' => 'required'
            ],
            [
                'name.required' => 'El campo nombre est?? vac??o',
                'name.regex' => 'El campo nombre solo acepta letras',
                'email.required' => 'El campo correo electr??nico est?? vac??o',
                'email.email' => 'Escribe un correo electr??nico v??lido',
                'type_of_user.required' => 'El campo tipo de usuario est?? vac??o',
            ]
        );

        //Actualizar registro utilizando el modelo
        User::where('id', $usuario->id)->update($request->except(
            '_method', '_token', 'email_verified_at', 'password', 'two_factor_secret', 'two_factor_recovery_codes',
            'remember_token', 'current_team_id', 'profile_photo_path', 'created_at'));

        Alert::success('Usuario Editado', 'Permisos actualizados con ??xito');

        return redirect()->route('admin.usuarios');
    }

    public function reporte_usuarios()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        $usuarios = User::all();

        $pdf = PDF::loadView('reportes.reporteUsuarios', compact('usuarios'));
        return $pdf->stream();
    }

    public function reporte_profesores()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        $profesores = Profesor::all();

        $pdf = PDF::loadView('reportes.reporteProfesores', compact('profesores'));
        return $pdf->stream();
    }

    public function create_materia(Profesor $profesor)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        return view('administrador.profesorCreateMateria', compact('profesor'));
    }

    public function store_materia(Request $request, Profesor $profesor)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        //Validar Datos
        $request->validate(
            [
            'materia' => 'required|alpha_num|min:5|max:10',
            'nrc' => 'required|numeric|min:10000|max:999999'
            ],
            [
                'materia.required' => 'El campo materia est?? vac??o',
                'materia.min' => 'La materia debe tener m??nimo 5 caracteres',
                'materia.max' => 'La materia debe tener m??ximo 10 caracteres',
                'materia.alpha_num' => 'La materia no puede incluir espacios',
                'nrc.required' => 'El campo nrc est?? vac??o',
                'nrc.numeric' => 'El nrc debe ser un n??mero',
                'nrc.min' => 'El nrc debe tener m??nimo 5 n??meros',
                'nrc.max' => 'El nrc debe tener m??ximo 6 n??meros'
            ]
        );

        //Crear registro utilizando la relaci??n
        $profesor->subjects()->create([
            'profesor_id' => $profesor->id,
            'materia' => $request->materia,
            'nrc' => $request->nrc,
        ]);

        Alert::success('Materia Agregada', 'Gracias por apoyar a la comunidad UDG');

        return redirect()->route('admin.profesorShow', compact('profesor'));
    }

    public function mi_perfil()
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        $usuarios = User::where('id', Auth::user()->id)->get();

        foreach($usuarios as $usuario)
            $user = $usuario;

        return view('administrador.miPerfil', compact('user'));
    }

    public function update_mi_perfil(Request $request, User $usuario)
    {
        if(!Auth::check() || Auth::user()->type_of_user != "admin")
            return abort(404);

        //Validar Datos
        $request->validate(
            [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            ],
            [
                'name.required' => 'El campo nombre est?? vac??o',
                'name.regex' => 'El campo nombre solo acepta letras',
                'email.required' => 'El campo correo electr??nico est?? vac??o',
                'email.email' => 'Escribe un correo electr??nico v??lido',
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

        return redirect()->route('admin.index');
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
