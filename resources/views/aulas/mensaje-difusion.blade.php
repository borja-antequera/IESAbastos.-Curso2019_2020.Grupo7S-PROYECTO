@extends('layouts.index')

@section('title', 'Mensaje Difusión')

@section('content')
      <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="single-chat-tab">
            <div class="chat-header">
              <div class="media">
                <div class="user-dp position-relative">
                  <i class="fa fa-users fa-3x"></i>
                </div>
                <div class="media-body">
                  <h5 class="mt-0">{{$aula_nombre}}</h5>
                </div>
              </div>
            </div>
            <div class="chat-body">
              @foreach($mensajes as $mensaje)
                @if($mensaje->emisor_id == $emisor_id)
                    <div class="message-content sender">
                        <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje->created_at)) ?></label>
                        <div style="background-color:{{ agendaInfantil\TipoMensaje::find($mensaje->tipo_mensaje_id)->color}};" class="msg-block">
                        <p>
                          <i class="fa fas {{ agendaInfantil\TipoMensaje::find($mensaje->tipo_mensaje_id)->icono}}"></i> {{ $mensaje->mensaje }}
                        </p>
                        </div>
                    </div>
                @else
                    <!-- Si el emisor del mensaje NO es el usuario logueado, aplicamos la clase receiver (gris y a la izquierda)-->
                    <!-- Pero si es de tipo 1 o 2 sobreescribimos los estilos -->
                    <div class="message-content receiver">
                            <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje->created_at)) ?></label>
                            <div style="background-color:{{ agendaInfantil\TipoMensaje::find($mensaje->tipo_mensaje_id)->color}};" class="msg-block">
                            <p>
                                <i class="fa fas {{ agendaInfantil\TipoMensaje::find($mensaje->tipo_mensaje_id)->icono}}"></i> {{ $mensaje->mensaje }}
                            </p>
                            </div>
                      </div>
                @endif
              @endforeach
            </div>
            <div class="chat-footer">
                <form method="POST" action="/mensajes">
                    <!-- Pasamos por formulario el slug del aula y el tipo de mensaje (2 = difusion aula)-->
                    @csrf
                    <input type="hidden" value="{{$aula_slug}}" name="aula_slug" />
                    <input type="hidden" value="2" name="tipo_mensaje_id" />

                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 red-border" name="mensaje" type="text" placeholder="Escribe un mensaje...">
                        <div class="input-group-append">
                        <button class="btn input-group-text red lighten-3" id="basic-text1">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
    </div>
  </div>
    
@endsection