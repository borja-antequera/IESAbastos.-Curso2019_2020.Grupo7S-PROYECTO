<?php

namespace agendaInfantil\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use agendaInfantil\Menu;
use agendaInfantil\Nino;
use agendaInfantil\Actividad;
use agendaInfantil\Deposicion;
use agendaInfantil\TipoBiberon;
use agendaInfantil\Biberon;
use agendaInfantil\Sueno;
use agendaInfantil\Imagen;
use agendaInfantil\ValoracionMenu;
use agendaInfantil\MenuValoracion;
use agendaInfantil\Aula;
use agendaInfantil\User;

class ActividadController extends Controller
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
        $actividades = Actividad::all();
        return view('actividades.index')->with('actividades',$actividades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtenemos el id del niño de la url a través de $GET
        $id_nino = $_GET['id_nino'];
        //Almacenamos la objeto niño buscando por el id;
        $nino_actual = Nino::find($id_nino);
        $fecha_hoy = date('Y-m-d');
        //De la tabla aula_menus obtenemos el menu asignado hoy a traves del aula id - por medio del niño - y la fecha
        $menu_aula = DB::select('SELECT * FROM aula_menus WHERE aula_id = '.$nino_actual->aula_id.' AND fecha_asociada = "'.$fecha_hoy.'" LIMIT 1');
        //Obtenemos el menu de la tabla menus con el menu_id obtenido en la query anterior para mostrarlo en el formulario de creación
        $menu_actual = Menu::find($menu_aula[0]->menu_id);
        // Obtenemos todos los tipos de biberones para mostrarlos en el select option
        $tipo_biberones = TipoBiberon::all();
        // Devolvemos la vista con los parametros que se necesitan
        return view('actividades.create')->with('menu_actual',$menu_actual)->with('tipo_biberones',$tipo_biberones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu_id = $request->input('registro_menu_id');
        $nino_id = $request->input('registro_nino_id');
        // Si se ha marcado el checkbox ausencia, almacenamos solo los datos necesarios
        if($request->input('actividad_ausencia') == "on"){
            $actividad_ausencia = 1;
            $actividad = new Actividad();

            $actividad_fecha_registro = $request->input('actividad_fecha_registro');

            $actividad->actividad_fecha = $actividad_fecha_registro;
            $actividad->actividad_hora_llegada = $actividad_fecha_registro.' '.$request->input('actividad_hora_llegada');
            $actividad->actividad_hora_salida = $actividad_fecha_registro.' '.$request->input('actividad_hora_salida');
            $actividad->actividad_ausencia = $actividad_ausencia;
            $actividad->menu_id = $menu_id;
            $actividad->nino_id = $nino_id;
            $actividad->save();

        }else{

            // Si no está marcado el checkbox ausencia, almacenamos todos los datos del formulario
            $actividad_ausencia = 0;

            $actividad = new Actividad();

            $actividad_fecha_registro = $request->input('actividad_fecha_registro');

            $actividad->actividad_fecha = $actividad_fecha_registro;
            $actividad->actividad_hora_llegada = $actividad_fecha_registro.' '.$request->input('actividad_hora_llegada');
            $actividad->actividad_hora_salida = $actividad_fecha_registro.' '.$request->input('actividad_hora_salida');
            $actividad->actividad_ausencia = $actividad_ausencia;
            $actividad->menu_id = $menu_id;
            $actividad->nino_id = $nino_id;
            //Se almacena $actividad ya que su id es FK en las tablas asociadas
            $actividad->save();

            /* Valoracion para Desayuno */
            $todo_desayuno = $request->input('todo_desayuno');
            $bastante_desayuno = $request->input('bastante_desayuno');
            $poco_desayuno = $request->input('poco_desayuno');
            $nada_desayuno = $request->input('todo_desayuno');

            //Controlamos el envio de datos a la tabla de lo seleccionado en los toogle buttons
            $valoracion_desayuno = "nada";

            if($todo_desayuno == "on"){
                $valoracion_desayuno = "todo";
            }elseif($bastante_desayuno == "on"){
                $valoracion_desayuno = "bastante";
            }elseif($poco_desayuno == "on"){
                $valoracion_desayuno = "poco";
            }

            //Se obtiene la valoración aosciada al menú dado el slug
            $valoracion_slug = $this->slug($valoracion_desayuno);
            $valoracion_actual_desayuno = ValoracionMenu::where('valoracion_slug','=',$valoracion_slug)->first();

            /* Valoracion para Primero */
            $valoracion_primero = "nada";

            $todo_primero = $request->input('todo_primero');
            $bastante_primero = $request->input('bastante_primero');
            $poco_primero = $request->input('poco_primero');
            $nada_primero = $request->input('todo_primero');

            if($todo_primero == "on"){
                $valoracion_primero = "todo";
            }elseif($bastante_primero == "on"){
                $valoracion_primero = "bastante";
            }elseif($poco_primero == "on"){
                $valoracion_primero = "poco";
            }

            $valoracion_slug = $this->slug($valoracion_primero);
            $valoracion_actual_primero = ValoracionMenu::where('valoracion_slug','=',$valoracion_slug)->first();

            /* Valoracion para Segundo */
            $valoracion_segundo = "nada";

            $todo_segundo = $request->input('todo_segundo');
            $bastante_segundo = $request->input('bastante_segundo');
            $poco_segundo = $request->input('poco_segundo');
            $nada_segundo = $request->input('todo_segundo');

            if($todo_segundo == "on"){
                $valoracion_segundo = "todo";
            }elseif($bastante_segundo == "on"){
                $valoracion_segundo = "bastante";
            }elseif($poco_segundo == "on"){
                $valoracion_segundo = "poco";
            }

            $valoracion_slug = $this->slug($valoracion_segundo);
            $valoracion_actual_segundo = ValoracionMenu::where('valoracion_slug','=',$valoracion_slug)->first();

            /* Valoracion para Postre */
            $valoracion_postre = "nada";

            $todo_postre = $request->input('todo_postre');
            $bastante_postre = $request->input('bastante_postre');
            $poco_postre = $request->input('poco_postre');
            $nada_postre = $request->input('todo_postre');

            if($todo_postre == "on"){
                $valoracion_postre = "todo";
            }elseif($bastante_postre == "on"){
                $valoracion_postre = "bastante";
            }elseif($poco_postre == "on"){
                $valoracion_postre = "poco";
            }

            $valoracion_slug = $this->slug($valoracion_postre);
            $valoracion_actual_postre = ValoracionMenu::where('valoracion_slug','=',$valoracion_slug)->first();

            /* Valoracion para Merienda */
            $valoracion_merienda = "nada";

            $todo_merienda = $request->input('todo_merienda');
            $bastante_merienda = $request->input('bastante_merienda');
            $poco_merienda = $request->input('poco_merienda');
            $nada_merienda = $request->input('todo_merienda');

            if($todo_merienda == "on"){
                $valoracion_merienda = "todo";
            }elseif($bastante_merienda == "on"){
                $valoracion_merienda = "bastante";
            }elseif($poco_merienda == "on"){
                $valoracion_merienda = "poco";
            }

            $valoracion_slug = $this->slug($valoracion_merienda);
            $valoracion_actual_merienda = ValoracionMenu::where('valoracion_slug','=',$valoracion_slug)->first();

            $menu_valoracion = new MenuValoracion();
            $menu_valoracion->menu_id = $menu_id;
            $menu_valoracion->menu_valoracion_desayuno_id = $valoracion_actual_desayuno->id; 
            $menu_valoracion->menu_valoracion_primero_id = $valoracion_actual_primero->id; 
            $menu_valoracion->menu_valoracion_segundo_id = $valoracion_actual_segundo->id; 
            $menu_valoracion->menu_valoracion_postre_id = $valoracion_actual_postre->id; 
            $menu_valoracion->menu_valoracion_merienda_id = $valoracion_actual_merienda->id; 
            $menu_valoracion->actividad_id = $actividad->id;
            //Almacenamos la valoracion del menu en su tabla menu_valoraciones
            $menu_valoracion->save();

            $cant_pipi = $request->input('cant_pipi');

            //Almacenamos los registros de la tabla deposiciones
            // Deposicion pipi
            if($cant_pipi > 0){
                $comentarios_pipi = $request->input('comentarios_pipi');
                $nueva_deposicion = new Deposicion();
                $nueva_deposicion->deposicion_numero = $cant_pipi;
                $nueva_deposicion->deposicion_comentarios = $comentarios_pipi;
                $nueva_deposicion->deposicion_tipo = "pipi";
                $nueva_deposicion->actividad_id = $actividad->id;
                $nueva_deposicion->save();
            }
            // Deposicion caca
            $cant_caca = $request->input('cant_caca');
            
            if($cant_caca > 0){
                $comentarios_caca = $request->input('comentarios_caca');
                $nueva_deposicion = new Deposicion();
                $nueva_deposicion->deposicion_numero = $cant_caca;
                $nueva_deposicion->deposicion_comentarios = $comentarios_caca;
                $nueva_deposicion->deposicion_tipo = "caca";
                $nueva_deposicion->actividad_id = $actividad->id;
                $nueva_deposicion->save();
            }
            //Deposicion cambio de pañal
            $cant_cambio_panal = $request->input('cant_cambio_panal');

            if($cant_cambio_panal > 0){
                $comentarios_cambio_panal = $request->input('comentarios_cambio_panal');
                $nueva_deposicion = new Deposicion();
                $nueva_deposicion->deposicion_numero = $cant_cambio_panal;
                $nueva_deposicion->deposicion_comentarios = $comentarios_cambio_panal;
                $nueva_deposicion->deposicion_tipo = "Cambio Pañal";
                $nueva_deposicion->actividad_id = $actividad->id;
                $nueva_deposicion->save();
            }
            //Almacenamos los registros en la tabla biberones
            $biberon_cantidad_1 = $request->input('biberon_cantidad_1');
            //Se almacena el primer input de biberon si está rellenado
            if($biberon_cantidad_1 > 0){

                $tipo_biberon_id_1 =  $request->input('tipo_biberon_id_1');
                $biberon_hora_1 =  $request->input('biberon_hora_1');
                $biberon = new Biberon();
                $biberon->biberon_hora = $actividad_fecha_registro.' '.$biberon_hora_1;
                $biberon->biberon_cantidad = $biberon_cantidad_1;
                $biberon->tipo_biberon_id = $tipo_biberon_id_1;
                $biberon->actividad_id = $actividad->id;
                $biberon->save();
            }
            //Se almacena el segundo input de biberon si está rellenado
            $biberon_cantidad_2 = $request->input('biberon_cantidad_2');

            if($biberon_cantidad_2 > 0){

                $tipo_biberon_id_2 =  $request->input('tipo_biberon_id_2');
                $biberon_hora_2 =  $request->input('biberon_hora_2');

                $biberon = new Biberon();
                $biberon->biberon_hora = $actividad_fecha_registro.' '.$biberon_hora_2;
                $biberon->biberon_cantidad = $biberon_cantidad_2;
                $biberon->tipo_biberon_id = $tipo_biberon_id_2;
                $biberon->actividad_id = $actividad->id;   
                $biberon->save();

            }

            ////Se almacena el tercer input de biberon si está rellenado
            $biberon_cantidad_3 = $request->input('biberon_cantidad_3');

            if($biberon_cantidad_3 > 0){

                $tipo_biberon_id_3 =  $request->input('tipo_biberon_id_3');
                $biberon_hora_3 =  $request->input('biberon_hora_3');

                $biberon = new Biberon();
                $biberon->biberon_hora = $actividad_fecha_registro.' '.$biberon_hora_3;
                $biberon->biberon_cantidad = $biberon_cantidad_3;
                $biberon->tipo_biberon_id = $tipo_biberon_id_3;
                $biberon->actividad_id = $actividad->id;   
                $biberon->save();

            }

            // se almacenan los registros en la tabla suenos
            $sueno_hora_inicio_1 = $request->input('sueno_hora_inicio_1');
            // si se ha completado el primer input de sueno se almacena
            if(isset($sueno_hora_inicio_1)){

                $sueno = new Sueno();
                $sueno_hora_fin_1 = $actividad_fecha_registro.' '.$request->input('sueno_hora_fin_1');
                $sueno->sueno_hora_inicio = $actividad_fecha_registro.' '.$sueno_hora_inicio_1;
                $sueno->sueno_hora_fin = $sueno_hora_fin_1;
                $sueno->actividad_id = $actividad->id;
                $sueno->save();
            }
            // si se ha completado el segundo input de sueno se almacena
            $sueno_hora_inicio_2 = $request->input('sueno_hora_inicio_2');

            if(isset($sueno_hora_inicio_2)){

                $sueno = new Sueno();
                $sueno_hora_fin_2 = $actividad_fecha_registro.' '.$request->input('sueno_hora_fin_2');
                $sueno->sueno_hora_inicio = $actividad_fecha_registro.' '.$sueno_hora_inicio_2;
                $sueno->sueno_hora_fin = $sueno_hora_fin_2;
                $sueno->actividad_id = $actividad->id;
                $sueno->save();
            }
            // si se ha completado el tercer input de sueno se almacena
            $sueno_hora_inicio_3 = $request->input('sueno_hora_inicio_3');

            if(isset($sueno_hora_inicio_3)){

                $sueno = new Sueno();
                $sueno_hora_fin_3 = $actividad_fecha_registro.' '.$request->input('sueno_hora_fin_3');
                $sueno->sueno_hora_inicio = $actividad_fecha_registro.' '.$sueno_hora_inicio_3;
                $sueno->sueno_hora_fin = $sueno_hora_fin_3;
                $sueno->actividad_id = $actividad->id;
                $sueno->save();
            }
            // Si se han añadido imagenes al registro se almacena su ruta en la tabla imagenes
            if ($request->hasFile('imagenes')) {
                foreach($request->file('imagenes') as $file){
                $ruta_imagen = $this->imageUploadActividad($file);
                $imagen = new Imagen();
                $imagen->imagen_ruta = $ruta_imagen;
                $imagen->actividad_id = $actividad->id;
                $imagen->save();
                }
            }
        }

        //Obtenemos el slug del aula para redireccionar a la vista del aula
        $ninoA = Nino::find($nino_id)->aula_id;
        $aulaSlug = Aula::find($ninoA)->aula_slug;

        return redirect('/aulas/'.$aulaSlug.'');

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
    // funcion de validacion de imagenes
    public function imageUploadActividad($query) // Taking input image as parameter
    {
        $image_name = str_random(20);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $image_full_name = $image_name.'.'.$ext;
        $upload_path = 'images/';    //Creating Sub directory in Public folder to put image
        $image_url = $upload_path.$image_full_name;
        $success = $query->move($upload_path,$image_full_name);
        return $image_url; // Just return image
    }
    // funcion para mostrar la vista del histórico de actividades del niño con sus respectivos parametros
    public function actividadNino($id){

        $nino = Nino::find($id);
        $fecha_nacimiento_nino = date("Y",strtotime($nino->nino_fecha_nacimiento));
        $fecha_actual = date("Y");
        $edad_nino = $fecha_actual - $fecha_nacimiento_nino;

        $padre_nino = User::find($nino->usuario_id);
        $aula_nino = Aula::find($nino->aula_id);
        $registros = DB::select('SELECT * FROM actividades WHERE nino_id = '.$id.'');

        return view('actividades.actividades_nino_show')->with('aula_nino',$aula_nino)->with('nino',$nino)->with('padre_nino',$padre_nino)->with('edad_nino',$edad_nino)->with('actividades',$registros);
    }
    // funcion para mostrar la vista del detalle de la actividad seleccionada con sus parametros
    public function actividadDetalleNino($registro_id){

        $biberones = DB::select('SELECT * FROM biberones where actividad_id = '.$registro_id.'');
        $suenos = DB::select('SELECT * FROM suenos where actividad_id = '.$registro_id.'');
        $deposiciones = DB::select('SELECT * FROM deposiciones where actividad_id = '.$registro_id.'');
        $imagenes = DB::select('SELECT * FROM imagenes where actividad_id = '.$registro_id.'');
        $menu_valoracion = DB::select('SELECT * FROM menu_valoraciones where actividad_id = '.$registro_id.' LIMIT 1');
        // Esta variable diferencia a los registros con la valoración de comida ingerida de los que no la tienen para que a la hora de mostrar la información
        // en actividad_detalle.niño.blade.php se controle el que aparezca una valoración o no
        $contador_menu_valoraciones = count($menu_valoracion);

        $menu_actividad = Actividad::find($registro_id)->menu_id;
        $menu = Menu::find($menu_actividad);
        $actividad = Actividad::find($registro_id);
        $nino_actual = Nino::find($actividad->nino_id);
        $nino_nombre = $nino_actual->nino_nombre.' '.$nino_actual->nino_apellido1.' '.$nino_actual->nino_apellido2;
        $nino_slug = $nino_actual->slug;

        return view('actividades.actividad_detalle_nino')->with('contador_menu_valoraciones',$contador_menu_valoraciones)->with('menu_valoracion',$menu_valoracion)->with('biberones',$biberones)
        ->with('suenos',$suenos)->with('nino',$nino_nombre)->with('nino_slug',$nino_slug)->with('menu',$menu)->with('deposiciones',$deposiciones)->with('imagenes',$imagenes);
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
