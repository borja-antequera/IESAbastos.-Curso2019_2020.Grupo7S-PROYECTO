@extends('layouts.index')

@section('title', 'Menús')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Menús</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Menús</a></li>
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
                    <th>Desayuno</th>
                    <th>Primero</th>
                    <th>Segundo</th>
                    <th>Postre</th>
                    <th>Merienda</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $menu)

                        <tr>
                            <td>{{$menu->menu_nombre}}</td>
                            <td>{{$menu->menu_desayuno_nombre}}</td>
                            <td>{{$menu->menu_primero_nombre}}</td>
                            <td>{{$menu->menu_segundo_nombre}}</td>
                            <td>{{$menu->menu_postre_nombre}}</td>
                            <td>{{$menu->menu_merienda_nombre}}</td>
                            <td>
                                <a href="/menus/{{$menu->menu_slug}}"><i class="fa fa-eye"></i></a>&nbsp;
                                <a href="/menus/{{$menu->menu_slug}}/edit"><i class="fa fa-edit"></i></a>&nbsp;
                                
                                @if(agendaInfantil\Menu::menu_aulas($menu->id) > 0)
                                  <a style="opacity:.5;cursor:pointer;" class="disabled no-eliminar" disabled><i class="fa fa-trash"></i></a>
                                @else
                                  <a href="#" onclick="document.getElementById('menu_delete').submit()"><i class="fa fa-trash"></i></a>
                                 
                                  <form class="form-group" id="menu_delete" method="POST" action="/menus/{{$menu->menu_slug}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                  </form>
                                @endif
                               
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

    $('.no-eliminar').click(function(){
         toastr.info("No se puede eliminar un menú asociado a un aula");
    })
  });
</script>

@endsection