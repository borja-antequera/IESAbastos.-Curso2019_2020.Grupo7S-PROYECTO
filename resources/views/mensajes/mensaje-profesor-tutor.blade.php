@extends('layouts.index')

@section('title', 'Mensaje a Tutor')

@section('content')
      <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="single-chat-tab">
            <div class="chat-header">
              <div class="media">
                <div class="user-dp position-relative">
                  <img class="" src="/images/{{$tutor->user_image}}" alt="img">
                  <span class="user-online"></span>
                </div>
                <div class="media-body">
                  <h5 class="mt-0">{{ $tutor->name }} {{ $tutor->username1 }} {{ $tutor->username2 }}</h5>
                </div>
              </div>
            </div>
            <div class="chat-body">  
                    
                @foreach($mensajes_profesor_tutor as $mensaje_profesor_tutor)
                    
                    @if($mensaje_profesor_tutor->emisor_id == $emisor_id)
                        <div class="message-content sender">
                            <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje_profesor_tutor->created_at)) ?></label>
                            <div class="msg-block">
                            <p>
                                {{ $mensaje_profesor_tutor->mensaje }}
                            </p>
                            </div>
                        </div>
                    @else
                        <div class="message-content receiver">
                            <label for=""><?php echo date("d/m/Y H:i", strtotime($mensaje_profesor_tutor->created_at)) ?></label>
                            <div class="msg-block">
                            <p>
                                {{ $mensaje_profesor_tutor->mensaje }}
                            </p>
                            </div>
                        </div>

                    @endif
                @endforeach

            </div>
            <form method="POST" action="/mensajes">
                @csrf
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