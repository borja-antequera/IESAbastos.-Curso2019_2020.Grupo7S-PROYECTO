<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use agendaInfantil\User;
use agendaInfantil\Nino;
use agendaInfantil\Aula;

// Ampliación para no saturar UserController, controlador orientado especialmente a la vista del tutor

class TutorController extends Controller
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
        $user_id = auth()->user()->id;
        $ninos = DB::select('SELECT * FROM ninos WHERE usuario_id = '.$user_id.' ');
        return view('tutor.index')->with('ninos',$ninos);
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


    public function calendarioNino($id){
        $nino = Nino::find($id);
        $registros = DB::select('SELECT * FROM actividades WHERE nino_id = '.$id.'');
        return view('tutor.calendario')->with('nino',$nino)->with('actividades',$registros);
    }
}
