<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $fillable = ['menu_nombre','menu_desayuno_nombre','menu_primero_nombre','menu_segundo_nombre','menu_postre_nombre','menu_merienda_nombre','menu_slug'];
    /**
    * Get the route key for the model.
    *
    * @return string
    */
    // cambiar id por slug en el enrutamiento
    public function getRouteKeyName(){
        return 'menu_slug';
    }
}