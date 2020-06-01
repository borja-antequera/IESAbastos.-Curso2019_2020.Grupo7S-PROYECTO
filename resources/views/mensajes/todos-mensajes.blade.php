@extends('layouts.index')

@section('title', 'Todos mensajes')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Listado de mensajes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Mensajes</a></li>
              <li class="breadcrumb-item active">{{$usuario->name}} {{$usuario->username1}} {{$usuario->username2}}</li>
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
                    <th>Tipo de Mensaje</th>
                    <th>Emisor</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mensajes as $mensaje)

                        <tr>
                            <td class="text-center"><i style="color:{{ agendaInfantil\TipoMensaje::find($mensaje->tipo_mensaje_id)->color}};font-weight:bold;" class="fa fas {{ agendaInfantil\TipoMensaje::find($mensaje->tipo_mensaje_id)->icono}}"></i></td>
                            <td>{{agendaInfantil\User::find($mensaje->emisor_id)->name}} {{agendaInfantil\User::find($mensaje->emisor_id)->username1}} {{agendaInfantil\User::find($mensaje->emisor_id)->username2}}</td>                            
                            @php
                                $usuario_rol = agendaInfantil\User::find($mensaje->emisor_id)->rol_id;
                                $rol = agendaInfantil\Role::find($usuario_rol);
                            @endphp
                            <td>{{$rol->rol_nombre}}</td>                            
                            <td>{{($mensaje->estado == 0) ? 'No Leído' : 'Leído' }}</td>
                            <td>{{date("d/m/Y H:i", strtotime($mensaje->created_at))}}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    @php
                                        $url = "";
                                        $rol_emisor = agendaInfantil\User::find($mensaje->emisor_id)->rol_id;
                                        if($rol_usuario == 1 && $rol_emisor == 3){
                                            $url = "/mensajes/director/tutor/$mensaje->emisor_id";
                                        }elseif($rol_usuario == 2 && $rol_emisor == 3){
                                            $url = "/mensajes/profesor/tutor/$mensaje->emisor_id";
                                        }elseif($rol_usuario == 2 && $rol_emisor == 1){
                                            $url = "/mensajes/director/profesor/$mensaje->emisor_id";
                                        }elseif($rol_usuario == 3  && $rol_emisor == 2){
                                             $url = "/mensajes/tutor/profesor/$mensaje->emisor_id";
                                        }elseif($rol_usuario == 3  && $rol_emisor == 1){
                                             $url = "/mensajes/tutor/director/$mensaje->emisor_id";
                                        }
                                    @endphp
                                  <a href="<?php echo $url; ?>"><i class="fa fa-envelope"></i></a>&nbsp;
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
      "order": [[ 1, "asc" ]],
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection