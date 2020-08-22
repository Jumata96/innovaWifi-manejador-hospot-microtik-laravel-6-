@extends('forms.router.router')
@section('content-router')

@include('API.router')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card-panel-2">
                  <div class="row cabecera" style="margin-left: -0.85rem; margin-right: -0.85rem">                 
                    <div class="col s12 m12 l12">
                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                      <h4 class="header2" style="margin: 10px 0px;"><b>Registrar Router Mikrotik</b></h4>  
                    </div>
                  </div>
                  <form class="formValidate right-alert" id="formValidate" method="POST" action="{{ url('/grabar-router') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-left: -0.78rem; margin-right: -0.78rem">
                        <div class="col s12 m12 herramienta">
                          <button class="btn-floating waves-effect waves-light  grey lighten-5" style="margin-right: 2px"><i class="mdi-content-add  blue-text text-lighten-1"></i></button> 
                          <a class="btn-floating waves-effect waves-light grey lighten-5"><i class="mdi-content-remove red-text text-lighten-1"></i></a>
                          <a style="margin-left: 6px"></a>   
                          <button class="btn-floating waves-effect waves-light grey lighten-5" type="submit" name="action" style="margin-right: 2px"><i class="mdi-navigation-check green-text text-lighten-1"></i></button>
                          <a class="btn-floating waves-effect waves-light  grey lighten-5"><i class="mdi-image-edit blue-text text-darken-2"></i></a>
                          <a style="margin-left: 6px"></a>   
                          <a class="btn-floating waves-effect waves-light light-blue lighten-1"><i class="mdi-action-info"></i></a>
                          <a class="dropdown-button btn-floating right waves-effect waves-light grey lighten-5" href="#!" data-activates="dropdown2"><i class="mdi-editor-vertical-align-bottom grey-text text-darken-4"></i></a>            
                        </div>                   
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="row">
                        <div class="input-field col s12 s12 m6 l6">
                          <i class="mdi-maps-local-offer prefix active"></i>
                          <input id="idrouter" name="idrouter" type="text" data-error=".errorTxt1" maxlength="3">
                          <label for="idrouter">Código Router*</label>
                          <div class="errorTxt1"></div>
                        </div>

                        <div class="input-field col s12 s12 m6 l6">
                          <i class="mdi-maps-local-offer prefix active"></i>
                          <input id="alias" name="alias" type="text" data-error=".errorTxt2">
                          <label for="alias">Alias del Router*</label>
                          <div class="errorTxt2"></div>
                        </div>                        
                      </div>                     
                      <div class="row">
                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-image-filter-tilt-shift prefix active"></i>
                          <input id="ip" name="ip" type="text" data-error=".errorTxt3">
                          <label for="ip">Dirección IP*</label>
                          <div class="errorTxt3"></div>
                        </div>

                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-social-person prefix "></i>
                          <input id="usuario" name="usuario" type="text" data-error=".errorTxt4">
                          <label for="usuario">Usuario Api Mikrotik*</label>
                          <div class="errorTxt4"></div>
                        </div>                        
                      </div>
                      <div class="row">  
                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-action-lock-outline prefix"></i>
                          <input id="password" name="password" type="password" data-error=".errorTxt5">
                          <label for="password">Contraseña*</label>
                          <div class="errorTxt5"></div>
                        </div>  

                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-action-settings-ethernet prefix"></i>
                          <input id="puerto" name="puerto" type="text" placeholder="Puerto Api Opcional">
                          <label for="puerto">Puerto Api</label>
                        </div>
                      </div>
                                     
                  </div>
                  </form>
              </div>
  </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
@endsection

@section('script')
  <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script type="text/javascript">
    $("#formValidate").validate({
      rules: {
        idrouter: {
          required: true,
          minlength: 3,
          maxlenght: 3
        },
        alias: {
            required: true,
            minlength: 2,
            maxlenght: 50
        },
        ip: {
          required: true          
        },
        usuario: {
          required: true          
        },
        password: {
          required: true
        }
      },
        //For custom messages
        messages: {
            idrouter: {
              required: "Ingrese un código para el Router",
              minlength: "Ingresar 3 caracteres como mínimo"
            },
            alias:{
                required: "Ingresar un Alias",
                minlength: "Ingresar 2 caracteres como mínimo"
            },
            ip: {
              required: "Ingrese el IP del Router"
            },
            usuario: {
              required: "Ingrese un Usuario"
            },
            password: {
              required: "Ingrese una contraseña"
            },
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
   
  </script>
@endsection
