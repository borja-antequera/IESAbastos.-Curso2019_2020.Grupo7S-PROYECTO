<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use agendaInfantil\User;

class Mensaje extends Model
{
    //
    protected $table = "mensajes";

    // Devuelve los mensajes no leídos dado el usuario logueado
    public static function mensajesNoLeidosPorUsuarioLoguedo($id,$tipo_mensaje_id){
        $contador_mensajes_no_leidos = count(DB::select('SELECT emisor_id FROM mensajes where receptor_id = '.$id.' AND estado = 0 AND tipo_mensaje_id = '.$tipo_mensaje_id.' GROUP BY emisor_id'));
        return $contador_mensajes_no_leidos;
    }
    // devuelve los tres últimos mensajes no leídos
    public static function ultimosMensajesNoLeidosPorUsuario($id,$tipo_mensaje_id){
        $ultimos_mensajes_no_leidos = DB::select('SELECT mensajes.*,users.name, users.username1, users.username2,users.user_image FROM mensajes INNER JOIN users ON users.id = mensajes.emisor_id where mensajes.receptor_id = '.$id.' AND mensajes.estado = 0 AND mensajes.tipo_mensaje_id = '.$tipo_mensaje_id.' GROUP BY mensajes.emisor_id ORDER BY mensajes.created_at DESC LIMIT 3');
        return $ultimos_mensajes_no_leidos;
    }
    // Devuelve todos los mensajes destinados al usuario logueado
    public static function todosMensajesPorUsuario($id){
        $todos_mensajes_no_leidos = DB::select('SELECT mensajes.*,users.name, users.username1, users.username2,users.user_image FROM mensajes INNER JOIN users ON users.id = mensajes.emisor_id where mensajes.receptor_id = '.$id.' GROUP BY mensajes.emisor_id ORDER BY mensajes.created_at');
        return $todos_mensajes_no_leidos;
    }
}
