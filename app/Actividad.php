<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //
    protected $table = "actividades";

    // Relación 1:N entre las clases Actividad y Deposiciones
    public function deposiciones(){
        return $this->hasMany('agendaInfantil\Deposicion');
    }
}
