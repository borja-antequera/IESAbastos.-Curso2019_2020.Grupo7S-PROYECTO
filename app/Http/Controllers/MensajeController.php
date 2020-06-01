<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use agendaInfantil\Mensaje;
use agendaInfantil\Centro;
use agendaInfantil\Aula;
use agendaInfantil\User;
use agendaInfantil\Nino;

class MensajeController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Hola desde Mensaje Controller";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mensajes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtenemos el id del usuario logueado
        $usuario_admin = auth()->user()->id;
        // Obtenemos los datos del usuario del modelo con el id
        $usuario_actual = User::find($usuario_admin);
        // Obtenemos el rol del usuario
        $rol = $usuario_actual->rol_id;
        // Obtenemos el tipo de mensaje del formulario de la vista - pasado por imput hidden
        $tipo_mensaje_id = $request->input('tipo_mensaje_id');

        /* Mensaje Difusión por Centro*/
        /* Si es director y el tipo de mensaje es 1 */
        if($rol == 1 && $tipo_mensaje_id == 1){
            $mensaje_texto = $request->input('mensaje');
            $slug_centro = $request->input('centro_slug');
            $centro = Centro::CentroPorSlug($slug_centro);
            $aulas = Centro::AulasCentro($centro->id);

            // Controlamos que el centro tenga aulas, para evitar el error
            if(count($aulas) > 0){
                foreach($aulas as $aula){
                    // Iteramos por cada aula para obtener el o los profesores del aula
                    $profesores = Aula::ProfesoresAula($aula->id);
                    foreach($profesores as $profesor){
                        // Iteramos sobre cada profesor del aula y guardamos los datos del mensaje
                        $mensaje = new Mensaje();
                        $mensaje->tipo_mensaje_id = $tipo_mensaje_id;
                        $mensaje->emisor_id = $usuario_admin;
                        $mensaje->receptor_id = $profesor->user_id;
                        $mensaje->mensaje = $mensaje_texto;
                        $mensaje->save();
                    }
                    // Iteramos sobre cada alumno del aula para obtener los ids de sus tutores
                    // y guardamos los datos del mensaje
                    $alumnos_tutores = Aula::AlumnosAula($aula->id);
                    foreach($alumnos_tutores as $alumno){
                        $mensaje = new Mensaje();
                        $mensaje->tipo_mensaje_id = $tipo_mensaje_id;
                        $mensaje->emisor_id = $usuario_admin;
                        $mensaje->receptor_id = $alumno->usuario_id;
                        $mensaje->mensaje = $mensaje_texto;
                        $mensaje->save();
                    }

                }
            }
            // Devolvemos la vista de mensajes del centro
            return redirect('/mensajes/centro/'.$slug_centro);

        }

        /*¡ Mensaje Privado de Director a Tutor */

        if($rol == 1 && $tipo_mensaje_id == 3){

            $receptor_id = $request->input('receptor_id');
            $mensaje_texto = $request->input('mensaje');

            $mensaje = new Mensaje();
            $mensaje->tipo_mensaje_id = $tipo_mensaje_id;
            $mensaje->emisor_id = $usuario_admin;
            $mensaje->receptor_id = $receptor_id;
            $mensaje->mensaje = $mensaje_texto;
            $mensaje->save();

            return redirect('/mensajes/director/tutor/'.$receptor_id);
            
        }

        /* Mensaje Difusión por Aula*/
        /* Si es educador y el tipo de mensaje es 2 */
        if($rol == 2 && $tipo_mensaje_id == 2){

            $mensaje_texto = $request->input('mensaje');
            $slug_aula = $request->input('aula_slug');
            $aula_actual = DB::select('SELECT * FROM aulas WHERE aula_slug = "'.$slug_aula.'" LIMIT 1');
            $aula = $aula_actual[0];

            $alumnos_tutores = Aula::AlumnosAula($aula->id);
            foreach($alumnos_tutores as $alumno){
                // Iteramos sobre cada alumno del aula para obtener los ids de sus tutores
                // y guardamos los datos del mensaje
                $mensaje = new Mensaje();
                $mensaje->tipo_mensaje_id = $tipo_mensaje_id;
                $mensaje->emisor_id = $usuario_admin;
                $mensaje->receptor_id = $alumno->usuario_id;
                $mensaje->mensaje = $mensaje_texto;
                $mensaje->save();
            }

            return redirect('/mensajes/aulas/'.$slug_aula);

        }

        /* Mensaje Privado del profesor al tutor */
        /* Si es educador y el tipo de mensaje es 3 */
        if($rol == 2 && $tipo_mensaje_id == 3){

            $receptor_id = $request->input('receptor_id');
            $mensaje_texto = $request->input('mensaje');

            $mensaje = new Mensaje();
            $mensaje->tipo_mensaje_id = $tipo_mensaje_id;
            $mensaje->emisor_id = $usuario_admin;
            $mensaje->receptor_id = $receptor_id;
            $mensaje->mensaje = $mensaje_texto;
            $mensaje->save();

            return redirect('/mensajes/profesor/tutor/'.$receptor_id);
            
        }
        /* Si es tutor y el tipo de mensaje es 3 */
        if($rol == 3 && $tipo_mensaje_id == 3){
            $receptor_id = $request->input('receptor_id');
            $mensaje_texto = $request->input('mensaje');

            $mensaje = new Mensaje();
            $mensaje->tipo_mensaje_id = $tipo_mensaje_id;
            $mensaje->emisor_id = $usuario_admin;
            $mensaje->receptor_id = $receptor_id;
            $mensaje->mensaje = $mensaje_texto;
            $mensaje->save();

            $rol_receptor = User::find($receptor_id)->rol_id;
         
            if($rol_receptor == 1){
                return redirect('/mensajes/tutor/director/'.$receptor_id);
            }else{
                return redirect('/mensajes/tutor/profesor/'.$receptor_id);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // Mensajes de difusión del centro (director)
    public function mensajeDifusionCentro($slug){
        $centro_slug = $slug;
        // Tomamos el id del usuario logueado
        $usuario_admin = auth()->user()->id;
        // Guardamos en $mensajes todos los mensajes donde el emisor es el usuario logueado --> Agrupando por mensaje 
        // para no pintar registros repetidos en la vista
        $mensajes = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$usuario_admin.' AND tipo_mensaje_id = 1 GROUP BY mensaje ORDER BY created_at ASC');

        // Devolvemos la vista con parámetros
        return view('mensajes.difusion-admin')->with('centro_slug',$slug)->with('mensajes',$mensajes);
    }
    // Mensajes de difusión del aula (educador)
    public function mensajeProfesorAulas($slug){
        // Tomamos el id del usuario logueado
        $usuario_admin = auth()->user()->id;
        // Obtenemos los datos del aula del modelo a través del slug pasado por parámetro
        $aula = DB::select('SELECT * FROM aulas WHERE aula_slug = "'.$slug.'" LIMIT 1');
        
        //mensajes de difusión perteneciente al centro asociado al aula
        $mensajes_difusion_centro = DB::select('SELECT * FROM mensajes WHERE receptor_id = '.$usuario_admin.' AND tipo_mensaje_id = 1 ORDER BY created_at ASC');
        // Guardamos en $mensajes todos los mensajes donde el emisor es el usuario logueado --> Agrupando por mensaje 
        // para no pintar registros repetidos en la vista
        $mensajes = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$usuario_admin.' AND tipo_mensaje_id = 2 GROUP BY mensaje ORDER BY created_at ASC');

        $resultado = array_merge($mensajes_difusion_centro, $mensajes);
        // Ordenamos los mensajes por orden de creación
        $nuevo_array =  Arr::sort($resultado);

        // Devolvemos la vista con parámetros
        return view('aulas.mensaje-difusion')
        ->with('aula_nombre',$aula[0]->aula_nombre)
        ->with('aula_slug',$slug)->with('mensajes',$nuevo_array)
        ->with('emisor_id',$usuario_admin);
    }

    public function mensajeProfesorTutor($id){
        // Almacenamos los datos del tutor al que está destinado el mensaje
        $tutor = User::find($id);
        // Tomamos el id del usuario logueado
        $usuario_admin = auth()->user()->id;
        // Guardamos los mensajes de tipo privado donde el emisor es el usuario profesor logueado y el receptor es el padre del que tenemos el id ordenados ascendentemente
        $mensajes_profesor_tutor = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$usuario_admin.' AND receptor_id = '.$id.' AND tipo_mensaje_id = 3 ORDER BY created_at ASC');
        // Guardamos los mensajes de tipo privado donde el emisor es el padre del que tenemos el id  y el receptor es el profesor logueado ordenados ascendentemente
        $mensajes_tutor_profesor = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$id.' AND receptor_id = '.$usuario_admin.' AND tipo_mensaje_id = 3 ORDER BY created_at ASC');
        // Fusionamos los dos arrays en uno nuevo
        $resultado = array_merge($mensajes_profesor_tutor, $mensajes_tutor_profesor);
        // Ordenamos los mensajes por orden de creación
        $nuevo_array =  Arr::sort($resultado);
        
        // Actualizamos el estado de los mensajes a leídos entre emisor y receptor
        foreach ($nuevo_array as $mensaje){
            DB::select("UPDATE mensajes set estado = 1 where estado = 0 AND emisor_id = $id AND receptor_id = $usuario_admin ");
        }
        // Devolvemos la vista con parámetros
        return view('mensajes.mensaje-profesor-tutor')->with('tutor',$tutor)
        ->with('mensajes_profesor_tutor',$nuevo_array)
        ->with('emisor_id',$usuario_admin)
        ->with('receptor_id',$id);
    }


    public function mensajeTutorProfesores($id){
        $usuario_login = auth()->user()->id;
        $nino = Nino::find($id);
        $aula_nino = Aula::find($nino->aula_id);
        // Almacenamos los profesores del aula con el método específico del modelo
        $profesores = Aula::ProfesoresDetalleAula($aula_nino->id);

        $centro = Centro::find($aula_nino->aula_centro_id);
        $director = User::find($centro->director_id);
        
        // Devolvemos la vista con parámetros
        return view('tutor.listado-profesores-nino')->with('nino',$nino)->with('profesores',$profesores)->with('director',$director);
    }

    public function mensajeTutorProfesor($id){
        // Almacenamos los datos del profesor destinatario
        $profesor = User::find($id);
        // Almacenamos el id del usuario logueado
        $usuario_login = auth()->user()->id;

        // Guardamos los mensajes de tipo privado donde el emisor es el usuario profesor logueado y el receptor es el padre del que tenemos el id ordenados ascendentemente
        $mensajes_tutor_profesor = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$usuario_login.' AND receptor_id = '.$id.' AND tipo_mensaje_id = 3 ORDER BY created_at ASC');
        // Guardamos los mensajes de tipo privado donde el emisor es el padre del que tenemos el id  y el receptor es el profesor logueado ordenados ascendentemente
        $mensajes_profesor_tutor = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$id.' AND receptor_id = '.$usuario_login.' AND tipo_mensaje_id = 3 ORDER BY created_at ASC');
        // Fusionamos los dos arrays en uno nuevo
        $resultado = array_merge($mensajes_tutor_profesor,$mensajes_profesor_tutor);
        // Ordenamos los mensajes por orden de creación
        $nuevo_array =  Arr::sort($resultado);
        // Almacenamos los mensajes de difusión del centro para mandarlos a la vista
        $mensajes_difusion_centro = DB::select('SELECT * FROM mensajes WHERE receptor_id = '.$usuario_login.' AND tipo_mensaje_id = 1 ORDER BY created_at ASC');
        // Almacenamos los mensajes de difusión del aula para mandarlos a la vista
        $mensajes_difusion_aula = DB::select('SELECT * FROM mensajes WHERE receptor_id = '.$usuario_login.' AND tipo_mensaje_id = 2 ORDER BY created_at ASC');
        // Fusionamos los dos últimos arrays en otro nuevo
        $resultado1 = array_merge($mensajes_difusion_centro, $mensajes_difusion_aula);
        // Ordenamos los mensajes por orden de creación
        $nuevo_array1 =  Arr::sort($resultado1);
        // Fusionamos los dos arrays resultantes para que aparezca todo en uno
        $mensajes_todos = array_merge($nuevo_array, $nuevo_array1);
        // Ordenamos el array final por fecha de creación
        $nuevo_array_todos =  Arr::sort($mensajes_todos);

        // Actualizamos el estado de los mensajes a leídos entre emisor y receptor
        foreach ($nuevo_array_todos as $mensaje){
            DB::select("UPDATE mensajes set estado = 1 where estado = 0 AND emisor_id = $id AND receptor_id = $usuario_login ");
        }

        // Devolvemos la vista con parámetros
        return view('mensajes.mensaje-tutor-profesor')->with('profesor',$profesor)
        ->with('mensajes_tutor_profesor',$nuevo_array_todos)
        ->with('emisor_id',$usuario_login)
        ->with('receptor_id',$id);
    }

    public function mensajeTutorDirector($id){
        // Almacenamos los datos del profesor destinatario
        $director = User::find($id);
        // Almacenamos el id del usuario logueado
        $usuario_login = auth()->user()->id;

        // Guardamos los mensajes de tipo privado donde el emisor es el usuario profesor logueado y el receptor es el padre del que tenemos el id ordenados ascendentemente
        $mensajes_tutor_director = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$usuario_login.' AND receptor_id = '.$id.' AND tipo_mensaje_id = 3 ORDER BY created_at ASC');
        // Guardamos los mensajes de tipo privado donde el emisor es el padre del que tenemos el id  y el receptor es el profesor logueado ordenados ascendentemente
        $mensajes_director_tutor = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$id.' AND receptor_id = '.$usuario_login.' AND tipo_mensaje_id = 3 ORDER BY created_at ASC');
        // Fusionamos los dos arrays en uno nuevo
        $resultado = array_merge($mensajes_tutor_director,$mensajes_director_tutor);
        // Ordenamos los mensajes por orden de creación
        $nuevo_array =  Arr::sort($resultado);
        // Almacenamos los mensajes de difusión del centro para mandarlos a la vista
       
        // Actualizamos el estado de los mensajes a leídos entre emisor y receptor
        foreach ($nuevo_array as $mensaje){
            DB::select("UPDATE mensajes set estado = 1 where estado = 0 AND emisor_id = $id AND receptor_id = $usuario_login ");
        }
        // Devolvemos la vista con parámetros
        return view('mensajes.mensaje-tutor-director')->with('director',$director)
        ->with('mensajes_tutor_director',$nuevo_array)
        ->with('emisor_id',$usuario_login)
        ->with('receptor_id',$id);
    }

    public function mensajeDirectorTutor($id){
        // Almacenamos los datos del profesor destinatario
        $tutor = User::find($id);
        // Almacenamos el id del usuario logueado
        $usuario_login = auth()->user()->id;

        // Guardamos los mensajes de tipo privado donde el emisor es el usuario profesor logueado y el receptor es el padre del que tenemos el id ordenados ascendentemente
        $mensajes_director_tutor = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$usuario_login.' AND receptor_id = '.$id.' AND tipo_mensaje_id = 3 ORDER BY created_at ASC');
        // Guardamos los mensajes de tipo privado donde el emisor es el padre del que tenemos el id  y el receptor es el profesor logueado ordenados ascendentemente
        $mensajes_tutor_director = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$id.' AND receptor_id = '.$usuario_login.' AND tipo_mensaje_id = 3 ORDER BY created_at ASC');
        // Fusionamos los dos arrays en uno nuevo
        $resultado = array_merge($mensajes_tutor_director,$mensajes_director_tutor);
        // Ordenamos los mensajes por orden de creación
        $nuevo_array =  Arr::sort($resultado);
        // Almacenamos los mensajes de difusión del centro para mandarlos a la vista
       
        // Actualizamos el estado de los mensajes a leídos entre emisor y receptor
        foreach ($nuevo_array as $mensaje){
            DB::select("UPDATE mensajes set estado = 1 where estado = 0 AND emisor_id = $id AND receptor_id = $usuario_login ");
        }
        // Devolvemos la vista con parámetros
        return view('mensajes.mensaje-director-tutor')->with('tutor',$tutor)
        ->with('mensajes_director_tutor',$nuevo_array)
        ->with('emisor_id',$usuario_login)
        ->with('receptor_id',$id);
    }

    public function todosMensajesPorUsuario($id){
        $usuario_login = $id;
        $usuario = User::find($usuario_login);
        $rol_usuario = $usuario->rol_id;
        $todos_mensajes = Mensaje::todosMensajesPorUsuario($usuario_login);
        return view('mensajes.todos-mensajes')->with('rol_usuario',$rol_usuario)->with('mensajes',$todos_mensajes)->with('usuario',$usuario);
    }

    public function mensajeDirectorProfesor($id_director){

        $usuario_login = auth()->user()->id; //receptor de mensaje = profesor logueado
        $director = User::find($id_director);
        // Guardamos los mensajes de tipo difusion donde el emisor es el director del centro y el receptor es el profesor logueado
        $mensajes_difusion_director_profesor = DB::select('SELECT * FROM mensajes WHERE emisor_id = '.$id_director.' AND receptor_id = '.$usuario_login.' AND tipo_mensaje_id = 1 ORDER BY created_at ASC');
        
        // Actualizamos el estado de los mensajes a leídos entre emisor y receptor
        foreach ($mensajes_difusion_director_profesor as $mensaje){
            DB::select("UPDATE mensajes set estado = 1 where estado = 0 AND emisor_id = $id_director AND receptor_id = $usuario_login ");
        }
        return view('mensajes.mensaje-difusion-director-profesor')
        ->with('mensajes_difusion_director_profesor',$mensajes_difusion_director_profesor)
        ->with('director',$director)
        ->with('emisor_id',$id_director);
       
    }

}
