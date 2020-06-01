<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;
use agendaInfantil\Aula;
use agendaInfantil\Menu;

class AulaMenu extends Model
{
    // Tabla intermedia de la relación N:N entre Aulas y Menus
    public function aulas()
    {
        return $this->hasMany('agendaInfantil\Aula');
    }
    // Relacion 1: N entre 
    public function menus(){
        return $this->hasMany('agendaInfantil\Menu');
    }
}
