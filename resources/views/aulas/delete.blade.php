@extends('layouts.index')

@section('title', 'Eliminar Aula')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Aulas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Aulas</a></li>
                    <li class="breadcrumb-item active">Eliminar {{$aula->aula_nombre}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        @include('common.success')
        <div class="row">
              <div class="col-lg-12 col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Aula: <b>{{$aula->aula_nombre}}</b></h3>
                        </div>
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                           <div class="box box-primary">                                                
                                                @php
                                                    $profesores = agendaInfantil\Aula::ProfesoresDetalleAula($aula->id);
                                                @endphp
                                                <div class="box-header with-border">
                                                    <div class="row">
                                                        <div class="col-lg-10">
                                                            <h3 class="box-title">
                                                                Listado de profesores                                                                
                                                            </h3>
                                                        </div>
                                                        <div class="col-lg-2 pull-right">
                                                            <span class="pull-right badge bg-blue">{{count($profesores)}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-body no-padding">
                                                    <ul class="nav nav-stacked">    

                                                        @if(count($profesores) > 0 ) 
                                                            @foreach($profesores as $profesor)
                                                                <li><a href="#"><i class="fa fa-user"></i> {{$profesor->name}} {{$profesor->username1}} {{$profesor->username2}}</a></li>                                                                
                                                            @endforeach  
                                                        @endif
                                                    </ul>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <div class="row">
                                        <div class="col-lg-12">
                                           <div class="box box-danger">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Listado de alumnos / tutores</h3>
                                                </div>
                                                <div class="box-body no-padding">
                                                    @php
                                                        $alumnos = agendaInfantil\Aula::AlumnosAula($aula->id);
                                                    @endphp
                                                    <ul class="listado-alumnos">  
                                                    @if(count($alumnos) > 0 ) 
                                                        @foreach($alumnos as $alumno)
                                                            @php
                                                                $padre = agendaInfantil\User::find($alumno->usuario_id);
                                                                $nombre_padre = $padre->name.' '.$padre->username1.' '.$padre->username2;
                                                            @endphp
                                                            <li>
                                                                <a href="#">
                                                                {{$alumno->nino_nombre}} {{$alumno->nino_apellido1}} {{$alumno->nino_apellido2}} <span class="text-naranja">(Padre: {{$nombre_padre}})</span>
                                                                </a>
                                                            </li>                                                                
                                                        @endforeach  
                                                    @endif
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-warning">
                    <i class="fa fa-info-circle"></i> Si elimina este Aula, se eliminarán en cascada la asociación de profesores, los alumnos con sus registros diarios y sus respectivos tutores.
                </div>
            </div>
        </div>
        <div class="row mb-3 mt-2 text-center">
            <div class="col-lg-12">
            <form action="/eliminar/aulas/{{ $aula->id }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Eliminar
                </button>
            </form>

            </div>
        </div>
    </div>
</section>
@endsection

@section('js-no-comunes')

<script>
    $(function() {

        $('#lista_centros').DataTable({
            "paging": true
            , "language": {
                "url": "{{ asset('lang/spanish.json')}}"
            }
            , "lengthChange": true
            , "searching": true
            , "ordering": true
            , "info": true
            , "autoWidth": false
            , "responsive": true
        , });

    });

</script>

@endsection
