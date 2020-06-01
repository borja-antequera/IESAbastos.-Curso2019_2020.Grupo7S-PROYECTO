<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;

use agendaInfantil\Menu;

use agendaInfantil\Http\Requests\StoreMenuRequest;

class MenuController extends Controller
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
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = new Menu();
        $menu->menu_nombre = $request->input('menu_nombre');
        $menu->menu_desayuno_nombre = $request->input('menu_desayuno_nombre');
        $menu->menu_primero_nombre = $request->input('menu_primero_nombre');
        $menu->menu_segundo_nombre = $request->input('menu_segundo_nombre');
        $menu->menu_postre_nombre = $request->input('menu_postre_nombre');
        $menu->menu_merienda_nombre = $request->input('menu_merienda_nombre');
        $menu->menu_slug = $this->slug($request->input('menu_nombre')).time();
        $menu->save();
        //Para saber que se ha guardado correctamente
        //return 'Saved';
        return redirect()->route('menus.index')->with('status', 'Menú creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //$menu = Menu::where('menu_slug','=',$slug)->firstOrFail();
        return view ('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->fill($request->except('menu_slug'));
        $menu->menu_slug = $this->slug($request->input('menu_nombre')).time();
        $menu->save();
        return redirect()->route('menus.show', [$menu])->with('status', 'Menú actualizado correctamente');
        //return redirect()->route('menus.show', compact('menu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        //return 'deleted';
        return redirect()->route('menus.index');
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
