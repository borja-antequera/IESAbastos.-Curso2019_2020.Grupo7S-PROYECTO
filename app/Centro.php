<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use agendaInfantil\Aula;

class Centro extends Model
{
    protected $fillable = ['centro_nombre', 'centro_direccion', 'centro_descripcion', 'centro_imagen', 'slug'];
    /**
    * Get the route key for the model.
    *
    * @return string
    */

    // Usar el slug en la ruta en vez del id
    public function getRouteKeyName(){
        return 'slug';
    }
    // Función que devuelve un Centro dado el slug
    public static function CentroPorSlug($slug){
        $centro = Centro::where("slug","=",$slug)->first();
        return $centro;
    }
    // Función que devuelve las aulas dado el id del centro
    public static function AulasCentro($centro_id){
        $aulas = DB::select('SELECT * FROM aulas where aula_centro_id = '.$centro_id.'');
        return $aulas;
    }
    
    // Devuelve el centro dado el id del director
    public static function DirectorCentro($usuario_id){
        $director_centro = Centro::where("director_id","=",$usuario_id)->first();
        return $director_centro;
    }
    // Devuelve el Centro dado el id del director
    public static function DirectorCentroListados($usuario_id){
        $director_centro =  DB::select('SELECT * FROM centros where director_id = '.$usuario_id.'');
        return $director_centro;
    }
}
