@extends('layouts.index')

@section('title', 'Detalle Actividad Niño')

@section('content')
<div class="container-fluid">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detalle Actividad Diaria</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/actividades">Actividades</a></li>
              <li class="breadcrumb-item active"><a href="/ninos/{{$nino_slug}}">{{$nino}}</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="row mt-3">
        <div class="col-lg-4 col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>
                    <!-- Mostramos la información del menú asignado para el aula en el día de hoy. Siempre ha de haber uno -->
                    <h3 class="box-title">Menú: <b class="pull-right">{{ $menu->menu_nombre }}</b></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="menu_desayuno_nombre">Desayuno:</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $menu->menu_desayuno_nombre }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="menu_desayuno_nombre">Primero:</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $menu->menu_primero_nombre }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="menu_desayuno_nombre">Segundo:</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $menu->menu_segundo_nombre }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="menu_desayuno_nombre">Postre:</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $menu->menu_postre_nombre }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="menu_desayuno_nombre">Merienda:</label>
                        </div>
                        <div class="col-md-8">
                            <p>{{ $menu->menu_merienda_nombre }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Si hay una valoración de menú, se muestra la valoración -->
        @if($contador_menu_valoraciones > 0)
        <div class="col-lg-3 col-md-3">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>
                    <h3 class="box-title">Valoración Menú</h3>
                </div>
                <div class="box-body">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="menuNombre">Desayuno:</label>
                        </div>
                        <div class="col-md-8">
                            <div class="progress mt-1">
                                <div class="progress-bar {{ agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_desayuno_id)->clase }} progress-bar-striped" role="progressbar" aria-valuenow="{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_desayuno_id)->porciento}}" aria-valuemin="0" aria-valuemax="100" style="width: {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_desayuno_id)->porciento}}%">
                                <span class="sr-only">{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_desayuno_id)->porciento}}% Complete (success)</span>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="menuNombre">Primero:</label>
                        </div>
                        <div class="col-md-8">
                        
                            <div class="progress mt-1">
                                <div class="progress-bar {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_primero_id)->clase}} progress-bar-striped" role="progressbar" aria-valuenow="{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_primero_id)->porciento}}" aria-valuemin="0" aria-valuemax="100" style="width: {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_primero_id)->porciento}}%">
                                    <span class="sr-only">{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_primero_id)->porciento}}% Complete (success)</span>
                                </div>
                            </div>          
                            
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="menuNombre">Segundo:</label>
                        </div>
                        <div class="col-md-8">
                        
                            <div class="progress mt-1">
                                <div class="progress-bar {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_segundo_id)->clase}} progress-bar-striped" role="progressbar" aria-valuenow="{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_segundo_id)->porciento}}" aria-valuemin="0" aria-valuemax="100" style="width: {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_segundo_id)->porciento}}%">
                                    <span class="sr-only">{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_segundo_id)->porciento}}% Complete (success)</span>
                                </div>
                            </div>         
                            
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="menuNombre">Postre:</label>
                        </div>
                        <div class="col-md-8">
                        
                            <div class="progress mt-1">
                                <div class="progress-bar {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_postre_id)->clase}} progress-bar-striped" role="progressbar" aria-valuenow="{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_postre_id)->porciento}}" aria-valuemin="0" aria-valuemax="100" style="width: {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_postre_id)->porciento}}%">
                                    <span class="sr-only">{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_postre_id)->porciento}}% Complete (success)</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="menuNombre">Merienda:</label>
                        </div>
                        <div class="col-md-8">
                        
                            <div class="progress mt-1">
                                <div class="progress-bar {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_merienda_id)->clase}} progress-bar-striped" role="progressbar" aria-valuenow="{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_merienda_id)->porciento}}" aria-valuemin="0" aria-valuemax="100" style="width: {{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_merienda_id)->porciento}}%">
                                    <span class="sr-only">{{agendaInfantil\ValoracionMenu::find($menu_valoracion[0]->menu_valoracion_merienda_id)->porciento}}% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Si no la hay se muestra un mensaje -->
        @else
        <div class="col-lg-3 col-md-3">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>
                    <h3 class="box-title">Valoración Menú</h3>
                </div>
                <div class="box-body">
                    <div class= "row">
                        <div class="col-lg-12">
                            <h6><i class="fa fa-info-circle"></i> No hay valoración asociada.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="col-lg-5 col-md-5">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>
                    <h3 class="box-title">Biberones</h3>
                </div>
                <div class="box-body">
                    <!-- Si hay biberones en el registro, los mostramos-->
                    @if( count($biberones) > 0)
                        @foreach($biberones as $biberon)
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="">Tipo de biberón</label>
                                    <input type="text" value="{{ agendaInfantil\TipoBiberon::find($biberon->tipo_biberon_id)->nombre }}" class="form-control disabled" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group col-md-12">
                                    <label for="">Hora</label>
                                    <input type="text" value="{{ date("H:i", strtotime($biberon->biberon_hora)) }}" class="form-control disabled" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group col-md-12">
                                    <label for="">Cantidad</label>                               
                                    <input type="text" value="{{ $biberon->biberon_cantidad }}" class="form-control disabled" disabled>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Si no los hay, mostramos un mensaje informándolo-->
                        <div class= "row">
                            <div class="col-lg-12">
                                <h6><i class="fa fa-info-circle"></i> No hay tomas de biberón.</h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-6 col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>

                    <h3 class="box-title">Deposiciones</h3>
                </div>
                <div class="box-body">
                <!-- Si hay deposiciones, las mostramos-->
                    @if(count($deposiciones) > 0 )
                     @foreach($deposiciones as $deposicion)
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <p>{{$deposicion->deposicion_tipo}}</p>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <input class="form-control" type="number" disabled value="{{$deposicion->deposicion_numero}}" />
                            </div>
                            <div class="col-lg-7 col-md-7">
                                <textarea row="2" disabled class="form-control">{{$deposicion->deposicion_comentarios}}</textarea>
                            </div>
                        </div>
                     @endforeach
                     @else
                        <!-- Si no las hay, mostramos un texto informándolo-->
                        <div class= "row">
                            <div class="col-lg-12">
                                <h6><i class="fa fa-info-circle"></i> No hay registro de deposiciones</h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>

                    <h3 class="box-title">Sueño</h3>
                </div>
                <div class="box-body">
                <!-- Si hay registros de sueño, los mostramos-->
                    @if(count($suenos) > 0)
                        @foreach($suenos as $sueno)
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group col-md-12">
                                    <label for="">Hora de Inicio</label>
                                    <input type="text" value="{{ date("H:i", strtotime($sueno->sueno_hora_inicio))}}" class="form-control disabled" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group col-md-12">
                                    <label for="">Hora de Fin</label>
                                    <input type="text" value="{{ date("H:i", strtotime($sueno->sueno_hora_fin))}}" class="form-control disabled" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group col-md-12">
                                    <label for="">Total</label>
                                    @php
                                    $fecha1 = new DateTime($sueno->sueno_hora_inicio);//fecha inicial
                                    $fecha2 = new DateTime($sueno->sueno_hora_fin);//fecha de cierre

                                    $intervalo = $fecha1->diff($fecha2);
                                    $formato = $intervalo->format('%H : %im');
                                    @endphp
                                    <input type="text" value="<?php echo $formato; ?>" class="form-control disabled" disabled>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Si no los hay, mostramos un mensaje informándolo-->
                        <div class= "row">
                            <div class="col-lg-12">
                                <h6><i class="fa fa-info-circle"></i> No hay sueños asociados</h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12 col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>

                    <h3 class="box-title">Imágenes</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <!-- Si hay registros de imágenes, las mostramos-->
                        @if(count($imagenes) > 0)
                            @foreach($imagenes as $imagen)
                            <div class="col-lg-3">
                                <img class="img-responsive img-thumbnail" src="/{{ $imagen->imagen_ruta}}" />
                            </div>
                            @endforeach
                        @else
                            <!-- Si no las hay, mostramos un mensaje informándolo-->
                            <div class="col-lg-12">
                                <h6><i class="fa fa-info-circle"></i> No hay imágenes asociados</h6>
                            </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
