@extends('layouts.index')

@section('title', 'Usuario')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Perfil del Usuario</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/usuarios">Usuarios</a></li>
                    <li class="breadcrumb-item active">{{$user->name}} {{$user->username1}} {{$user->username2}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-3">

                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <center>
                            <img class="profile-user-img img-responsive img-circle" src="/images/{{$user->user_image}}" alt="User profile picture">
                        </center>
                        <h3 class="profile-username text-center">{{$user->name}} {{$user->username1}} {{$user->username2}}</h3>

                        <p class="text-muted text-center">{{agendaInfantil\Role::find($user->rol_id)->rol_nombre}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Fecha de nacimiento: </b> {{date("d-m-Y", strtotime($user->birth_date))}}
                            </li>
                            <li class="list-group-item">
                                <b>Email: </b> {{$user->email}}
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>

                @if($user->rol_id == 1)
                    <div class="box box-danger">
                        <div class="box-body box-profile">
                            <center>
                                <img class="profile-user-img img-responsive img-circle" src="/images/{{$centro->centro_imagen}}" alt="User profile picture">
                            </center>
                            <h3 class="profile-username text-center">{{$centro->centro_nombre}}</h3>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Dirección: </b> {{$centro->centro_direccion}}
                                </li>
                                <li class="list-group-item text-justify">
                                    <b>Descripción: </b> {{ substr($centro->centro_descripcion, 0, 200) }} .... 
                                    <a href="/centros/{{$centro->slug}}">Ver más</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif

            </div>

            <div class="col-md-9">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @if($user->rol_id == 1)
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">
                                <i class="fas fa-home"></i> Aulas
                            </a>
                        </li>
                    @endif
                    @if($user->rol_id == 2)
                        @php
                            $count = 1;
                        @endphp
                        @foreach($centros as $centro)
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link {{($count == 1) ? 'active' : '' }}" id="home-tab{{$centro->id}}" data-toggle="tab" href="#home{{$centro->id}}" role="tab" aria-controls="home{{$centro->id}}" aria-selected="false">
                                    <i class="fas fa-home"></i> {{$centro->centro_nombre}}
                                </a>
                            </li>
                            @php
                                $count++;
                            @endphp                           
                        @endforeach
                    @endif
                    @if($user->rol_id == 3)
                        @php
                            $count = 1;
                        @endphp
                        @foreach($centros as $centro)
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link {{($count == 1) ? 'active' : '' }}" id="home-tab{{$centro->id}}" data-toggle="tab" href="#home{{$centro->id}}" role="tab" aria-controls="home{{$centro->id}}" aria-selected="false">
                                    <i class="fas fa-home"></i> {{$centro->centro_nombre}}
                                </a>
                            </li>
                            @php
                                $count++;
                            @endphp                           
                        @endforeach
                    @endif
                </ul>
                <div class="tab-content" id="myTabContent">
                    
                    @if($user->rol_id == 1)
                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                     
                        <div class="row mt-2">
                            @foreach($aulas as $aula)
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
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    @if($user->rol_id == 2)
                        @php
                            $count1 = 1;
                        @endphp
                        @foreach($centros as $centro)
                            <div class="tab-pane {{($count1 == 1) ? ' active show' : '' }} fade" id="home{{$centro->id}}" role="tabpanel" aria-labelledby="home-tab{{$centro->id}}">                           
                                
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <div class="box box-warning">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="fa fa-map-marker"></i> Dirección: 
                                                    <b>{{$centro->centro_direccion}}</b>
                                                </h3>
                                            </div>
                                            <div class="box-body no-padding">
                                                <p class="text-justify">
                                                    {{$centro->centro_descripcion}} ... 
                                                    <a href="/centros/{{$centro->slug}}">Ver más</a>
                                                </p>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                
                                @php
                                    $aulas = agendaInfantil\Centro::AulasCentro($centro->id);
                                @endphp
                                @foreach($aulas as $aula)
                                    <div class="col-lg-12 col-md-12 mt-2">
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
                                @endforeach
                            </div> 
                            @php
                                $count1++;
                            @endphp
                        @endforeach
                    @endif

                     @if($user->rol_id == 3)
                        @php
                            $count2 = 1;
                        @endphp
                        @foreach($centros as $centro)
                            <div class="tab-pane {{($count2 == 1) ? ' active show' : '' }} fade" id="home{{$centro->id}}" role="tabpanel" aria-labelledby="home-tab{{$centro->id}}">                           
                                
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <div class="box box-warning">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">
                                                    <i class="fa fa-map-marker"></i> Dirección: 
                                                    <b>{{$centro->centro_direccion}}</b>
                                                </h3>
                                            </div>
                                            <div class="box-body no-padding">
                                                <p class="text-justify">
                                                    {{$centro->centro_descripcion}} ... 
                                                    <a href="/centros/{{$centro->slug}}">Ver más</a>
                                                </p>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                
                                @php
                                    $aulas_ninos = agendaInfantil\Nino::listado_ninos_tutores_aulas_centro($user->id, $centro->id);
                                @endphp
                                @foreach($aulas_ninos as $aula)
                                    <div class="col-lg-12 col-md-12 mt-2">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Aula: <b>{{$aula->aula_nombre}}</b></h3>
                                            </div>
                                            <div class="box-body no-padding">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="box box-primary">
                                                                    @php
                                                                    $profesores = agendaInfantil\Aula::ProfesoresDetalleAula($aula->idAula);
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
                                                     <div class="col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="box box-danger">                                                                 
                                                                    <div class="box-header with-border">
                                                                        <div class="row">
                                                                            <div class="col-lg-10">
                                                                                <h3 class="box-title">
                                                                                    Listado de hijos
                                                                                </h3>
                                                                            </div>
                                                                            <div class="col-lg-2 pull-right">
                                                                                <span class="pull-right badge bg-blue"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="box-body no-padding">
                                                                        <ul class="nav nav-stacked">
                                                                           <li><a href="#"><i class="fa fa-user"></i> {{$aula->nino_nombre}} {{$aula->nino_apellido1}} {{$aula->nino_apellido2}}</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div> 
                            @php
                                $count2++;
                            @endphp
                        @endforeach
                    @endif
                </div>

</section>

@endsection
