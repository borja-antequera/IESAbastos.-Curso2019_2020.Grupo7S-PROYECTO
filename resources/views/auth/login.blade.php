<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AgendaInfantil | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  
  <link rel="stylesheet" href="{{ asset('css/login-boostrap.css')}}">  
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.css')}}">
  <link rel="stylesheet" href="{{ asset('css/login-adminlte.css')}}">    
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

    <body class="hold-transition login-page">
        <div class="login-box">
          <div class="login-logo">
            <a href="../../index2.html"><b>Agenda </b>Infantil</a>
          </div>
          <!-- /.login-logo -->
          <div class="login-box-body">
            <p class="login-box-msg">Inicia sesión para comenzar tu sesión</p>

             <form method="POST" action="{{ route('login') }}">
                @csrf

              <div class="form-group has-feedback">
                <input id="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" autofocus required autocomplete="email">
                <span class="fa fa-envelope form-control-feedback"></span>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
              </div>
              <div class="form-group has-feedback">
                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                <span class="fa fa-lock form-control-feedback"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="row">
                <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Recordar
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat"> {{ __('Login') }}</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
            <!--
            <div class="social-auth-links text-center">
              <p>- OR -</p>
              <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="ion ion-social-facebook"></i> Iniciar sesión usando Facebook</a>
              <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="ion ion-social-google"></i> Iniciar sesión usando Google+</a>
            </div>-->
            <!-- /.social-auth-links -->
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('¿Has olvidado tu contraseña?') }}
                </a><br>
            @endif<br>
            <a href="/register" class="btn btn-block btn-social btn-success btn-flat">
              <i class="ion ion-edit"></i>Registrarse como nuevo miembro
            </a>
            
          </div>
          <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

        <script src="{{ asset('js/login-jquery.js') }}"></script>
        <script src="{{ asset('js/login-boostrap.js') }}"></script>
        <script src="{{ asset('js/icheck.min.js') }}"></script>

        <script type="text/javascript">
          $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' /* optional */
            });
          });
        </script>
    </body>
</html>