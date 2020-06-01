@extends('layouts.index')

@section('title', 'Alumnos')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Alumnos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Alumnos</a></li>
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
                <table id="lista_aulas" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Nombre y Apellidos</th>
                    <th>Fecha nacimiento</th>
                    <th>Padre</th>
                    <th>Aula</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ninos as $nino)
                      <tr>
                        <td>{{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}}</td>
                        <td>{{$nino->nino_fecha_nacimiento}}</td>
                        <td>{{ agendaInfantil\User::find($nino->usuario_id)->name }} {{ agendaInfantil\User::find($nino->usuario_id)->username1 }} {{ agendaInfantil\User::find($nino->usuario_id)->username2 }}</td>
                        <td>{{ agendaInfantil\Aula::find($nino->aula_id)->aula_nombre }}</td>
                        <td>
                          <div class="d-flex justify-content-around">
                              <a href="/ninos/{{$nino->slug}}"><i class="fa fa-eye"></i></a>&nbsp;
                              @if(Auth::user()->rol_id == 1)
                                <a href="/mensajes/director/tutor/{{$nino->usuario_id}}"><i class="fa fa-envelope"></i></a>&nbsp;
                              @endif
                              <a class=""><i class="fa fa-edit"></i></a>&nbsp;
                              <a  style="cursor:pointer;" data-toggle="modal" data-target="#modalNino{{$nino->id}}"><i class="fa fa-trash"></i></a>&nbsp;
                            </div>
                        </td>
                      </tr>
                      <div class="modal fade" id="modalNino{{$nino->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                   <div class="modal-header">
                                    <h4 class="modal-title"><i class="fa fa-info-circle"></i> Eliminar alumno</h4>
                                  </div>
                                  <div class="modal-body">
                                      <p class="text-center">
                                        El alumno {{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}}
                                        tiene {{agendaInfantil\Nino::total_actividades_diarias($nino->id)}} registros de actividad diaria asociado. ¿Estás seguro que desea eliminar al alumno?
                                      </p>
                                  </div>
                                  <div class="modal-footer">
                                    <a class="btn btn-warning pull-right" href="#" onclick="document.getElementById('nino_delete{{$nino->id}}').submit()">
                                      <i class="fa fa-trash"></i> Eliminar
                                    </a>
                                     <a href="#" data-dismiss="modal" class="btn btn-primary pull-right">
                                      <i class="fa fa-arrow-left"></i> Cerrar
                                    </a>
                                 
                                    <form class="form-group" id="nino_delete{{$nino->id}}" method="POST" action="/ninos/{{$nino->id}}">
                                      {{ csrf_field() }}
                                      {{ method_field('DELETE') }}
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div><!--fin modal-->
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

    $('#lista_aulas').DataTable({
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