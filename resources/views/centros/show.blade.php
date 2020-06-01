@extends('layouts.index')

@section('title', 'Centro')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Vista del centro</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Centros</a></li>
              <li class="breadcrumb-item active">Vista del centro</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @include('common.success')
    

    <section class="content">
        <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <h2 style="font-weight: bold;" class="widget-user-username text-bold">{{ $centro->centro_nombre }}</h2> 
                        <h5 class="widget-user-desc">{{$centro->centro_direccion}}</h5>                   
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="/images/{{$centro->centro_imagen}}" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row container-fluid">
                            <!-- /.col -->
                            <div class="col-sm-12">
                                <div class="description-block">
                                    <h5 style="font-weight:300;" class="description-header">{{$centro->centro_descripcion}}</h5>
                                    <span class="description-text">DESCRIPCIÓN</span>
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
        <div class="row">            
            <div class="col-lg-12 col-md-12">
            <h3>Aulas asociadas</h3>
            <hr>
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
                @foreach($aulas_centro as $aula)

                    <tr>
                        <td>{{$aula->aula_nombre}}</td>

                        <td>{{ agendaInfantil\AulasTipo::find($aula->aula_tipo_id)->aula_tipo_nombre }}</td>

                        <td>{{ agendaInfantil\Centro::find($aula->aula_centro_id)->centro_nombre }}</td>

                        <td>{{$aula->aula_descripcion}}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <a href="/aulas/{{$aula->aula_slug}}"><i class="fa fa-eye"></i></a>&nbsp;
                                <a href="/aula_menu/create?id_aula={{$aula->id}}" class=""><i class="fa fa-utensils"></i></a>&nbsp;
                                
                                </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>

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