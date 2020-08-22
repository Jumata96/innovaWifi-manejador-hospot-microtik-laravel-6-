<!DOCTYPE html>
<html lang="es">

<head>
  @include('hotspot.layouts.partials.htmlHead')
</head>

<body style="background: white">
	@include('hotspot.layouts.partials.carrusel2')  
<!-- $(if chap-id) -->

	<form name="sendin" action="" method="post">
		<input type="hidden" name="username" />
		<input type="hidden" name="password" />
		<input type="hidden" name="mac" />
		<input type="hidden" name="ip" />
		<input type="hidden" name="link-login" />
		<input type="hidden" name="link-orig" />
		<input type="hidden" name="error" />
		<input type="hidden" name="dst" value="" />
		<input type="hidden" name="popup" value="true" />
	</form>
	
	<script type="text/javascript" src="./md5.js"></script>
	
	

	<div id="main" style="padding-left: 0px">
      <!-- START WRAPPER -->
      <div class="wrapper">
             
        <section id="content center">
        	<div class="row">
        		<div class="col s12 m8 l6 offset-m2 offset-l3">
        		<!--	<form action="{{ url('/login') }}" method="post">  -->
        			<form name="login" action="" method="post" onSubmit="return doLogin()" >
				      	
				        <div class="row">
				          <div class="input-field col s12 center">              
				            <p class="center login-form-text" style="color: #9e9e9e; font-size: 14px;margin-top: 0px">Bienvenido a nuestro portal</p>
				            <div class="divider"></div>
				      <!--      <h6><i>Por su seguridad no revele su usuario y contraseña a terceros</i></h6>   -->
				          </div>
				        </div>

				    <!--  -----------------------LOGIN------------------------------  -->
				    @foreach($parametros as $val)
					@if($val->parametro == 'FORM_LOGIN' AND $val->valor == 'NO')
				    <div class="hide">				    
				    @endif
				    @endforeach
				    				    
				        <div class="row margin">
				          <div class="input-field col s12">
				            <i class="material-icons prefix">person_outline</i>
				            <input type="text" class="form-control" name="username" id="username" value="">
				            <label for="username" class="center-align">Usuario</label>
				          </div>
				        </div>
				        <div class="row margin">
				          <div class="input-field col s12">
				            <i class="material-icons prefix">lock_outline</i>
				            <input id="password" type="password" class="form-control" name="password">
				            <label for="password">Contraseña</label>
				          </div>
				        </div>
				    
				    <!--    <div class="row">          
				          <div class="input-field col s12 m12 l12  login-text">
				              <input type="checkbox" id="remember-me" />
				              <label for="remember-me" name="remember">Recordarme</label>
				          </div>
				        </div> -->
				        <div class="row">
				          <div class="input-field col s12">
				            <button type="submit" class="btn waves-effect waves-light  col s12" style="height: 44px;    background: #673ab7 !important;letter-spacing: .5px;">Iniciar sessión
				              <i class="mdi-content-send right"></i>
				            </button>
				          </div>
				        </div>
				    @foreach($parametros as $val)
					@if($val->parametro == 'FORM_LOGIN' AND $val->valor == 'NO')
				    </div>
				    @endif
				    @endforeach
				    <!--  -----------------------FIN LOGIN------------------------------  -->


				        <div class="row">
				        @foreach($parametros as $val)
				          @if($val->parametro == 'SOCIAL_FACEBOOK' AND $val->valor == 'SI')
				          <div class="input-field col s12">
				            <a href="{{ route('social.auth', 'facebook') }}" type="submit" class="btn waves-effect waves-light  col s12" style="height: 44px; padding-top: 0.3rem; background: #4267B2 !important;letter-spacing: .5px;">Ingresar con Facebook
				              <i class="mdi-content-send right"></i>
				            </a>
				          </div>
				          @endif				        
				          @if($val->parametro == 'SOCIAL_TWITTER' AND $val->valor == 'SI')
				          <div class="input-field col s12">
				            <a href="{{ route('social.auth', 'twitter') }}" type="submit" class="btn waves-effect waves-light  col s12" style="height: 44px; padding-top: 0.3rem; background: #1DA1F2 !important;letter-spacing: .5px;">Ingresar con Twitter
				              <i class="mdi-content-send right"></i>
				            </a>
				          </div>
						  @endif
						  @if($val->parametro == 'SOCIAL_GOOGLE' AND $val->valor == 'SI')
				          <div class="input-field col s12">
				            <a href="{{ route('social.auth', 'google') }}" type="submit" class="btn waves-effect waves-light  col s12" style="height: 44px; padding-top: 0.3rem; background: #4285F4 !important;letter-spacing: .5px;">Ingresar con Google+
				              <i class="mdi-content-send right"></i>
				            </a>
				          </div>
				          @endif
				        @endforeach				        
				        </div>
				        <div class="row">
				        @foreach($parametros as $val)
				         @if($val->parametro == 'REGISTRO_MANUAL' AND $val->valor == 'SI')
				          <div class="input-field col s12">
				            <a href="{{ url('/hotspot/registro') }}" type="submit" class="btn waves-effect waves-light gradient-45deg-indigo-blue  col s12" style="height: 44px; padding-top: 0.3rem;letter-spacing: .5px;">Registro Manual
				              <i class="mdi-content-send right"></i>
				            </a>
				          </div>
				          @endif
				        @endforeach
				        </div>

						<!-- $(if error) -->
						<br />
						<div style="color: #FF8080; font-size: 30px">
							
						</div>
						<!-- $(endif) -->

				      </form>

        		</div>
        	</div>

        	
            @yield('container')
        </section>
        
        </div>
        <!-- END WRAPPER -->
    </div>
      @include('hotspot.layouts.partials.footer')
      @include('hotspot.layouts.partials.scripts')  

</body>
</html>