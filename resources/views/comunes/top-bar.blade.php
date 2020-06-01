 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>    
    @php
      $usuario_login = auth()->user()->id;
      $contador_mensajes_no_leidos = agendaInfantil\Mensaje::mensajesNoLeidosPorUsuarioLoguedo($usuario_login,3);
      $ultimos_mensajes_no_leidos = agendaInfantil\Mensaje::ultimosMensajesNoLeidosPorUsuario($usuario_login,3);
    @endphp
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{$contador_mensajes_no_leidos}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          @foreach($ultimos_mensajes_no_leidos as $mensaje)
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="/images/{{$mensaje->user_image}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    {{$mensaje->name}} {{$mensaje->username1}} {{$mensaje->username2}}
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">{{ substr($mensaje->mensaje,0,20).'...' }}</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ date("d/m/Y H:i", strtotime($mensaje->created_at))}}</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>            
          @endforeach
          
          <a href="/mensajes/usuario/{{auth()->user()->id}}" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
       @if( Auth::user()->rol_id > 1 &&  Auth::user()->rol_id < 4)
      <li class="nav-item dropdown">
       @php
        $contador_mensajes_difusion_no_leidos = agendaInfantil\Mensaje::mensajesNoLeidosPorUsuarioLoguedo($usuario_login,1);
        $ultimos_mensajes_difusion_no_leidos = agendaInfantil\Mensaje::ultimosMensajesNoLeidosPorUsuario($usuario_login,1);
      @endphp
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$contador_mensajes_difusion_no_leidos}}</span>
        </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          @foreach($ultimos_mensajes_difusion_no_leidos as $mensaje1)
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="/images/{{$mensaje1->user_image}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    {{$mensaje1->name}} {{$mensaje1->username1}} {{$mensaje1->username2}}
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">{{ substr($mensaje1->mensaje,0,20).'...' }}</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ date("d/m/Y H:i", strtotime($mensaje1->created_at))}}</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>            
          @endforeach
          
          <a href="/mensajes/usuario/{{auth()->user()->id}}" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link text-danger text-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
          <i class="fas fa-sign-out-alt"></i> Salir
        </a>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->