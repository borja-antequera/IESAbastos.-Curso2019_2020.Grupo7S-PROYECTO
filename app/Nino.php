<?php
/*

setTimeout(function(){ $('.alert-danger button.close').trigger('click'); }, 3000);

*/ 
namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use agendaInfantil\Actividad;

class Nino extends Model
{
    
    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'slug';

    }
    /* Funcion que determina si el niño tiene ya un registro asociado en el día de hoy. De esta forma se controla que no haya duplicidad de registros en el día para un niño en la vista aulas/show.blade.php*/
    public static function tiene_registro_hoy($id_nino){
        $fecha_hoy = date("Y-m-d");
        $actividades_hoy = DB::select('SELECT * FROM actividades WHERE nino_id = '.$id_nino.' AND actividad_fecha = "'.$fecha_hoy.'" ');

        return count($actividades_hoy);
    }
    // Devuelve la cantidad de actividades diarias para un niño
    public static function total_actividades_diarias($id){
        $actividades = DB::select('SELECT * FROM actividades WHERE nino_id = '.$id.'');
        return count($actividades);
    }

    // Función que determina los centros a los que pertenece los hijos dado un tutor(padre)
    public static function agrupar_ninos_tutores_por_centro($id_tutor){

        $centros = DB::select('SELECT aulas.aula_centro_id as idCentro, centros.* 
        FROM `ninos` INNER JOIN aulas ON aulas.id = ninos.aula_id INNER JOIN centros 
        ON centros.id = aulas.aula_centro_id WHERE ninos.usuario_id = '.$id_tutor.' 
        GROUP BY idCentro');
        return $centros;
    }
    // Función que agrupa el centro con las aulas, los respectivos tutores y sus hijos dado el tutor y el centro
    public static function listado_ninos_tutores_aulas_centro($id_tutor,$id_centro){

        $listado = DB::select('SELECT aulas.id as idAula, aulas.*, ninos.* FROM `ninos` INNER JOIN aulas 
        ON aulas.id = ninos.aula_id INNER JOIN centros ON centros.id = aulas.aula_centro_id 
        where usuario_id = '.$id_tutor.' and aulas.aula_centro_id = '.$id_centro.'');

        return $listado;
    }
}
