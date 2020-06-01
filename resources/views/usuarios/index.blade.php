@extends('layouts.index')

@section('title', 'Usuarios')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
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
                <table id="lista_usuarios" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Nombre y apellidos</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha Nacimiento</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                      <!-- Comprueba que el usuario logueado no se liste -->
                      @if($usuario->id != auth()->user()->id)
                        <tr>
                          <td>{{$usuario->name}} {{$usuario->username1}} {{$usuario->username2}}</td>

                          <td>{{$usuario->email}}</td>

                          <td>{{agendaInfantil\Role::find($usuario->rol_id)->rol_nombre }}</td>

                          <td><?php echo date('d-m-Y', strtotime($usuario->birth_date)); ?></td>
                          <td class="d-flex justify-content-around">
                            <a href="/usuarios/{{$usuario->id}}"><i class="fa fa-eye"></i></a>
                            <a href="/usuarios/{{$usuario->id}}/edit"><i class="fa fa-edit"></i></a>
                            @if(auth()->user()->rol_id == 4 || auth()->user()->rol_id == 1)
                              <a><i class="fa fa-trash"></i></a>
                            @endif
                          </td>
                        </tr>                      
                     @endif 
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

    $('#lista_usuarios').DataTable({
      "paging": true,
      "language": {"url": "{{ asset('lang/spanish.json')}}"},
      "lengthChange": true,
      "searching": true,
      "ordering": true,      
      "order": [[ 2, "asc" ]],
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection