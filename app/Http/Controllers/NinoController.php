<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use agendaInfantil\Nino;
use agendaInfantil\Aula;
use agendaInfantil\User;
use agendaInfantil\Centro;

class NinoController extends Controller
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
            $listado_ninos = array();
            $ninos = array();

            $centro = Centro::DirectorCentro($usuario_actual->id);
            $aulas =  Centro::AulasCentro($centro->id);
            
            foreach($aulas as $aula){
                $alumnos_aula = Aula::AlumnosAula($aula->id);
                $listado_ninos[] = $alumnos_aula;
            }

            foreach($listado_ninos as $listado){
                foreach ($listado as $list) { 
                    $ninos[] = $list;
                }
            }
           
        }else if($rol_usuario_login ==4){
            $ninos = Nino::all();
        }

        return view('ninos.index')->with('ninos', $ninos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario_login = auth()->user()->id;
        $usuario_actual = User::find($usuario_login);
        $rol_usuario_login = $usuario_actual->rol_id;

        if($rol_usuario_login == 1){
            $centro = Centro::DirectorCentro($usuario_login);
            $aulas = Centro::AulasCentro($centro->id);
            
        } if($rol_usuario_login == 4){
            $aulas = Aula::all();
        }
        $users = DB::select('SELECT * FROM users WHERE rol_id = ? ORDER BY name ASC', [3]);
        return view('ninos.create')->with('aulas', $aulas)->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $nino = new Nino();
        if($request->hasFile('nino_imagen')){
            $file = $request->file('nino_imagen');
            $pic_name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $pic_name);
        }
        $nino->nino_nombre = $request->input('nino_nombre');
        $nino->nino_apellido1 = $request->input('nino_apellido1');
        $nino->nino_apellido2 = $request->input('nino_apellido2');
        $nino->nino_fecha_nacimiento = $request->input('nino_fecha_nacimiento');
        $nino->usuario_id = $request->input('usuario_id');
        $nino->aula_id = $request->input('aula_id');
        $nino->slug = $this->slug($request->input('nino_nombre').' '.$request->input('nino_apellido1').' '.$request->input('nino_apellido2'));
        $nino->nino_imagen = $pic_name;
        $nino->save();

        return redirect()->route('ninos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Nino $nino)
    {
        $nino1 = Nino::find($nino->id);
        $fecha_nacimiento_nino = date("Y",strtotime($nino1->nino_fecha_nacimiento));
        $fecha_actual = date("Y");
        $edad_nino = $fecha_actual - $fecha_nacimiento_nino;

        $padre_nino = User::find($nino1->usuario_id);
        $aula_nino = Aula::find($nino1->aula_id);
        $registros = DB::select('SELECT * FROM actividades WHERE nino_id = '.$nino->id.'');
        
        return view('ninos.show')->with('aula_nino',$aula_nino)->with('nino',$nino1)->with('padre_nino',$padre_nino)->with('edad_nino',$edad_nino)->with('actividades',$registros);
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
        $nino = Nino::find($id);
        $nino->delete();
        
        $notification = array(
            'message' => 'Niño eliminado correctamente',
            'alert-type' => 'success'
        );
        
        $ninos = Nino::all();
        return view('ninos.index')->with('ninos', $ninos)->with('notification',$notification);
    }
    
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
