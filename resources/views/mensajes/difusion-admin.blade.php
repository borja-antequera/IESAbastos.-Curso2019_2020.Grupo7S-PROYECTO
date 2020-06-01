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
                  <i class="fa fa-school fa-3x"></i>
                </div>
                <div class="media-body">
                  <h5 class="mt-0">{{ auth()->user()->name }} {{ auth()->user()->username1 }} {{ auth()->user()->username2 }}</h5>
                </div>
              </div>
            </div>
            <div class="chat-body">
              <!-- Pintamos los mensajes donde el emisor es el usuario logueado con la clase receiver -->
              @foreach($mensajes as $mensaje)
                <div class="message-content sender">
                    <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje->created_at)) ?></label>
                    <div style="background-color:{{ agendaInfantil\TipoMensaje::find($mensaje->tipo_mensaje_id)->color}};" class="msg-block">
                    <p>
                        <i class="fa fas {{ agendaInfantil\TipoMensaje::find($mensaje->tipo_mensaje_id)->icono}}"></i> {{ $mensaje->mensaje }}
                    </p>
                    </div>
                </div>
              @endforeach
            </div>
            <div class="chat-footer">
                <form method="POST" action="/mensajes">
                    @csrf
                    <!-- Pasamos por formulario el slug del centro y el tipo de mensaje (1 = difusion centro)-->
                    <input type="hidden" value="{{$centro_slug}}" name="centro_slug" />
                    <input type="hidden" value="1" name="tipo_mensaje_id" />

                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 red-border" name="mensaje" type="text" placeholder="Escribe un mensaje..." required>
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