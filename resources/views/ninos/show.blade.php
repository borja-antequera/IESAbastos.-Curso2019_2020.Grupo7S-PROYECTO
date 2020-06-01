@extends('layouts.index')

@section('title', 'Alumno')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">{{ $nino->nino_nombre }}</h3>
                    <h5 class="widget-user-desc">{{ $nino->nino_apellido1 }} {{ $nino->nino_apellido2 }}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="/images/{{ $nino->nino_imagen }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ $edad_nino}} @if($edad_nino == 1) año @else años @endif</h5>
                                <span class="description-text">EDAD</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{$padre_nino->name}} {{$padre_nino->username1}} {{$padre_nino->username2}}</h5>
                                <span class="description-text">TUTOR</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">{{ $aula_nino->aula_nombre }}</h5>
                                <span class="description-text">AULA</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12 col-md-12">
            <hr>
            <table id="lista_registros" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Ausencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actividades as $registro)

                    <tr>
                        <td>{{date("d-m-Y", strtotime($registro->actividad_fecha))}}</td>

                        <td>{{date("H:i:s", strtotime($registro->actividad_hora_llegada))}}</td>

                        <td>{{date("H:i:s", strtotime($registro->actividad_hora_salida))}}</td>

                        <td>
                            @if($registro->actividad_ausencia == 0)
                               No
                            @else
                                Sí
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <a class="btn btn-success" href="/actividad/detalle/{{$registro->id}}"><i class="fa fa-eye"></i> Detalle</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js-no-comunes')

<script>
  $(function () {

    $('#lista_registros').DataTable({
      "paging": true,
      "language": {"url": "{{ asset('lang/spanish.json')}}"},
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection