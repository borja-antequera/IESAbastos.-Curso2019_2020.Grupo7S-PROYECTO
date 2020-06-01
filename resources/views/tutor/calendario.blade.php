@extends('layouts.index')

@section('title', 'Calendario Niño')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Actividades de {{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}}</a></li>
              <li class="breadcrumb-item active">{{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
           <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card card-primary">
                <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
    </section>

@endsection


@section('js-no-comunes')

<script>
  $(function () {

    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      // Para cambiar el idioma a castellano
      locale : 'es',
      'themeSystem': 'bootstrap',
      //Random default events
      events    : [
        @foreach($actividades as $actividad)
            @php
                $año = date("Y",strtotime($actividad->actividad_fecha));
                $mes = date("m",strtotime($actividad->actividad_fecha)) - 1;
                $dia = date("d",strtotime($actividad->actividad_fecha));
            @endphp
            {
            title          : 'Actividad ',
            start          :  new Date({{$año}}, {{$mes}}, {{$dia}}),
            backgroundColor: '#f56954', //red
            borderColor    : '#f56954', //red
            allDay         : true,
            url: '/actividad/detalle/{{$actividad->id}}'
            },
            
        @endforeach

      ],   
    });

    calendar.render();
   
  })
</script>

@endsection