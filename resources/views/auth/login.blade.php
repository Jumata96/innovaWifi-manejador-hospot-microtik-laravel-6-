
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Página de Ingreso | InnovaWifi</title>
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


    <div class="card-panel" id="pagina-login" style="width: 26rem; padding: 0">
      <div class="card-header center white-text"; style="border-bottom: 2px solid #005687; background-color: #33AFE8; height: 60px; padding-top: 8px">
        <img src="{{asset('images/logo/InnovaWifi3.png')}}" alt="InnovaWifi" style=" height: 43px">
      </div>
      <form action="{{ url('/login') }}" method="post" style="padding: 10px">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
          <div class="input-field col s12 center">              
            <p class="center login-form-text" style="color: #9e9e9e; font-size: 14px;margin-top: 0px">Bienvenido a nuestro portal</p>
            <div class="divider"></div>
      <!--      <h6><i>Por su seguridad no revele su usuario y contraseña a terceros</i></h6>   -->
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix">person_outline</i>
            <input type="text" class="form-control" name="usuario" id="usuario">
            <label for="usuario" class="center-align">Usuario</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="material-icons prefix">lock_outline</i>
            <input id="password" type="password" class="form-control" name="password">
            <label for="password">Contraseña</label>
          </div>
        </div>
        <div class="row">          
          <div class="input-field col s12 m12 l12  login-text">
              <input type="checkbox" id="remember-me" />
              <label for="remember-me" name="remember">Recordarme</label>
          </div>
          <div class="form-ref-box">
                                            
                                        </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn waves-effect waves-light  col s12" style="height: 44px;    background: #1B86B8 !important;letter-spacing: .5px;">Iniciar sessión
              <i class="mdi-content-send right"></i>
            </button>            
          </div>

        </div>
        <div class="row">
          <div class="input-field col s5 m5 l5">
            <p class="margin medium-small"><a href="{{ url('/registrar') }}">Registrate Ahora!</a></p>
          </div>
          <div class="input-field col s7 m7 l7">
              <p class="margin right-align medium-small"><a href="#">Olvidaste tu contraseña?</a></p>
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