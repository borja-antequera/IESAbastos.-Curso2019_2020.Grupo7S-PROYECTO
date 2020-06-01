@extends('layouts.index')

@section('title', 'Crear Aulas')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Aulas</h1>
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
                    <label for="">Centro al que pertenece</label>
                    <select class="form-control" name="aula_centro_id">
                        @foreach($centros as $centro)
                          <option value="{{$centro->id}}">{{$centro->centro_nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tipo de Aula</label>
                    <select class="form-control" name="aula_tipo_id">
                    @foreach($aulas_tipos as $aulas_tipo)
                      <option value="{{$aulas_tipo->id}}">{{$aulas_tipo->aula_tipo_nombre}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre del Aula</label>
                    <input type="text" name="aula_nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Descripción del Aula</label>
                    <textarea class="form-control" name="aula_descripcion" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Slug</label>
                    <input type="text" name="aula_slug" class="form-control">
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <hr>   
                  </div>
                </div>
                
                <div class="form-group">
                    <label for="">Asignar profesores</label>
                    <select multiple="" class="form-control" name="user_id[]">
                        @foreach($profesores as $profesor)
                          <option value="{{$profesor->id}}">{{$profesor->name}} {{$profesor->username1}} {{$profesor->username2}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Limpiar</button>
            </form>
        </div>
     </section>
@endsection