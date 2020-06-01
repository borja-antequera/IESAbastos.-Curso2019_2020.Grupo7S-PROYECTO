
@extends('layouts.index')

@section('title', 'Crear Centros')

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
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                @include('common.success')
              </div>
            </div>
            <form class="form-group" method="POST" action="/centros" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Directores</label>
                    <select required="" name="director_id" class="form-control">
                      @foreach($directores as $director)
                        <option value="{{$director->id}}">{{$director->name}} {{$director->username1}} {{$director->username2}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input required="" type="text" name="centro_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Dirección</label>
                    <input required="" type="text" name="centro_direccion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea required="" class="form-control" name="centro_descripcion" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Imagen</label><br>
                    <input required="" type="file" name="centro_imagen">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
     </section>
@endsection
