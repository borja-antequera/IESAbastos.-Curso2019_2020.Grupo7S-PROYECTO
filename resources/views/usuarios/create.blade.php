@extends('layouts.index')

@section('title', 'Crear Usuarios')

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
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
            @include('common.errors')
            <form class="form-group" method="POST" action="/usuarios" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Rol</label>
                    <select required="" class="form-control" name="rol_id">
                        @foreach($roles as $rol)
                          @if($rol->id != 4){
                            <option value="{{$rol->id}}">{{$rol->rol_nombre}}</option>
                          @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input required="" type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Primer Apellido</label>
                    <input required="" type="text" name="username1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Segundo Apellido</label>
                    <input required="" type="text" name="username2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Fecha de Nacimiento</label>
                    <input required="" type="date" name="birth_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input required="" type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input required="" type="text" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Imagen</label>
                    <input required="" type="file" name="user_image" class="">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
            </form>
        </div>
     </section>
@endsection