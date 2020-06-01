@extends('layouts.index')

@section('title', 'Aulas')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Aulas</a></li>
              <li class="breadcrumb-item"><a href="#">{{ $aula->aula_nombre }}</a></li>
              <li class="breadcrumb-item active">Ver</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                <center>
                    <div class="widget-user-image widget-icon">
                          <i class="fas fa-apple-alt fa-5x"></i>
                      </div>
                  </div>
                </center>
            </div>
            <div class="row text-center">
              <div class="col-lg-4 offset-lg-4">
                  <div class="col-lg-12">
                    <h4>{{$aula->aula_nombre}}</h4>
                  </div>
                  <div class="col-lg-12">
                      <label>Centro: </label> {{ agendaInfantil\Centro::find($aula->aula_centro_id)->centro_nombre }}
                  </div>
                  <div class="col-lg-12">
                      <label>Tipo: </label> {{ agendaInfantil\AulasTipo::find($aula->aula_tipo_id)->aula_tipo_nombre }}       
                  </div>
                  <div class="col-lg-12">
                      <label>Aforo: </label> 4 - 13 (9 plazas disponibles)
                  </div>
                  <div class="col-lg-12">
                      <label>Educadores: </label>
                  </div>
                 @foreach($aula->users as $user)
                   {{$user->name}} {{$user->username1}} {{$user->username2}} <br>
                 @endforeach

                 
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <hr>
              </div>
            </div>
            <div class="row">
               @foreach($ninos as $nino)
                  <div class="col-lg-3 col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="/images/{{ $nino->nino_imagen }}" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title text-bold">{{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}}</h5>
                          <p class="card-text mt-2 mb-2">
                            Hola, soy {{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}} y nací el {{ date('d-m-Y', strtotime($nino->nino_fecha_nacimiento)) }}
                          </p>
                          <div class="row text-center botonesNinos text-center">
                            <div class="col-lg-3 text-center col-md-3">
                              <!-- se compueba a traves de la funcion tiene_registro_hoy que el niño tenga un registro de actividad asociado hoy. de ser cierto, se le quita el href al icono para no crear dos registros a un niño el mismo día-->
                              @if(agendaInfantil\Nino::tiene_registro_hoy($nino->id) == 0 && $contador_aula_menu > 0)                            
                              <a href="/actividades/create?id_nino={{$nino->id}}">
                                <i class="fas fa-book-open"></i> 
                              </a>
                            @else
                            <a style="opacity:0.4;cursor:not-allowed;" href="#">
                                <i class="fas fa-book-open"></i> 
                              </a>
                            @endif
                            </div>

                            <div class="col-lg-3 text-center col-md-3">
                              <a href="/actividad/nino/{{$nino->id}}">
                                <i class="fa fa-history"></i> 
                              </a>
                            </div>

                            @if(auth()->user()->rol_id > 1 && auth()->user()->rol_id < 4)
                              <div class="col-lg-3 text-center col-md-3">
                                <a href="/mensajes/profesor/tutor/{{$nino->usuario_id}}">
                                  <i class="fa fa-envelope"></i> 
                                </a>
                              </div>
                            @endif
                            
                          </div>
                        </div>
                      </div>
                    </div>
                   <br>
                 @endforeach            
            </div>

        </div>
    </section>

    <div class="modal fade" id="modal-default" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fa fa-info-circle"></i> Asociar Menú</h4>
          </div>
          <div class="modal-body">

            <div class="alert alert-info alert-dismissible">              
              <h4><i class="icon fa fa-info"></i> Alerta!</h4>
                Para poder añadir registros a los niños, debes asociar el menú del día al aula.
              </div>
          </div>
          
          <div class="modal-footer">
            <a class="btn btn-warning pull-right" href="/aula_menu/create?id_aula={{$aula->id}}"><i class="fa fa-utensils"></i> Asociar Menú</a>
          </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('js-no-comunes')

<script>
  // Si la variable $contador_aula_menu esta a 0 es que no hay menu asignado hoy para este aula y se activa el modal
  $(document).ready(function(){
    @if($contador_aula_menu == 0)
     $("#modal-default").modal("show");
    @endif 
  });
</script>

@endsection
