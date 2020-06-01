@extends('layouts.index')

@section('title', 'Centros')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Centros</h1>
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
            @include('common.success')
            <div class="row">
                <div class="col-lg-12 col-md-12">
                <table id="lista_centros" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($centros as $centro)

                        <tr>
                            <td>
                            <img style="height:40px; width: 40px; background-color: #EFEFEF; margin: 20px;"
                                src="/images/{{$centro->centro_imagen}}" class="card-img-top rounded-circle mx-auto d-block" alt="...">
                                </td>
                            <td>{{$centro->centro_nombre}}</td>
                            <td>{{$centro->centro_direccion}}</td>
                            <td>
                              <div class="d-flex justify-content-around">
                                  <a  href="/centros/{{$centro->slug}}"><i class="fa fa-eye"></i></a>
                                  <a  href="/centros/{{$centro->slug}}/edit"><i class="fa fa-edit"></i></a>
                                  @if( Auth::user()->rol_id < 4 )
                                    <a  href="/mensajes/centro/{{$centro->slug}}"><i class="fa fa-envelope"></i></a>
                                  @endif
                                  @if( Auth::user()->rol_id == 4 )
                                    <a href="/centros/eliminar/{{$centro->id}}"><i class="fa fa-trash"></i></a>
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