@extends('layouts.index')

@section('title', 'Editar Usuarios')

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
              <li class="breadcrumb-item active">Editar</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
            @include('common.errors')
            <form class="form-group" method="POST" action="/usuarios/{{$user->id}}" enctype="multipart/form-data">
              @method('PUT')        
              @csrf
                <input type="hidden" value="{{$user->id}}" name="user_id" />     

                 <img style="height:200px; width: 200px; background-color: #EFEFEF; margin: 20px;"
                    src="/images/{{$user->user_image}}" class="img-thumbnail card-img-top rounded-circle mx-auto d-block" alt="...">
                            
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input required="" value="{{$user->name}}" type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Primer Apellido</label>
                    <input required="" value="{{$user->username1}}" type="text" name="username1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Segundo Apellido</label>
                    <input required="" value="{{$user->username2}}" type="text" name="username2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Fecha de Nacimiento</label>
                    <input required="" value="{{$user->birth_date}}" type="date" name="birth_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input required="" value="{{$user->email}}" type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Imagen</label>
                    <input type="file" name="user_image" class="">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
            </form>
        </div>
     </section>
@endsection