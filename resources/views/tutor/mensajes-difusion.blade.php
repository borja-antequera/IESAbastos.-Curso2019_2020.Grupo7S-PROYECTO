@extends('layouts.index')

@section('title', 'Profesores del Niño')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Listado de profesores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Listado de profesores</a></li>
              <li class="breadcrumb-item active">{{$nino->nombre}} {{$nino->apellido1}} {{$nino->apellido2}}</li>
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
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($profesores as $profesor)

                        <tr>
                            <td>{{$profesor->name}} {{$profesor->username1}} {{$profesor->username2}}</td>
                           
                            <td>
                                <div class="d-flex justify-content-around">
                                  <a href="/mensajes/tutor/profesor/{{$profesor->id}}" class=""><i class="fa fa-envelope"></i></a>&nbsp;                                  
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