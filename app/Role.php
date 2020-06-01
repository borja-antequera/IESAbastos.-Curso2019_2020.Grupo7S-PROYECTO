<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Relación 1:1 entre Role y User
    public function users(){
        return $this->belongsTo('agendaInfantil\User');
    }
}
