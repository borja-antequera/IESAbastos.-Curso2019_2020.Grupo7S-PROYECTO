<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;
use agendaInfantil\Actividad;

class Deposicion extends Model
{
    //
    protected $table = "deposiciones";
    // Relacion 1:n con actividad
    public function actividad(){
        return $this->belongsTo('agendaInfantil\Actividad');
    }

}
