<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use agendaInfantil\Aula;
use agendaInfantil\AulasTipo;
use agendaInfantil\Centro;
use agendaInfantil\Aulauser;
use agendaInfantil\User;

class AulaController extends Controller
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
            $centro = Centro::DirectorCentro($usuario_actual->id);
            $aulas =  Centro::AulasCentro($centro->id);            
        }elseif($rol_usuario_login == 2){
            $aulas = Aula::AulasProfesor($usuario_actual->id);
        }else if($rol_usuario_login ==4){
            $aulas = Aula::all();
        }
        //return view('aulas.index', compact('aulas'));
        return view('aulas.index')->with('aulas', $aulas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aulas_tipos = AulasTipo::all();
        $centros = Centro::all();
        $profesores = DB::select('SELECT * FROM users WHERE rol_id = ? ORDER BY name ASC', [2]);
        return view('aulas.create')->with('aulas_tipos', $aulas_tipos)->with('centros', $centros)->with('profesores', $profesores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aula = new Aula();
        $aula->aula_centro_id = $request->input('aula_centro_id');
        $aula->aula_tipo_id = $request->input('aula_tipo_id');
        $aula->aula_nombre = $request->input('aula_nombre');
        $aula->aula_slug = $this->slug($request->input('aula_nombre'));
        $aula->aula_descripcion = $request->input('aula_descripcion');
        $aula->save();

        $profesores = $request->input('user_id');

        foreach($profesores as $profesor_id){
            $aulaUser = new AulaUser();
            $aulaUser->aula_id = $aula->id;
            $aulaUser->user_id = $profesor_id;
            $aulaUser->save();
        }

        //Para saber que se ha almacenado correctamente:
        return redirect()->route('aulas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aula $aula)
    {
        $ninos = DB::select('SELECT * FROM ninos WHERE aula_id = ? ORDER BY nino_nombre,nino_apellido1 ASC', [$aula->id]);
        $fecha_hoy = date("Y-m-d");
        $aulas_menus = DB::select('SELECT * FROM aula_menus WHERE aula_id = '.$aula->id.' AND fecha_asociada = "'.$fecha_hoy.'" ORDER BY fecha_asociada DESC');
        // Esta variable activa el modal de aulas.show.blade.php -> Si estuviera a 0 se activa el modal que impide el acceso al aula y a realizar acciones sobre los niños -
        $contador_aula_menu = count($aulas_menus);

        return view ('aulas.show')->with('aula', $aula)->with('ninos', $ninos)->with('contador_aula_menu',$contador_aula_menu);

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

    public function eliminarAula($id){

        $aula = Aula::find($id);
        $profesores = Aula::ProfesoresAula($id);        
        return view('aulas.delete')->with('aula',$aula)->with('profesores',$profesores);
    }

    public function eliminarAulaBD($id){

        $aula_id = $id;
       
        //eliminar relacion de los profesores con el aula
        DB::select("DELETE FROM aula_users WHERE aula_id = ".$aula_id."");

        //Eliminar relación del aula con los menús del hoy
        DB::select("DELETE FROM aula_menus WHERE aula_id = ".$aula_id."");

        //eliminar ninos por cada aula
        DB::select("DELETE FROM ninos WHERE aula_id = ".$aula_id."");

        //eliminar aula
        DB::select("DELETE FROM aulas WHERE id = ".$aula_id."");

        $notification = array(
            'message' => 'Aula eliminada correctamente',
            'alert-type' => 'success'
        );
        
        $aulas = Aula::all();
        return view('aulas.index')->with('aulas',$aulas)->with('notification',$notification);

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
        $clean = trim($str);        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
        $clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));

        $clean = preg_replace("/[_| -]+/", '-', $clean); // aquí permite el slash

        if (substr($clean, -1) == '/') {
            $clean = substr($clean, 0, -1);
        }

        return $clean;
    }
}
