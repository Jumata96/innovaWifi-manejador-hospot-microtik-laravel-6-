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
        @foreach($logout as $datos)
        <section id="content center">
        	<div class="row">
        		<div class="col s12 m8 l6 offset-m2 offset-l3">
                  @if(empty($datos->color_fondo))
                    <div class="card gradient-shadow gradient-45deg-cyan-light-green border-radius-3">
                  @else
                    <div class="card gradient-shadow {{$datos->color_fondo}} border-radius-3">
                  @endif
                        <div class="card-content center">
                        	<br>
                        	<p class="center login-form-text white-text lighten-1" style=" font-size: 20px;margin-top: 0px"><b>Estado de su sesión</b></p>
                        	<br>
	                        <img src="{{asset('/img/avatar-7.png')}}" id="animacion" class="center circle responsive-img valign profile-image purple lighten-5 z-depth-2" style="height: 15rem; width: 15rem; border-radius:50%; border:3px solid;border-color: #e0e0e0">	

                          	<br>
							<h5 class="white-text lighten-3">Gracias por su visita <b> Usuarios! </b></h5>
							<br>
							<ul class="collection">
                        @if(!empty($datos->mostrar_ip))
			                  <li class="collection-item"><b>Dirección IP: 172.68.0.25</b></li>
                        @endif
                        @if(!empty($datos->mostrar_mac))
			                  <li class="collection-item"><b>Dirección MAC: AA:BB:CC:DD:22:33</b></li>
                        @endif
                        @if(!empty($datos->mostrar_up_down))
			                  <li class="collection-item"><b>bytes up/down: 4345/54021</b></li>
                        @endif
                        @if(!empty($datos->mostrar_tiempo_con))
			                  <li class="collection-item"><b>Tiempo la sesión: 00:02:45</b></li>
                        @endif
			                </ul>
                          	
                          <form action="" name="login" onSubmit="return openLogin()">						
							<div class="row">	
					          <div class="input-field col s12">
                      @if(empty($datos->color_btn_iniciar))
					            <button type="submit" class="btn waves-effect waves-light green darken-1 col s12" style="height: 44px; letter-spacing: .5px;">Iniciar Sesión
					              <i class="mdi-content-send right"></i>
					            </button>
                      @else
                      <button type="submit" class="btn waves-effect waves-light {{$datos->color_btn_iniciar}} col s12" style="height: 44px; letter-spacing: .5px;">Iniciar Sesión
                        <i class="mdi-content-send right"></i>
                      </button>
                      @endif
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
        @endforeach
        
        </div>
        <!-- END WRAPPER -->
    </div>
      @include('hotspot.layouts.partials.footer')
      @include('hotspot.layouts.partials.scripts')  
      <script language="JavaScript">
	
	  </script>
</body>
</html>