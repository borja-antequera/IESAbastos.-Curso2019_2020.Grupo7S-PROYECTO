<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;
use agendaInfantil\AulaMenu;
use agendaInfantil\Menu;
use Illuminate\Support\Facades\DB;

class AulaMenuController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_aula = $_GET['id_aula'];
        $menus = Menu::all();
        $aulas_menus = DB::select('SELECT * FROM aula_menus WHERE aula_id = ? ORDER BY fecha_asociada DESC', [$id_aula]);
        return view ('aula_menu.create')->with('menus', $menus)->with('aulas_menus', $aulas_menus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aula_menu = new AulaMenu();
        $aula_menu->aula_id = $request->input('aula_id');
        $aula_menu->menu_id = $request->input('menu_id');
        $aula_menu->fecha_asociada = $request->input('fecha_asociada');
        $aula_menu->save();     

        //Para saber que se ha almacenado correctamente:
        return redirect('/aula_menu/create?id_aula='.$request->input('aula_id').'');
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
}
