
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Página de Ingreso | ArdiniTrading</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="cPanel desarrollado por InnovaTec.me">
    <meta name="keywords" content="InnovaTec, repuestos, autopartes, autos">
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
  <link href="{{asset('css/materialize5.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('css/estilos5.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="{{asset('css/custom/custom-style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="gray darken-4" onLoad="redireccionar()">  

   <div id="card-alert" class="card green">
                    <div class="card-content white-text">                    
                      <span class="card-title white-text darken-1">
                        <i class="material-icons">notifications</i> FELICIDADES!!</span>
                      <p>Gracias por darte de alta en ArdiniTrading, hemos enviado un mensaje  </p>
                      <p>a tu correo electr&oacute;nico, puedes ingresar a la Web en el boton de abajo.</p>
                    </div>
                    <div class="card-action green darken-2">
                      <a class="btn-flat waves-effect blue white-text" href="'{{url('/')}}'">
                        <i class="material-icons left">check</i> INICIAR SESION</a>       
                    </div>
                    <div class="card-content white-text">                    
                      
                        <p>En breve seras redireccionado a la pagina de inicio.......</p>
                    </div>
                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
  



  <!-- ================================================
    Scripts
    ================================================ -->
<script language="JavaScript">
  function redireccionar() {
    setTimeout("location.href='{{url('/')}}'", 5000);
  }
  </script>
  <!-- jQuery Library -->
  <script type="text/javascript" src="{{ asset('js/plugins/jquery-1.11.2.min.js') }}"></script>
  <!--materialize js-->
  <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
  <!--prism-->
  <script type="text/javascript" src="{{ asset('js/plugins/prism/prism.js') }}"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="{{ asset('js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{ asset('js/plugins.min.js') }}"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="{{ asset('js/custom-script.js') }}"></script>

</body>

</html>