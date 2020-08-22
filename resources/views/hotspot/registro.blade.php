<!DOCTYPE html>
<html lang="es">

<head>
  @include('hotspot.layouts.partials.htmlHead')
</head>

<body style="background: white" >
  @include('hotspot.layouts.partials.header')  

 
  
  <div class="contend">
   <div id="main" style="padding-left: 0px; padding-top: 1.2rem">
      <!-- START WRAPPER -->
      <div class="wrapper">
             <br>
         <section id="content center">
          <div class="row">
            <div class="col s12 m8 l6 offset-m2 offset-l3">
                    <div class="card">
                            <div class="card-content center">
                              <form id="myForm" method="POST" accept-charset="UTF-8" style="padding: 5px">
                                <input type="hidden" name="mac" value="{{$datos['mac']}}" />
                                <input type="hidden" name="ip" value="{{$datos['ip']}}" />
                                <div class="row">
                                  <div class="input-field col s12 center">              
                                    <p class="center login-form-text" style="color: #9e9e9e; font-size: 14px;margin-top: 0px; margin-bottom: 5px">REGISTRO DE USUARIO</p>
                                    <div class="divider"></div>
                              <!--      <h6><i>Por su seguridad no revele su usuario y contraseña a terceros</i></h6>   -->
                                  </div>
                                </div>
                                
                                @csrf
                                <div class="row">
                                 
                                  <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">face</i>
                                    <input id="nombre" type="text" name="nombre"  required autofocus>                                   
                                    <label for="nombre" class="center-align">Nombre</label>
                                    <div id="error1" style="color: red; font-size: 12px; font-style: italic; text-align: left; padding-left: 3rem"></div>
                                  </div>
                                  <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">person_outline</i>
                                    <input id="apellidos" type="text" name="apellidos"  required>                                   
                                    <label for="usuario" class="center-align">Apellidos</label>
                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic; text-align: left; padding-left: 3rem"></div>
                                  </div>
                                  <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" name="email" required>                                   
                                    <label for="email" class="center-align">Email</label>
                                    <div id="error3" style="color: red; font-size: 12px; font-style: italic; text-align: left; padding-left: 3rem"></div>
                                  </div>
                                  <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="celular" type="text" name="celular"  required>                                   
                                    <label for="celular" class="center-align">Nro. de celular</label>
                                    <div id="error4" style="color: red; font-size: 12px; font-style: italic; text-align: left; padding-left: 3rem"></div>
                                  </div>
                                  @foreach($parametros as $val)
                                  @if($val->parametro == 'REGISTRAR_CONTRASENA' and $val->valor == 'SI')
                                  <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input id="password" type="password" name="password" required>                                   
                                    <label for="password">Contraseña</label>
                                    <div id="error5" style="color: red; font-size: 12px; font-style: italic; text-align: left; padding-left: 3rem"></div>
                                  </div>
                                  <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">lock_outline</i>
                                    <input id="password_confirmation" type="password" name="password_confirmation" required>
                                    <label for="password-again">Repetir contraseña</label>
                                    <div id="error6" style="color: red; font-size: 12px; font-style: italic; text-align: left; padding-left: 3rem"></div>
                                  </div>
                                  @endif
                                  @endforeach
                                  <div class="input-field col s12">
                                    <button id="add" class="btn waves-effect waves-light  col s12" style="height: 44px;background: #673ab7 !important;letter-spacing: .5px;">
                                      Registrar</button>
                                  </div>
                                  <div class="input-field col s12">
                                    <p class="margin center medium-small sign-up">Ya tienes una cuenta? <a href="{{ $datos['linklogin'] }}">Ingresar</a></p>
                                  </div>
                                </div>
                              </form>
                            </div>
                            
                      </div>
            </div>
          </div>
        </section>
        
        </div>
        <!-- END WRAPPER -->
    </div> 
  </div>

      @include('hotspot.layouts.partials.footer')
      @include('hotspot.layouts.partials.scripts')  
      <script language="JavaScript">
         //---JPaiva-11-12-2018----------------GUARDAR-----------------------------
          $('#add').click(function(e){
            e.preventDefault();

            var data = $('#myForm').serializeArray();
            console.log(data);


            $.ajax({
                  url: "{{ url('/addRegistro') }}",
                  type:"POST",
                  beforeSend: function (xhr) {
                      var token = $('meta[name="csrf-token"]').attr('content');

                      if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                      }
                  },
                 type:'POST',
                 url:"{{ url('/addRegistro') }}",
                 data:data,

                 success:function(data){

                    if ( data[0] == "BAD_CONTRA") {
                      setTimeout(function() {
                        Materialize.toast('<span>El correo ingresado ya existe en nuestra base de datos.</span>', 3500);
                      }, 100); 
                    }else if ( data[0] == "error") {
                      ( typeof data.nombre != "undefined" )? $('#error1').text(data.nombre) : null;
                      ( typeof data.apellidos != "undefined" )? $('#error2').text(data.apellidos) : null;
                      ( typeof data.email != "undefined" )? $('#error3').text(data.email) : null;
                      ( typeof data.celular != "undefined" )? $('#error4').text(data.celular) : null;
                      ( typeof data.password != "undefined" )? $('#error5').text(data.password) : null;
                      ( typeof data.password_confirmation != "undefined" )? $('#error6').text(data.password_confirmation) : null;
                    } else {  
                      var obj = $.parseJSON(data); 

                      setTimeout(function() {
                        Materialize.toast('<span>Registro exitoso</span>', 1500);
                      }, 100); 
                     
                      setTimeout("location.href='{{ $datos['linklogin'] }}'", 3000);
                    }
                 },
                 error:function(){ 
                    alert("error!!!!");
              }
            });    

          });    
      </script>
</body>
</html>