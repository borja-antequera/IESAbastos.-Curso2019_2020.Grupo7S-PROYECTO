@extends('layouts.index')

@section('title', 'Editar Menús')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Editar Menú</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Menús</a></li>
              <li class="breadcrumb-item active">Editar</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
            @include('common.errors')
            <form class="form-group" method="POST" action="/menus/{{$menu->menu_slug}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">Nombre del Menú</label>
                    <input type="text" name="menu_nombre" value="{{$menu->menu_nombre}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Desayuno</label>
                    <input type="text" name="menu_desayuno_nombre" value="{{$menu->menu_desayuno_nombre}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Primer Plato</label>
                    <input type="text" name="menu_primero_nombre" value="{{$menu->menu_primero_nombre}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Segundo Plato</label>
                    <input type="text" name="menu_segundo_nombre" value="{{$menu->menu_segundo_nombre}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Postre</label>
                    <input type="text" name="menu_postre_nombre" value="{{$menu->menu_postre_nombre}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Merienda</label>
                    <input type="text" name="menu_merienda_nombre" value="{{$menu->menu_merienda_nombre}}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
            </form>
        </div>
     </section>
@endsection