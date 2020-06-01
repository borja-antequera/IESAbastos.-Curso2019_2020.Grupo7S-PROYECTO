@extends('layouts.index')

@section('title', 'Mensaje a Profesor')

@section('content')
      <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="single-chat-tab">
            <div class="chat-header">
              <div class="media">
                <div class="user-dp position-relative">
                  <img class="" src="/images/{{$profesor->user_image}}" alt="img">
                  <span class="user-online"></span>
                </div>
                <div class="media-body">
                  <h5 class="mt-0">{{ $profesor->name }} {{ $profesor->username1 }} {{ $profesor->username2 }}</h5>
                </div>
              </div>
            </div>
            <div class="chat-body">
                <!-- Iteramos sobre los mensajes enviados a la vista -->
                @foreach($mensajes_tutor_profesor as $mensaje_tutor_profesor)
                    <!-- Si el emisor del mensaje es el usuario logueado, aplicamos la clase sender (rosa y a la derecha)-->
                    @if($mensaje_tutor_profesor->emisor_id == $emisor_id)
                        <div class="message-content sender">
                            <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje_tutor_profesor->created_at)) ?></label>
                            <div class="msg-block">
                            <p>
                                {{ $mensaje_tutor_profesor->mensaje }}
                            </p>
                            </div>
                        </div>
                    @else
                        <!-- Si el emisor del mensaje NO es el usuario logueado, aplicamos la clase receiver (gris y a la izquierda)-->
                        <!-- Pero si es de tipo 1 o 2 sobreescribimos los estilos -->
                        <div class="message-content receiver">
                            <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje_tutor_profesor->created_at)) ?></label>
                            <div style="background-color:{{ agendaInfantil\TipoMensaje::find($mensaje_tutor_profesor->tipo_mensaje_id)->color}};" class="msg-block">
                            <p>
                                <i class="fa fas {{ agendaInfantil\TipoMensaje::find($mensaje_tutor_profesor->tipo_mensaje_id)->icono}}"></i> {{ $mensaje_tutor_profesor->mensaje }}
                            </p>
                            </div>
                        </div>

                    @endif
                @endforeach

            </div>
            <form method="POST" action="/mensajes">
                @csrf
                <!-- Pasamos ocultos los datos del receptor y el tipo de mensaje -->
                <input type="hidden" value="{{$receptor_id}}" name="receptor_id" />
                <input type="hidden" value="3" name="tipo_mensaje_id" />

                <div class="chat-footer">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <input class="form-control my-0 py-1 red-border" name="mensaje" type="text" placeholder="Escribe un mensaje..." required>
                    <div class="input-group-append">
                    <button class="btn input-group-text red lighten-3" id="basic-text1">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    </div>
                </div>
                </div>

            </form>

          </div>
    </div>
  </div>
    
@endsection