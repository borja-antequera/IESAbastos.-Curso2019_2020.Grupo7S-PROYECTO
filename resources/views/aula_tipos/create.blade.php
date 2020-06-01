@extends('layouts.index')

@section('title', 'Crear Aulas')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Centros</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
            @include('common.errors')
            <form class="form-group" method="POST" action="/aulas" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="aula_tipo_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Capacidad</label>
                    <input type="number" name="aula_tipo_capacidad" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
            </form>
        </div>
     </section>
@endsection