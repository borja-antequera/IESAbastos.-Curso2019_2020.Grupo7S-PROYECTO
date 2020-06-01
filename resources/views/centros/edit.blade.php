@extends('layouts.index')

@section('title', 'Editar Centros')

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
              <li class="breadcrumb-item active">Editar {{$centro->centro_nombre}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <form class="form-group" method="POST" action="/centros/{{$centro->slug}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <img style="height:200px; width: 200px; background-color: #EFEFEF; margin: 20px;"
            src="/images/{{$centro->centro_imagen}}" class="card-img-top rounded-circle mx-auto d-block" alt="...">
            
            <div class="form-group">
                <label for="">Directores</label>
                <select name="director_id" class="form-control">
                    @foreach($directores as $director)
                        <option {{($director->id == $centro->director_id) ? 'selected' : ''}} value="{{$director->id}}">{{$director->name}} {{$director->username1}} {{$director->username2}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="centro_nombre" value="{{$centro->centro_nombre}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Dirección</label>
                <input type="text" name="centro_direccion" value="{{$centro->centro_direccion}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea class="form-control" name="centro_descripcion" rows="5">{{$centro->centro_descripcion}}</textarea>
            </div>
            <div class="form-group">
                <label for="">Slug</label><br>
                <input type="text" name="slug" value="{{$centro->slug}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Imagen</label><br>
                <input type="file" name="centro_imagen">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
      </div>
    </section>    
@endsection