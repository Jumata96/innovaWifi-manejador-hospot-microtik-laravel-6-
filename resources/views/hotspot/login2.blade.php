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
        @foreach($bienvenida as $datos)
        <section id="content center">
        	<div class="row">
        		<div class="col s12 m8 l6 offset-m2 offset-l3">
                  @if(empty($datos->color_fondo))
                    <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3">
                  @else
                    <div class="card gradient-shadow {{$datos->color_fondo}} border-radius-3">
                  @endif
                        <div class="card-content center">
                        	
                        	<br>
                        	<p class="center login-form-text white-text lighten-1" style=" font-size: 20px;margin-top: 0px"><b>Estado de su conexión</b></p>
                        	<br>
                        	<img src="{{asset('/img/avatar-7.png')}}" id="animacion" class="center circle responsive-img valign profile-image purple lighten-5 z-depth-2" style="height: 15rem; width: 15rem; border-radius:50%; border:3px solid;border-color: #e0e0e0">	
                        	
                          	<br>
							<h5 class="white-text lighten-3">Bienvenido <b> Usuario! </b></h5>
							<br>
							<ul class="collection">
                        @if(!empty($datos->mostrar_ip))
			                  <li class="collection-item"><b>Dirección IP: 192.168.1.255</b></li>
                        @endif
                        @if(!empty($datos->mostrar_mac))
			                  <li class="collection-item"><b>Dirección MAC: AA:BB:CC:DD:11:22</b></li>
                        @endif
                        @if(!empty($datos->mostrar_up_down))
			                  <li class="collection-item"><b>bytes up/down: 1254b/4336b</b></li>
                        @endif
                        @if(!empty($datos->mostrar_tiempo_con))
			                  <li class="collection-item"><b>Tiempo de conexión: 02:50:03</b></li>
                        @endif
                        @if(!empty($datos->mostrar_status))
			                  <li class="collection-item"><b>status refresh: 2m</b></li>
                        @endif
			                </ul>
			                

                          	
                          <form action="" name="logout" onSubmit="return openLogout()" class="center">
							
						
							<div class="row">					          
					          <div class="input-field col s12">
                      @if(empty($datos->color_btn_navegar))
                      @if(empty($datos->link))
					            <a href="http://www.google.com" class="btn waves-effect waves-light blue darken-2 col s12" style="height: 44px;    letter-spacing: .5px; padding-top: 0.3rem">Navegar en Internet
					              <i class="mdi-content-send right"></i>
					            </a>
                      @else
                      <a href="{{$datos->link}}" class="btn waves-effect waves-light blue darken-2 col s12" style="height: 44px;    letter-spacing: .5px; padding-top: 0.3rem">Navegar en Internet
                        <i class="mdi-content-send right"></i>
                      </a>
                      @endif
                      @else
                      @if(empty($datos->link))
                      <a href="http://www.google.com" class="btn waves-effect waves-light {{$datos->color_btn_navegar}} col s12" style="height: 44px;    letter-spacing: .5px; padding-top: 0.3rem">Navegar en Internet
                        <i class="mdi-content-send right"></i>
                      </a>
                      @else
                      <a href="{{$datos->link}}" class="btn waves-effect waves-light {{$datos->color_btn_navegar}} col s12" style="height: 44px;    letter-spacing: .5px; padding-top: 0.3rem">Navegar en Internet
                        <i class="mdi-content-send right"></i>
                      </a>
                      @endif
                      @endif
					          </div>
					          <div class="input-field col s12">
                      @if(empty($datos->color_btn_cerrar))
					            <a href="{{url('/hotspot/pagina-inicio')}}" class="btn waves-effect waves-light red darken-1 col s12" style="height: 44px; letter-spacing: .5px; padding-top: 0.3rem">Cerrar sesión
					              <i class="mdi-content-send right"></i>
					            </a>
                      @else
                      <a href="{{url('/hotspot/pagina-inicio')}}" class="btn waves-effect waves-light {{$datos->color_btn_cerrar}} col s12" style="height: 44px; letter-spacing: .5px; padding-top: 0.3rem">Cerrar sesión
                        <i class="mdi-content-send right"></i>
                      </a>
                      @endif
					          </div>
					        </div>
						
						
						  </form>
						  <br>

                        </div>
                    </div>
                </div>
        		<div class="col s12 m8 l6 offset-m2 offset-l3">
        		        			
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
			$('#animacion').addClass('animated bounceIn');
	  </script>
</body>
</html>

