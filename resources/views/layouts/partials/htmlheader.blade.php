<head>
  <meta charset="UTF-8">
  <title> InnovaMk - @yield('htmlheader_title', 'Inicio') </title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="InnovaMk es un sistema de gestión basado en la API de mikrotik.">
  <meta name="keywords" content="mikrotik, sistema mikrotik, mikrotik sistema, ubiquiti, mikrtoik ubiquiti,">

  <!-- Favicons-->
  <link rel="icon" href="{{asset('images/favicon/favicon-32x32.png')}}" sizes="32x32">
  <!-- Favicons-->
  <link rel="{{asset('apple-touch-icon-precomposed')}}" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  
  <!-- For Windows Phone -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <!-- CORE CSS-->
  <link href="{{asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('css/estilos.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="{{asset('css/custom/custom-style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="{{asset('js/plugins/prism/prism.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('js/plugins/chartist-js/chartist.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{asset('js/plugins/data-tables/css/jquery.dataTables.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>