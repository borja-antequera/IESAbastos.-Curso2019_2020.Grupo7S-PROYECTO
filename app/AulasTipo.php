<?php

namespace agendaInfantil;

use Illuminate\Database\Eloquent\Model;
use agendaInfantil\Aula;

class AulasTipo extends Model
{
  protected $fillable = ['aula_tipo_nombre', 'aula_tipo_capacidad'];
    // Relación 1:1 entre Aulas y AulasTipo
    public function aulas()
    {
      return $this->belongsTo('agendaInfantil\Aula');
    }
}
