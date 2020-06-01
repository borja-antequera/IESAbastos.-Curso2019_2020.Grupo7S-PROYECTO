@extends('layouts.index')

@section('title', 'Crear Aulas')

@section('content')
<!-- obtenemos el id del niño de la url -->
<?php
        $id_nino = $_GET['id_nino'];       
    ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Actividades Diarias</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Actividades Diarias</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        @include('common.errors')
        <form class="form-group" method="POST" action="/actividades" enctype="multipart/form-data">
            @csrf
            <!-- En input hidden enviamos el id del menu del dia del aula y el id del niño-->
            <input type="hidden" value="{{$menu_actual->id}}" name="registro_menu_id" />
            <input type="hidden" value="{{$id_nino}}" name="registro_nino_id" />
            <div class="col-md-12">
                <div class="panel-group margin_0" id="accordion1">
                    <div class="panel panel-default">
                        <div class="panel-heading gris">
                            <h4 class="panel-title">
                                <a class="collapsed gris" data-toggle="collapse" data-parent="#accordion1" href="#collapse1">
                                    <i class="rt-icon2-bubble highlight"></i>Registro Actividad Diaria
                                </a>
                            </h4>
                        </div>
                        <div style="height: 0px;" id="collapse1" class="panel-collapse collapse">

                            <div class="container-fluid">
                                <div style="overflow-x: hidden;" class="panel-body">
                                    <div class="row mt-3">
                                        <div class="form-group col-md-4">
                                            <label for="">Fecha del registro:</label>
                                            <input type="date" name="actividad_fecha_registro" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Hora de Entrada:</label>
                                            <input type="time" name="actividad_hora_llegada" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Hora de Salida:</label>
                                            <input type="time" name="actividad_hora_salida" class="form-control">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="custom-control custom-checkbox  mb-3">
                                                <input name="actividad_ausencia" type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">Ausencia</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="rosa" data-toggle="collapse" data-parent="#accordion1" href="#collapse2" class="collapsed">
                                        <i class="rt-icon2-bubble highlight"></i>
                                        Comida
                                    </a>
                                </h4>
                            </div>
                            <div style="height: 0px;" id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">

                                    <div class="form-group row col-md-12">
                                        <label class="col-md-2" for="">Desayuno:</label>
                                        <!--En este input almacenamos el nombre del desayuno del menu asignado hoy al aula del niño-->
                                        <input value="{{$menu_actual->menu_desayuno_nombre}}" class="col-md-4" type="text" name="" class="form-control">
                                        <div class="col-md-6">
                                            <input name="todo_desayuno" class="todo_desayuno" data-on="Todo" data-off="Todo" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="success">
                                            <input name="bastante_desayuno" class="bastante_desayuno" data-on="Bastante" data-off="Bastante" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="primary">
                                            <input name="poco_desayuno" class="poco_desayuno" data-on="Poco" data-off="Poco" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="warning">
                                            <input name="nada_desayuno" class="nada_desayuno" data-on="Nada" data-off="Nada" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="danger">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label class="col-md-2" for="">Primero:</label>
                                        <!--En este input almacenamos el nombre del primer plato del menu asignado hoy al aula del niño -->
                                        <input value="{{$menu_actual->menu_primero_nombre}}" class="col-md-4" type="text" name="" class="form-control">
                                        <div class="col-md-6">
                                            <input name="todo_primero" class="todo_primero" data-on="Todo" data-off="Todo" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="success">
                                            <input name="bastante_primero" class="bastante_primero" data-on="Bastante" data-off="Bastante" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="primary">
                                            <input name="poco_primero" class="poco_primero" data-on="Poco" data-off="Poco" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="warning">
                                            <input name="nada_primero" class="nada_primero" data-on="Nada" data-off="Nada" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="danger">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label class="col-md-2" for="">Segundo:</label>
                                        <!--En este input almacenamos el nombre del segundo plato del menu asignado hoy al aula del niño -->
                                        <input value="{{$menu_actual->menu_segundo_nombre}}" class="col-md-4" type="text" name="" class="form-control">
                                        <div class="col-md-6">
                                            <input name="todo_segundo" class="todo_segundo" data-on="Todo" data-off="Todo" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="success">
                                            <input name="bastante_segundo" class="bastante_segundo" data-on="Bastante" data-off="Bastante" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="primary">
                                            <input name="poco_segundo" class="poco_segundo" data-on="Poco" data-off="Poco" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="warning">
                                            <input name="nada_segundo" class="nada_segundo" data-on="Nada" data-off="Nada" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="danger">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label class="col-md-2" for="">Postre:</label>
                                        <!--En este input almacenamos el nombre del postre del menu asignado hoy al aula del niño -->
                                        <input value="{{$menu_actual->menu_postre_nombre}}" class="col-md-4" type="text" name="" class="form-control">
                                        <div class="col-md-6">
                                            <input name="todo_postre" class="todo_postre" data-on="Todo" data-off="Todo" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="success">
                                            <input name="bastante_postre" class="bastante_postre" data-on="Bastante" data-off="Bastante" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="primary">
                                            <input name="poco_postre" class="poco_postre" data-on="Poco" data-off="Poco" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="warning">
                                            <input name="nada_postre" class="nada_postre" data-on="Nada" data-off="Nada" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="danger">
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label class="col-md-2" for="">Merienda:</label>
                                        <!--En este input almacenamos el nombre de la merienda del menu asignado hoy al aula del niño -->
                                        <input value="{{$menu_actual->menu_merienda_nombre}}" class="col-md-4" type="text" name="" class="form-control">
                                        <div class="col-md-6">
                                            <input name="todo_merienda" class="todo_merienda" data-on="Todo" data-off="Todo" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="success">
                                            <input name="bastante_merienda" class="bastante_merienda" data-on="Bastante" data-off="Bastante" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="primary">
                                            <input name="poco_merienda" class="poco_merienda" data-on="Poco" data-off="Poco" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="warning">
                                            <input name="nada_merienda" class="nada_merienda" data-on="Nada" data-off="Nada" type="checkbox" data-toggle="toggle" data-width="100" data-onstyle="danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--obtenemos el id del aula a través del id del niño -->
                        @php
                        $ninoAulaAsociado = agendaInfantil\Nino::find($id_nino)->aula_id;
                        @endphp
                        <!-- Esta sección de biberón sólo se muestra si el id del aula es 1 o 2, es decir, aulas para niños de 0-1 años o de 1-2 años -->
                        @if(agendaInfantil\Aula::find($ninoAulaAsociado)->aula_tipo_id < 3) <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="celeste" data-toggle="collapse" data-parent="#accordion1" href="#collapse3" class="collapsed">
                                        <i class="rt-icon2-bubble highlight"></i>
                                        Biberón
                                    </a>
                                </h4>
                            </div>
                            <div style="height: 0px;" id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">

                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-4">
                                            <label>Tipo de Biberón</label>
                                            <select class="form-control" name="tipo_biberon_id_1">
                                                @foreach($tipo_biberones as $tipo_biberon)
                                                <option value="{{ $tipo_biberon->id }}">{{ $tipo_biberon->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Hora de la toma</label>
                                            <input type="time" class="form-control" name="biberon_hora_1" />
                                        </div>
                                        <div class="col-md-4">
                                            <label>Cantidad (ml)</label>
                                            <input type="number" value="0" class="form-control" name="biberon_cantidad_1" />
                                        </div>
                                    </div>

                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-4">
                                            <select class="form-control" name="tipo_biberon_id_2">
                                                @foreach($tipo_biberones as $tipo_biberon)
                                                <option value="{{ $tipo_biberon->id }}">{{ $tipo_biberon->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="time" class="form-control" name="biberon_hora_2" />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" value="0" class="form-control" name="biberon_cantidad_2" />
                                        </div>
                                    </div>

                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-4">
                                            <select class="form-control" name="tipo_biberon_id_3">
                                                @foreach($tipo_biberones as $tipo_biberon)
                                                <option value="{{ $tipo_biberon->id }}">{{ $tipo_biberon->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="time" class="form-control" name="biberon_hora_3" />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" value="0" class="form-control" name="biberon_cantidad_3" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
                    @endif

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="verde" data-toggle="collapse" data-parent="#accordion1" href="#collapse4" class="">
                                    <i class="rt-icon2-bubble highlight"></i>
                                    Deposiciones
                                </a>
                            </h4>
                        </div>
                        <div style="" id="collapse4" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <!-- si el id del aula es de 2-3 años, los niños ya no llevan pañal y registramos el número de pipís y cacas en la tabla deposiciones -->
                                @if(agendaInfantil\Aula::find($ninoAulaAsociado)->aula_tipo_id == 3)
                                <div class="row mt-3 mb-3">
                                    <div class="col-md-2">
                                        Pipi
                                    </div>
                                    <div class="col-md-2">                                        
                                        <label>Cantidad</label>
                                        <input type="number" value="0" class="form-control" name="cant_pipi" />
                                    </div>
                                    <div class="col-md-8">
                                        <label>Descripción</label>
                                        <textarea class="form-control" name="comentarios_pipi"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2 mb-3">
                                    <div class="col-md-2">
                                        Caca
                                    </div>
                                    <div class="col-md-2">
                                        <label>Cantidad</label>
                                        <input type="number" value="0" class="form-control" name="cant_caca" />
                                    </div>
                                    <div class="col-md-8">
                                        <label>Descripción</label>
                                        <textarea class="form-control" name="comentarios_caca"></textarea>
                                    </div>
                                </div>
                                @endif
                                <!-- Si el id del aula es menor que 3 significa que es una aula de 0-1 años o 1-2 años, por tanto registramos sólo el número de cambios de pañal en deposiciones-->
                                @if(agendaInfantil\Aula::find($ninoAulaAsociado)->aula_tipo_id < 3) <div class="row mt-3">
                                    <div class="col-md-2">
                                        <label>Cambio de pañal</label>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label>Cantidad</label>
                                        <input type="number" value="0" class="form-control" name="cant_cambio_panal" />
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label>Descripción</label>
                                        <textarea class="form-control" name="comentarios_cambio_panal"></textarea>
                                    </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="morado" data-toggle="collapse" data-parent="#accordion1" href="#collapse5" class="collapsed">
                            <i class="rt-icon2-bubble highlight"></i>
                            Sueño
                        </a>
                    </h4>
                </div>
                <div style="height: 0px;" id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Hora de Inicio:</label>
                                <input type="time" name="sueno_hora_inicio_1" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Hora de Fin:</label>
                                <input type="time" name="sueno_hora_fin_1" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Hora de Inicio:</label>
                                <input type="time" name="sueno_hora_inicio_2" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Hora de Fin:</label>
                                <input type="time" name="sueno_hora_fin_2" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Hora de Inicio:</label>
                                <input type="time" name="sueno_hora_inicio_3" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Hora de Fin:</label>
                                <input type="time" name="sueno_hora_fin_3" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="naranja" data-toggle="collapse" data-parent="#accordion1" href="#collapse6" class="collapsed">
                            <i class="rt-icon2-bubble highlight"></i>
                            Imagenes
                        </a>
                    </h4>
                </div>
                <div style="height: 0px;" id="collapse6" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row mt-3 mb-3">
                            <div class="form-group col-md-12">
                                <label for="">Imágenes:</label>
                                <input type="file" name="imagenes[]" multiple class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <button type="reset" class="btn btn-danger">Limpiar</button>
    </form>
    </div>
</section>
@endsection

@section('js-no-comunes')

<script type="text/javascript">
    // script para controlar el cambio de on a off en los toggle switch de valoracion de comida
    $(document).ready(function() {

        $('.todo_desayuno').change(function() {
            $('.bastante_desayuno,.poco_desayuno,.nada_desayuno').bootstrapToggle('off', true);
        });

        $('.bastante_desayuno').change(function() {
            $('.todo_desayuno,.poco_desayuno,.nada_desayuno').bootstrapToggle('off', true);
        });

        $('.poco_desayuno').change(function() {
            $('.todo_desayuno,.bastante_desayuno,.nada_desayuno').bootstrapToggle('off', true);
        });

        $('.nada_desayuno').change(function() {
            $('.todo_desayuno,.bastante_desayuno,.poco_desayuno').bootstrapToggle('off', true);
        });


        $('.todo_primero').change(function() {
            $('.bastante_primero,.poco_primero,.nada_primero').bootstrapToggle('off', true);
        });

        $('.bastante_primero').change(function() {
            $('.todo_primero,.poco_primero,.nada_primero').bootstrapToggle('off', true);
        });

        $('.poco_primero').change(function() {
            $('.todo_primero,.bastante_primero,.nada_primero').bootstrapToggle('off', true);
        });

        $('.nada_primero').change(function() {
            $('.todo_primero,.bastante_primero,.poco_primero').bootstrapToggle('off', true);
        });

        $('.todo_segundo').change(function() {
            $('.bastante_segundo,.poco_segundo,.nada_segundo').bootstrapToggle('off', true);
        });

        $('.bastante_segundo').change(function() {
            $('.todo_segundo,.poco_segundo,.nada_segundo').bootstrapToggle('off', true);
        });

        $('.poco_segundo').change(function() {
            $('.todo_segundo,.bastante_segundo,.nada_segundo').bootstrapToggle('off', true);
        });

        $('.nada_segundo').change(function() {
            $('.todo_segundo,.bastante_segundo,.poco_segundo').bootstrapToggle('off', true);
        });

        $('.todo_postre').change(function() {
            $('.bastante_postre,.poco_postre,.nada_postre').bootstrapToggle('off', true);
        });

        $('.bastante_postre').change(function() {
            $('.todo_postre,.poco_postre,.nada_postre').bootstrapToggle('off', true);
        });

        $('.poco_postre').change(function() {
            $('.todo_postre,.bastante_postre,.nada_postre').bootstrapToggle('off', true);
        });

        $('.nada_postre').change(function() {
            $('.todo_postre,.bastante_postre,.poco_postre').bootstrapToggle('off', true);
        });

        $('.todo_merienda').change(function() {
            $('.bastante_merienda,.poco_merienda,.nada_merienda').bootstrapToggle('off', true);
        });

        $('.bastante_merienda').change(function() {
            $('.todo_merienda,.poco_merienda,.nada_merienda').bootstrapToggle('off', true);
        });

        $('.poco_merienda').change(function() {
            $('.todo_merienda,.bastante_merienda,.nada_merienda').bootstrapToggle('off', true);
        });

        $('.nada_merienda').change(function() {
            $('.todo_merienda,.bastante_merienda,.poco_merienda').bootstrapToggle('off', true);
        });


    });

</script>

@endsection
