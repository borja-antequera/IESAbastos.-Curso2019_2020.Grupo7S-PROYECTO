@extends('layouts.index')

@section('title', 'Ninos')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Niños</a></li>
              <li class="breadcrumb-item active">Listado de Niños</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">            
            <div class="row">
               @foreach($ninos as $nino)
                  <div class="col-lg-3 col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="/images/{{ $nino->nino_imagen }}" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title text-bold">{{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}}</h5>
                          <p class="card-text mt-2 mb-2">
                            Hola, soy {{$nino->nino_nombre}} {{$nino->nino_apellido1}} {{$nino->nino_apellido2}} y nací el {{ date('d-m-Y', strtotime($nino->nino_fecha_nacimiento)) }}
                          </p>
                          <div class="row text-center text-center">
                            
                            <div class="col-lg-6">
                              <a class="btn btn-success btn-block" href="/calendario/nino/{{$nino->id}}">
                                <i class="fa fa-calendar text-white"></i>
                              </a>
                            </div>

                            <div class="col-lg-6">
                              <a class="btn btn-primary btn-block" href="/mensajes/tutor/profesores/nino/{{$nino->id}}">
                                <i class="fa fa-envelope text-white"></i>
                              </a>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                   <br>
                 @endforeach            
            </div>

        </div>
    </section>

@endsection

