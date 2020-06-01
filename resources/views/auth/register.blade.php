<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AgendaInfantil | Registro</title>
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
            <p class="login-box-msg">Registro de padres</p>

             <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group has-feedback">
                    <input id="name" placeholder="{{ __('Name') }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <span class="fa fa-user form-control-feedback"></span>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input id="username1" placeholder="Primer Apellido" type="text" class="form-control @error('username1') is-invalid @enderror" name="username1" value="{{ old('username1') }}" required autocomplete="name" autofocus>
                    <span class="fa fa-list form-control-feedback"></span>
                    @error('username1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input id="username2" placeholder="Segundo Apellido" type="text" class="form-control @error('username2') is-invalid @enderror" name="username2" value="{{ old('username2') }}" required autocomplete="name" autofocus>
                    <span class="fa fa-cogs form-control-feedback"></span>
                    @error('username2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <span class="fa fa-envelope form-control-feedback"></span>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input id="birth_date" placeholder="Fecha de Nacimiento" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date ') }}" required autocomplete="name" autofocus>
                    <span class="fa fa-calendar form-control-feedback"></span>
                    @error('birth_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <span class="fa fa-key form-control-feedback"></span>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                     <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                     <span class="fa fa-key form-control-feedback"></span>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                           <i class="fa fa-paper-plane"></i> Registrarse
                        </button>
                    </div>
                </div>
            </form>
            
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