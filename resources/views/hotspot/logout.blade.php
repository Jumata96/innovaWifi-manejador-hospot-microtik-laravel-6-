<?php
	$mac=$datos['mac'];
	$ip=$datos['ip'];
	$username=$datos['username'];
	$linklogin=$datos['link-login'];
	$binnice=$datos['bytes-in-nice'];
	$boutnice=$datos['bytes-out-nice'];
	$uptime=$datos['uptime'];
	$macesc=$datos['mac-esc'];
	$linklogout=$datos['link-logout'];
	$linkadvert=$datos['link-advert'];
	$refreshtimeout = $datos['refresh-timeout'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  @include('hotspot.layouts.partials.htmlHead')
</head>

<body style="background: white" >
	@include('hotspot.layouts.partials.header')  

	
	<div id="main" style="padding-left: 0px">
      <!-- START WRAPPER -->
      <div class="wrapper">
             <br>
        <section id="content center">
        	<div class="row">
        		<div class="col s12 m8 l6 offset-m2 offset-l3">
                    <div class="card gradient-shadow gradient-45deg-cyan-light-green border-radius-3">
                        <div class="card-content center">
                        	<br>
                        	<p class="center login-form-text white-text lighten-1" style=" font-size: 20px;margin-top: 0px"><b>Estado de su sesión</b></p>
                        	<br>
	                        <img src="{{asset('images/usu-perfil.png')}}" alt="" class="circle responsive-img valign profile-image purple lighten-5" style="height: 180px; width:180px">

                          	<br>
							<h5 class="white-text lighten-3">Gracias por su visita <b> {{$username}}! </b></h5>
							<br>
							<ul class="collection">
			                  <li class="collection-item"><b>Dirección IP: {{$ip}}</b></li>
			                  <li class="collection-item"><b>Dirección MAC: {{$mac}}</b></li>
			                  <li class="collection-item"><b>bytes up/down: {{$binnice}}/{{$boutnice}}</b></li>
			                  <li class="collection-item"><b>Tiempo la sesión: {{$uptime}}</b></li>
			                </ul>
<!--
							<p class="white-text lighten-4">Dirección IP: {{$ip}}</p>
							<p class="white-text lighten-4">Dirección MAC: {{$mac}}</p>
                          	<p class="white-text lighten-4">bytes up/down: {{$binnice}}/{{$boutnice}}</p>
                          	<p class="white-text lighten-4">Tiempo de conexión: {{$uptime}}</p>
                          	<p class="white-text lighten-4">status refresh: {{$refreshtimeout}} </p>
                          -->
                          	
                          <form action="{{$linklogin}}" name="login" onSubmit="return openLogin()">						
							<div class="row">	
					          <div class="input-field col s12">
					            <button type="submit" class="btn waves-effect waves-light green darken-1 col s12" style="height: 44px; letter-spacing: .5px;">Iniciar Sesión
					              <i class="mdi-content-send right"></i>
					            </button>
					          </div>
					        </div>						
						  </form>
						  <br>

                        </div>
                    </div>
                </div>
        		<div class="col s12 m8 l6 offset-m2 offset-l3">
        		<!--	<form action="{{ url('/login') }}" method="post">  -->
        			
        		</div>
        	</div>

        	
            @yield('container')
        </section>
        
        </div>
        <!-- END WRAPPER -->
    </div>
      @include('hotspot.layouts.partials.footer')
      @include('hotspot.layouts.partials.scripts')  
      <script language="JavaScript">
	
	  </script>
</body>
</html>