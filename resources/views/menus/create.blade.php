@extends('layouts.index')

@section('title', 'Crear Menús')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Menú</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Menús</a></li>
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
            @include('common.errors')
            <form class="form-group" method="POST" action="/menus" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Nombre del Menú</label>
                    <input type="text" name="menu_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Desayuno</label>
                    <input type="text" name="menu_desayuno_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Primer Plato</label>
                    <input type="text" name="menu_primero_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Segundo Plato</label>
                    <input type="text" name="menu_segundo_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Postre</label>
                    <input type="text" name="menu_postre_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Merienda</label>
                    <input type="text" name="menu_merienda_nombre" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
            </form>
        </div>
     </section>
@endsection