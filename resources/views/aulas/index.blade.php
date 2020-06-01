@extends('layouts.index')

@section('title', 'Aulas')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Aulas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Centros</a></li>
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
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Centro</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($aulas as $aula)

                        <tr>
                            <td>{{$aula->aula_nombre}}</td>

                            <td>{{ agendaInfantil\AulasTipo::find($aula->aula_tipo_id)->aula_tipo_nombre }}</td>

                            <td>{{ agendaInfantil\Centro::find($aula->aula_centro_id)->centro_nombre }}</td>

                            <td>{{$aula->aula_descripcion}}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                  <a href="/aulas/{{$aula->aula_slug}}"><i class="fa fa-eye"></i></a>&nbsp;
                                  <a href="/aula_menu/create?id_aula={{$aula->id}}" class=""><i class="fa fa-utensils"></i></a>&nbsp;
                                 
                                  @php
                                    $id_user_login = auth()->user()->id;
                                    $usuario_rol = agendaInfantil\User::find($id_user_login)->rol_id;
                                  @endphp

                                  @if($usuario_rol == 2) 
                                   <a href="/mensajes/aulas/{{$aula->aula_slug}}" class=""><i class="fa fa-envelope"></i></a>&nbsp;
                                  @endif 
                                  <a class=""><i class="fa fa-edit"></i></a>&nbsp;
                                   @if($usuario_rol != 2) 
                                    <a href="/aulas/eliminar/{{$aula->id}}" class=""><i class="fa fa-trash"></i></a>&nbsp;
                                  @endif
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