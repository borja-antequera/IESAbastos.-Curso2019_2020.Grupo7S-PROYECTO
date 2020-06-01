@extends('layouts.index')

@section('title', 'Mensaje a Director')

@section('content')
      <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="single-chat-tab">
            <div class="chat-header">
              <div class="media">
                <div class="user-dp position-relative">
                  <img class="" src="/images/{{$director->user_image}}" alt="img">
                  <span class="user-online"></span>
                </div>
                <div class="media-body">
                  <h5 class="mt-0">{{ $director->name }} {{ $director->username1 }} {{ $director->username2 }}</h5>
                </div>
              </div>
            </div>
            <div class="chat-body">
                <!-- Iteramos sobre los mensajes enviados a la vista -->
                @foreach($mensajes_difusion_director_profesor as $mensaje_difusion_director_profesor)
                    <!-- Si el emisor del mensaje es el usuario logueado, aplicamos la clase sender (rosa y a la derecha)-->
                    @if($mensaje_difusion_director_profesor->emisor_id == $emisor_id)
                      
                        <div class="message-content receiver">
                            <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje_difusion_director_profesor->created_at)) ?></label>
                            <div style="background-color:{{ agendaInfantil\TipoMensaje::find($mensaje_difusion_director_profesor->tipo_mensaje_id)->color}};" class="msg-block">
                            <p>
                                <i class="fa fas {{ agendaInfantil\TipoMensaje::find($mensaje_difusion_director_profesor->tipo_mensaje_id)->icono}}"></i> {{ $mensaje_difusion_director_profesor->mensaje }}
                            </p>
                            </div>
                        </div>
                    @else  
                        <div class="message-content sender">
                            <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje_difusion_director_profesor->created_at)) ?></label>
                            <div class="msg-block">
                            <p>
                                {{ $mensaje_difusion_director_profesor->mensaje }}
                            </p>
                            </div>
                        </div>

                    @endif
                @endforeach

            </div>            
          </div>
    </div>
  </div>
    
@endsection