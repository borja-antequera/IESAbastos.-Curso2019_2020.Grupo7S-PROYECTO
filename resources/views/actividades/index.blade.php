@extends('layouts.index')

@section('title', 'Actividades Diarias')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Actividades Diarias</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Actividades Diarias</a></li>
              <li class="breadcrumb-item active">Listar</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                <table id="lista_centros" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Centro</th>
                    <th>Aula</th>
                    <th>Niño</th>
                    <th>Fecha Actividad</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($actividades as $actividad)

                       @php
                           $nino = agendaInfantil\Nino::find($actividad->nino_id);
                           $aula =  agendaInfantil\Aula::find($nino->aula_id);                           
                           $centro =  agendaInfantil\Centro::find($aula->aula_centro_id)->centro_nombre;
                       @endphp 
                      <tr>
                        <td>{{$centro}}</td>
                        <td>{{$aula->aula_nombre}}</td>                       
                        <td>{{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}}</td>
                        <td>{{date("d-m-Y", strtotime($actividad->actividad_fecha))}}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <a href="/actividad/detalle/{{$actividad->id}}"><i class="fa fa-eye"></i></a>
                                <a href="#"><i class="fa fa-edit"></i></a>
                                <a href="#"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                      </tr>  
                    @endforeach

                    </tbody>
              </table>

            </div>
        </div>

        </div>
    </section>
@endsection

@section('js-no-comunes')

<script>
  $(function () {

    $('#lista_centros').DataTable({
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