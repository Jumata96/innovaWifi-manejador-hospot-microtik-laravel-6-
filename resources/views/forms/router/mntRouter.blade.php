@extends('layouts2.app')
@section('titulo','Registrar Router')

@section('main-content')

<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRAR MIKROTIK</h2>
                  </div>
                  <form class="formValidate right-alert" id="formValidate" method="POST" action="{{ url('/grabar-router') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                          <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </button>
                          <a style="margin-left: 6px"></a>   
                          
                          <a href="{{url('/router')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i>
                          </a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="row">
                        <div class="input-field col s12 s12 m6 l6">
                          <i class="material-icons prefix active">label_outline</i>
                          <input id="idrouter" name="idrouter" type="text" data-error=".errorTxt1" minlength="1" maxlength="3">
                          <label for="idrouter">Código Router*</label>
                          <div class="errorTxt1"></div>
                        </div>

                        <div class="input-field col s12 s12 m6 l6">
                          <i class="material-icons prefix">local_offer</i>
                          <input id="alias" name="alias" type="text" data-error=".errorTxt2">
                          <label for="alias">Alias del Router*</label>
                          <div class="errorTxt2"></div>
                        </div>     
                        <div class="input-field col s12 m6 l6">
                          <i class="material-icons prefix">filter_tilt_shift</i>
                          <input id="ip" name="ip" type="text" data-error=".errorTxt3">
                          <label for="ip">Dirección IP*</label>
                          <div class="errorTxt3"></div>
                        </div>

                        <div class="input-field col s12 m6 l6">
                          <i class="material-icons prefix ">person</i>
                          <input id="usuario" name="usuario" type="text" data-error=".errorTxt4">
                          <label for="usuario">Usuario Api Mikrotik*</label>
                          <div class="errorTxt4"></div>
                        </div>    
                        <div class="input-field col s12 m6 l6">
                          <i class="material-icons prefix">lock_outline</i>
                          <input id="password" name="password" type="password" data-error=".errorTxt5">
                          <label for="password">Contraseña*</label>
                          <div class="errorTxt5"></div>
                        </div>  

                        <div class="input-field col s12 m6 l6">
                          <i class="material-icons prefix">settings_ethernet</i>
                          <input id="puerto" name="puerto" type="text" placeholder="Puerto Api Opcional">
                          <label for="puerto">Puerto Api</label>
                        </div>
                      </div>
                                     
                  </div>
                  </form>
              </div>
  </div>
</div>
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
