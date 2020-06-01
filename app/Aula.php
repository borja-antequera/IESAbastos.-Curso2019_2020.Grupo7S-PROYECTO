<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use agendaInfantil\AulasTipo;
use agendaInfantil\Centro;
use agendaInfantil\AulaUser;
use agendaInfantil\Nino;

class Aula extends Model
{
    /* Definimos este array para que se puedan editar los valores campos enumerados*/
    protected $fillable = ['aula_nombre', 'aula_slug', 'aula_descripcion', 'aula_tipo_id', 'aula_centro_id'];
    /* Definimos una relación 1:1 con el modelo AulasTipo*/
    public function tipos()
    {
        return $this->hasMany('agendaInfantil\AulasTipo');
    }
    /* Definimos una relación 1:1 con el modelo Centro*/
    public function centros(){
        return $this->hasMany('agendaInfantil\Centro');
    }
    /* definimos una relación n:n con el modelo aula_users*/
    public function users()
    {
        return $this->belongsToMany('agendaInfantil\User', 'aula_users');
    }

         /**
    * Get the route key for the model.
    *
    * @return string
    */
    /* funcion para usar el slug en las rutas*/
    public function getRouteKeyName()
    {
        return 'aula_slug';

    }
    //Método empleado en mensajería para devolver los profesores de un aula específica
    public static function ProfesoresAula($aula_id){
        $profesores = DB::select('SELECT * FROM aula_users where aula_id = '.$aula_id.'');
        return $profesores; 
    }
    //Método empleado en mensajería para devolver los niños de un aula específica
    public static function AlumnosAula($aula_id){
        $alumnos = DB::select('SELECT * FROM ninos where aula_id = '.$aula_id.'');
        return $alumnos; 
    }
    // Método empleado en mensajería para devolver las aulas de las que es responsable un educador dado su id
    public static function AulasProfesor($usuario_id){
        $aulas = DB::select('SELECT aulas.* FROM aula_users INNER JOIN aulas ON aula_users.aula_id = aulas.id where aula_users.user_id = '.$usuario_id.'');
        return $aulas; 
    }
    // Método empleado en mensajería privada que devuelve los profesores de un aula dado el id del aula
    public static function ProfesoresDetalleAula($aula_id){
        $profesores = DB::select('SELECT users.* FROM aula_users INNER JOIN users ON aula_users.user_id = users.id where aula_id = '.$aula_id.'');
        return $profesores; 
    } 
    
    //Método para obtener los profesores de un aula y unirlo con su respectivo usuario

    public static function UsuariosProfesoresAula($aula_id){
        $profesores = DB::select('SELECT users.*,aula_users.user_id FROM aula_users INNER JOIN users
        ON users.id = aula_users.user_id where aula_id = '.$aula_id.'');
        
        return $profesores; 
    }

    //Método para obtner los usuarios de los padres de cada niño por aula
    public static function UsuariosPadresAlumnosAula($aula_id){
        $usuarios_padres_alumnos = DB::select('SELECT users.*,ninos.usuario_id 
        FROM ninos INNER JOIN users ON users.id = ninos.usuario_id where aula_id = '.$aula_id.'');

   
        return $usuarios_padres_alumnos; 
    }
    // Método para obtener las aulas agrupadas por centro dado el id del profesor
    public static function agrupar_centros_aulas_por_profesor($id_profesor){
        $centros_aula_usuario = DB::select('SELECT aulas.*, aula_users.user_id as idUsuario, 
        centros.* FROM  aulas INNER JOIN aula_users ON aulas.id = aula_users.aula_id 
        INNER JOIN centros ON centros.id = aulas.aula_centro_id 
        where aula_users.user_id = '.$id_profesor.' GROUP BY aulas.aula_centro_id');

        return $centros_aula_usuario;
    }

}
