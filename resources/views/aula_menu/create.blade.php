@extends('layouts.index')

@section('title', 'Asignar Menus a Aulas')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Asociar Menus Aulas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Menus Aulas</a></li>
              <li class="breadcrumb-item active">Asociar Menus Aulas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
            @include('common.errors')
            <form class="form-group" method="POST" action="/aula_menu" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Aula</label>
                    <input type="hidden" value="<?php echo $_GET['id_aula'] ?>" name="aula_id" />
                    <input disabled="" type="text" value="{{ agendaInfantil\Aula::find($_GET['id_aula'])->aula_nombre }}  " class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Menus</label>
                    <select class="form-control" name="menu_id">
                        @foreach($menus as $menu)
                          <option value="{{$menu->id}}">{{$menu->menu_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Fecha</label>
                    <input type="date" value="<?php echo date("Y-m-d") ?>" name="fecha_asociada" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
                <a href="/aulas" class="btn btn-success pull-right">Volver al listado</a>
                 
            </form>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                <hr>
                <h3>Listado de menus asociados</h3>
                <table id="lista_aulas_menus" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Aula</th>
                    <th>Menú</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($aulas_menus as $aula_menu)

                        <tr>  
                            <td>{{ agendaInfantil\Aula::find($aula_menu->aula_id)->aula_nombre }}</td>

                            <td>{{ agendaInfantil\Menu::find($aula_menu->menu_id)->menu_nombre }}</td>

                            <td>{{$aula_menu->fecha_asociada}}</td>
                            <td>                          
                                <a href="/aula_menu/{{$aula_menu->id}}/edit" class=""><i class="fa fa-edit"></i></a>&nbsp;
                                <a class=""><i class="fa fa-trash"></i></a>&nbsp;
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

    $('#lista_aulas_menus').DataTable({
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