<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use agendaInfantil\Centro;
use agendaInfantil\User;

use agendaInfantil\Http\Requests\StoreCentroRequest;

class CentroController extends Controller
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
            $centros = Centro::DirectorCentroListados($usuario_actual->id);
        }else if($rol_usuario_login == 4){
            $centros = Centro::all();
        }
       
        return view('centros.index')->with('centros',$centros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directores = DB::select("SELECT * FROM users where rol_id = 1 ORDER BY name ASC");
    
        return view('centros.create')->with('directores',$directores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCentroRequest $request)
    {
        $director_id = $request->input('director_id');
        $existe_director = DB::select('SELECT COUNT(*) as cantidad FROM centros where director_id = '.$director_id.'');
        
        if($existe_director[0]->cantidad ==0){
            
            $centro = new Centro();
    
            if($request->hasFile('centro_imagen')){
                $file = $request->file('centro_imagen');
                $pic_name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $pic_name);
            }
    
            $centro->centro_nombre = $request->input('centro_nombre');
            $centro->centro_direccion = $request->input('centro_direccion');
            $centro->centro_descripcion = $request->input('centro_descripcion');
            $centro->centro_imagen = $pic_name;
            $centro->slug = $this->slug($request->input('centro_nombre'));
            $centro->director_id = $request->input('director_id');
            $centro->save();

            $notification = array(
                'message' => 'Centro creado correctamente',
                'alert-type' => 'info'
            );
            
            $centros = Centro::all();
            return view('centros.index')
            ->with('centros',$centros)
            ->with('notification',$notification);

        }else{
            $directores = DB::select("SELECT * FROM users where rol_id = 1 ORDER BY name ASC");
            
            $notification = array(
                'message' => 'Este Director ya ha sido asignado a otro centro. Por favor seleccione uno nuevo',
                'alert-type' => 'warning'
            );
            return view('centros.create')
            ->with('directores',$directores)
            ->with('notification',$notification);

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Centro $centro)
    {
        //$centro = Centro::find($id);
        //$centro = Centro::where('slug','=',$slug)->firstOrFail();
        $aulas_centro = DB::select('SELECT * FROM aulas WHERE aula_centro_id ='.$centro->id.'');
        return view ('centros.show')->with('centro',$centro)->with('aulas_centro',$aulas_centro);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Centro $centro)
    {
        //return $centro;
        $directores = DB::select("SELECT * FROM users where rol_id = 1 ORDER BY name ASC");
    
        return view('centros.edit')->with('directores',$directores)->with('centro',$centro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Centro $centro)
    {
        $centro->fill($request->except('centro_imagen'));
        if($request->hasFile('centro_imagen')){
            $file = $request->file('centro_imagen');
            $pic_name = time().$file->getClientOriginalName();
            $centro->centro_imagen = $pic_name;
            $file->move(public_path().'/images/', $pic_name);
        }
        $centro->save();
        //return "updated!";

        $notification = array(
            'message' => 'Centro editado correctamente',
            'alert-type' => 'success'
        );

        $centros = Centro::all();
        return view('centros.index')
        ->with('centros',$centros)
        ->with('notification',$notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centro $centro)
    {
        $file_path = public_path().'/images/'.$centro->centro_imagen;
        \File::delete($file_path);
        $centro->delete();
        //return 'deleted';
        return redirect()->route('centros.index');
    }

    public function eliminarCentro($id){

        $centro = Centro::find($id);
        $aulas = Centro::AulasCentro($id);        
        return view('centros.delete')->with('centro',$centro)->with('aulas',$aulas);
    }

    public function eliminarCentroBD($id){
        $centro_id = $id;
        $aulas = Centro::AulasCentro($centro_id); 

        foreach ($aulas as $aula) {
            //eliminar relacion de los profesores con el aula
            DB::select("DELETE FROM aula_users WHERE aula_id = ".$aula->id."");

            //Eliminar relación del aula con los menús del hoy
            DB::select("DELETE FROM aula_menus WHERE aula_id = ".$aula->id."");

            //eliminar ninos por cada aula
            DB::select("DELETE FROM ninos WHERE aula_id = ".$aula->id."");

            //eliminar aula
            DB::select("DELETE FROM aulas WHERE id = ".$aula->id."");
        }

        //eliminar centro actual
        DB::select("DELETE FROM centros WHERE id = ".$centro_id."");

        $notification = array(
            'message' => 'Centro eliminado correctamente',
            'alert-type' => 'success'
        );
        
        $centros = Centro::all();
        return view('centros.index')->with('centros',$centros)->with('notification',$notification);

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
