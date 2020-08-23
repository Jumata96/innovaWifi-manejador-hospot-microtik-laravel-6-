<?php
   $mac=$datos['mac'];
   $ip=$datos['ip'];
   $username=$datos['username'];
   $usernameaux=($datos['usernameaux'] == '')? null : $datos['usernameaux'];
   $linklogin=$datos['link-login'];
   $linkorig=$datos['link-orig'];
   $error=$datos['error'];
   $chapid=$datos['chap-id'];
   $chapchallenge=$datos['chap-challenge'];
   //$linkloginonly=url('/hotspot/login');
   $linkloginonly=$datos['link-login-only'];
   $linkorigesc=$datos['link-orig-esc'];
   $macesc=$datos['mac-esc'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  @include('hotspot.layouts.partials.htmlHead')
</head>

<body style="background: white">
	@include('hotspot.layouts.partials.carrusel')  
<!-- $(if chap-id) -->

	<form name="sendin" action="<?php echo $linkloginonly; ?>" method="post">
		<input type="hidden" name="username" />
		<input type="hidden" name="password" />
		<input type="hidden" name="mac" />
		<input type="hidden" name="ip" />
		<input type="hidden" name="link-login" />
		<input type="hidden" name="link-orig" />
		<input type="hidden" name="error" />
		<input type="hidden" name="dst" value="<?php echo $linkorig; ?>" />
		<input type="hidden" name="popup" value="true" />
	</form>
	
	<script type="text/javascript" src="./md5.js"></script>
	<script type="text/javascript">
		window.addEventListener("load", function(){
			
			var valor = '{{$usernameaux}}';
			var error = '{{$error}}';
			console.log(valor);
			if( valor.length > 1 ){
				//console.log('probando');
				//document.getElementById("demo").innerHTML = valor;
				document.login.username.value = valor;
				document.login.password.value = valor;
				document.login.submit();
				if (error.length < 1) {
					document.login.submit();
				}				
		    	//document.getElementById("miBoton").click();
			}
		})

	<!--
	    function doLogin() {
                <?php if(strlen($chapid) < 1) echo "return true;\n"; ?>
		document.sendin.username.value = document.login.username.value;
		document.sendin.password.value = hexMD5('<?php echo $chapid; ?>' + document.login.password.value + '<?php echo $chapchallenge; ?>');
		document.sendin.submit();
		return false;
	    }
	//-->
	</script>
<!-- $(endif) -->

	

	<div id="main" style="padding-left: 0px">
      <!-- START WRAPPER -->
      <div class="wrapper">
             
        <section id="content center">
        	<div class="row">
        		<div class="col s12 m8 l6 offset-m2 offset-l3">
        		<!--	<form action="{{ url('/login') }}" method="post">  -->
        			<form name="login" action="<?php echo $linkloginonly; ?>" method="post" onSubmit="return doLogin()" >
				      	<input type="hidden" name="dst" value="<?php echo $linkorig; ?>" />
				      	<input type="hidden" name="mac" value="<?php echo $mac; ?>" />
				      	<input type="hidden" name="ip" value="<?php echo $ip; ?>" />
				      	<input type="hidden" name="linklogin" value="<?php echo $linklogin; ?>" />
				      	<input type="hidden" name="linkorig" value="<?php echo $linkorig; ?>" />
				      	<input type="hidden" name="error" value="<?php echo $error; ?>" />
						<input type="hidden" name="popup" value="true" />	
					
				        
				        @if(count($usuario) > 0)
				        @foreach($usuario as $datos)
				        <div class="row">
				          <div class="input-field col s12 center">              
				            <p class="center login-form-text" style="color: #9e9e9e; font-size: 14px;margin-top: 0px"><b>Hola {{$datos->nombre.' '.$datos->apellidos}} </b>Bienvenido a nuestro portal</p>
				            <div class="divider"></div>
				      <!--      <h6><i>Por su seguridad no revele su usuario y contraseña a terceros</i></h6>   -->
				          </div>
				        </div>
				        @foreach($parametros as $val)
				        @if($val->parametro == 'REGISTRAR_CONTRASENA' AND $val->valor == 'NO')
				        <div class="input-field col s12">
                            <a id="ingresar" disabled class="btn waves-effect waves-light  grey col s12" style="height: 44px;letter-spacing: .5px;padding-top: 0.28rem">
                            Ingreso Gratuito</a>                        	
                        </div>  
                        <br><br>
                        @endif
                        @endforeach

                        @endforeach
                        @else
                        <div class="row">
				          <div class="input-field col s12 center">              
				            <p class="center login-form-text" style="color: #9e9e9e; font-size: 14px;margin-top: 0px">Bienvenido a nuestro portal</p>
				            <div class="divider"></div>
				      <!--      <h6><i>Por su seguridad no revele su usuario y contraseña a terceros</i></h6>   -->
				          </div>
				        </div>
				        @endif
				        

				    <!--  -----------------------LOGIN------------------------------  -->
				    @foreach($parametros as $val)
					@if($val->parametro == 'FORM_LOGIN' AND $val->valor == 'NO')
				    <div class="hide">				    
				    @endif
				    @endforeach

				        <div class="row margin">
				          <div class="input-field col s12">
				            <i class="material-icons prefix">person_outline</i>
				            <input type="{{($val->parametro == 'MOSTRAR_SOLO_PIN' AND $val->valor == 'NO')? 'text': 'password'}}" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
				            <label for="username" class="center-align">Usuario</label>
				          </div>
						</div>
					
						<div class="row margin {{($val->parametro == 'MOSTRAR_SOLO_PIN' AND $val->valor == 'NO')? '': 'hide'}}">
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
				            <button type="submit" id="acceder" class="btn waves-effect waves-light  col s12" style="height: 44px;    background: #673ab7 !important;letter-spacing: .5px;">Iniciar sessión
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
				        	<div class="row">
					          <div class="hide input-field col s12">
					            <button id="iniciar" class="btn waves-effect waves-light  col s12" style="height: 44px;    background: #673ab7 !important;letter-spacing: .5px;">Iniciar sessión
					              <i class="mdi-content-send right"></i>
					            </button>
					          </div>
					        </div>
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
				        

						<!-- $(if error) -->
						<script type="text/javascript">
							setTimeout(function() {
			                  Materialize.toast('<span>{{$error}}</span>', 4500);
			                }, 100);  	
						</script>
						
						<div class="hide" style="color: #FF8080; font-size: 30px">
							<?php 
								$usernameaux = '';
								echo $error; 
							?>
						</div>
						<!-- $(endif) -->

				      </form>
				      <div class="row">
				      	@if(count($usuario) == 0)
				        @foreach($parametros as $val)
				         @if($val->parametro == 'REGISTRO_MANUAL' AND $val->valor == 'SI')
				         <form name="form" action="{{ url('/hotspot/registro') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
				         	<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="mac" value="{{$datos['mac']}}" />
							<input type="hidden" name="ip" value="{{$datos['ip']}}" />
							<input type="hidden" name="linklogin" value="{{$datos['link-login']}}" />
							<div class="input-field col s12">
					            <button  type="submit" class="btn waves-effect waves-light gradient-45deg-indigo-blue  col s12" style="height: 44px; padding-top: 0.28rem;letter-spacing: .5px;">Registrate y Accede
					              <i class="mdi-content-send right"></i>
					            </button>
					        </div>
						</form>
				          
				          @endif
				        @endforeach
				        @endif
				       </div>
				       <br>

        		</div>
        	</div>

        	
            @yield('container')
        </section>
        
        </div>
        <!-- END WRAPPER -->
    </div>
      @include('hotspot.layouts.partials.footer')
      @include('hotspot.layouts.partials.scripts')  
      @include('hotspot.scripts.login')

</body>
</html>