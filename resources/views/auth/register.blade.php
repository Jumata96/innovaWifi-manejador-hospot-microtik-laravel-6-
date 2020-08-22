
<!DOCTYPE html>
<html lang="es">

<!--================================================================================
  Item Name: Materialize - Material Design Admin Template
  Version: 3.0
  Author: GeeksLabs
  Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>InnovaWifi | Página de Registro</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="InnovaMk es un sistema de gestión basado en la API de mikrotik.">
    <meta name="keywords" content="mikrotik, sistema mikrotik, mikrotik sistema, ubiquiti, mikrtoik ubiquiti,">
    <!-- Favicons-->
    <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="{{asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('css/estilos.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="{{asset('css/custom/custom-style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="gray darken-4">


  @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col s12 z-depth-4 card" style="width: 25rem">
      <div class="card-header center white-text"; style="border-bottom: 2px solid #005687; background-color: #33AFE8; height: 60px; padding-top: 8px">
          <img src="{{asset('images/logo/InnovaWifi3.png')}}" alt="InnovaWifi" style=" height: 43px">
        </div>
      <form method="POST" action="{{ route('register') }}" style="padding: 10px">
        <div class="row">
          <div class="input-field col s12 center">              
            <p class="center login-form-text" style="color: #9e9e9e; font-size: 14px;margin-top: 0px">REGISTRO DE USUARIO</p>
            <div class="divider"></div>
      <!--      <h6><i>Por su seguridad no revele su usuario y contraseña a terceros</i></h6>   -->
          </div>
        </div>
        
        @csrf
        <div class="row">
         
          <div class="input-field col s12">
            <i class="material-icons prefix">face</i>
            <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
            @if ($errors->has('name'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
            <label for="nombre" class="center-align">Nombre</label>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix">person_outline</i>
            <input id="usuario" type="text" class="form-control{{ $errors->has('usuario') ? ' is-invalid' : '' }}" name="usuario" value="{{ old('usuario') }}" required>
            @if ($errors->has('usuario'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('usuario') }}</strong>
              </span>
            @endif
            <label for="usuario" class="center-align">Usuario</label>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
            <label for="email" class="center-align">Email</label>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            @if ($errors->has('password'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
            <label for="password">Contraseña</label>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="password-again" type="password" name="password_confirmation" required>

            <label for="password-again">Repetir contraseña</label>
          </div>
          <div class="input-field col s12">
            <button type="submit" class="btn waves-effect waves-light  col s12" style="height: 44px;background: #1B86B8 !important;letter-spacing: .5px;">
              Registrar</button>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Ya tienes una cuenta? <a href="{{ url('/login') }}">Ingresar</a></p>
          </div>
        </div>
      </form>
    </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!--prism-->
  <script type="text/javascript" src="js/plugins/prism/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>

</body>

</html>