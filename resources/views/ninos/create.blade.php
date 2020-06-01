@extends('layouts.index')

@section('title', 'Crear Usuarios')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Alumno</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Alumnos</a></li>
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
            @include('common.errors')
            <form class="form-group" method="POST" action="/ninos" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Padre</label>
                    <select class="form-control" name="usuario_id">
                      @foreach($users as $padre)
                        <option value="{{$padre->id}}">{{$padre->name}} {{$padre->username1}} {{$padre->username2}} </option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Aula</label>
                    <select class="form-control" name="aula_id">
                      @foreach($aulas as $aula)
                        <option value="{{$aula->id}}">{{$aula->aula_nombre}} </option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nino_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Primer Apellido</label>
                    <input type="text" name="nino_apellido1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Segundo Apellido</label>
                    <input type="text" name="nino_apellido2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Fecha de Nacimiento</label>
                    <input type="date" name="nino_fecha_nacimiento" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Imagen</label>
                    <input type="file" name="nino_imagen" class="">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
            </form>
        </div>
     </section>
@endsection