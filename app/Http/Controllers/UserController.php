<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use agendaInfantil\User;
use agendaInfantil\Role;
use agendaInfantil\Centro;
use agendaInfantil\Aula;
use agendaInfantil\Nino;

class UserController extends Controller
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
        $usuario_login = auth()->user()->id;
        $usuario_actual = User::find($usuario_login);
        $rol_usuario_login = $usuario_actual->rol_id;

        if($rol_usuario_login == 1){
            $list_usuarios = array();
            $resultado = array();
            $director_centro = Centro::DirectorCentro($usuario_actual->id);
            $aulas = Centro::AulasCentro($director_centro->id);

            foreach ($aulas as $aula) {                
                $profesores_aulas = Aula::UsuariosProfesoresAula($aula->id);
                $padres_alumnos_aula = Aula::UsuariosPadresAlumnosAula($aula->id);
                $resultado[] = $profesores_aulas;
                $resultado[] = $padres_alumnos_aula;
            }

            foreach ($resultado as $resul) { 
                foreach ($resul as $result) { 
                    $list_usuarios[] = $result;
                }
            }
        // Ordena los usuarios por id de forma ASC        
        $usuarios =  Arr::sort($list_usuarios);

        // Elimina id duplicados apra los usuarios
        $usuarios = array_unique($usuarios, SORT_REGULAR);
               
        }else if($rol_usuario_login == 4){
            $usuarios = User::all();
        }

        return view('usuarios.index')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new user();

        if($request->hasFile('user_image')){
            $file = $request->file('user_image');
            $pic_name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $pic_name);
        }
        $user->rol_id = $request->input('rol_id');
        $user->name = $request->input('name');
        $user->username1 = $request->input('username1');
        $user->username2 = $request->input('username2');
        $user->birth_date = $request->input('birth_date');
        $user->email = $request->input('email');
        $user->user_slug = $this->slug($request->input('name').' '.$request->input('username1').' '.$request->input('username2'));
        $pass = bcrypt($request->input('password'));
        $user->password = $pass;
        $user->user_image = $pic_name;
        $user->save();
        
        $notification = array(
            'message' => 'Usuario creado correctamente',
            'alert-type' => 'success'
        );
        $usuarios = User::all();
        return view('usuarios.index')->with('usuarios', $usuarios)->with('notification',$notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $user = User::find($id);
        $rol_user = $user->rol_id;

        if($rol_user == 1){
            $centro = Centro::DirectorCentro($user->id);
            $aulas = Centro::AulasCentro($centro->id);
            return view ('usuarios.show')->with('user',$user)->with('centro',$centro)->with('aulas',$aulas);
        }

        if($rol_user == 2){
            $centros = Aula::agrupar_centros_aulas_por_profesor($id);
            return view ('usuarios.show')->with('user',$user)->with('centros',$centros);
        }

        if($rol_user == 3){
            $centros = Nino::agrupar_ninos_tutores_por_centro($id);
            return view ('usuarios.show')->with('user',$user)->with('centros',$centros);
        }

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
        $user = User::find($id);
        return view('usuarios.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id = $request->input('user_id');
        $usuario_rol = User::find($user_id);

        $user = User::find($user_id);
        $user->name = $request->input('name');
        $user->username1 = $request->input('username1');
        $user->username2 = $request->input('username2');
        $user->birth_date = $request->input('birth_date');
        $user->email = $request->input('email');

        $user->fill($request->except('user_image'));

        if($request->hasFile('user_image')){
            $file = $request->file('user_image');
            $pic_name = time().$file->getClientOriginalName();
            $user->user_image = $pic_name;
            $file->move(public_path().'/images/', $pic_name);
            $user->user_image = $pic_name;
        }
        $user->save();       

        $notification = array(
            'message' => 'Usuario editado correctamente',
            'alert-type' => 'success'
        );

        $usuario_login = auth()->user()->id;
        $usuario_actual = User::find($usuario_login);
        $rol_usuario_login = $usuario_actual->rol_id;

        if($rol_usuario_login == 1){
            $list_usuarios = array();
            $resultado = array();
            $director_centro = Centro::DirectorCentro($usuario_actual->id);
            $aulas = Centro::AulasCentro($director_centro->id);

            foreach ($aulas as $aula) {                
                $profesores_aulas = Aula::UsuariosProfesoresAula($aula->id);
                $padres_alumnos_aula = Aula::UsuariosPadresAlumnosAula($aula->id);
                $resultado[] = $profesores_aulas;
                $resultado[] = $padres_alumnos_aula;
            }

            foreach ($resultado as $resul) { 
                foreach ($resul as $result) { 
                    $list_usuarios[] = $result;
                }
            }
        // Ordena los usuarios por id de forma ASC        
        $usuarios =  Arr::sort($list_usuarios);

        // Elimina id duplicados apra los usuarios
        $usuarios = array_unique($usuarios, SORT_REGULAR);
               
        }else if($rol_usuario_login == 4){
            $usuarios = User::all();
        }

        return view('usuarios.index')->with('usuarios', $usuarios)->with('notification',$notification);
  

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
    
    //funcion que crea el slug sustituyendo al id en el enrutamiento
    public function slug($str) {
        $clean = trim($str);
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
        $clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));

        $clean = preg_replace("/[_| -]+/", '-', $clean); // aquí permite el slash

        if (substr($clean, -1) == '/') {
            $clean = substr($clean, 0, -1);
        }

        return $clean;
    }
}
