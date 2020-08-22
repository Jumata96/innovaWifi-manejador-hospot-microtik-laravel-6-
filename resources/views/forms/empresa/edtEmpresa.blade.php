@extends('layouts2.app')
@section('titulo','Registro Empresa')

@section('main-content')
<br>
@foreach($empresa as $datos)
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>ACTUALIZAR EMPRESA</h2>
                  </div>
                  <form class="formValidate right-alert" id="formValidate" method="POST" action="{{ url('/empresa/actualizar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/empresa/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
                            <i class="material-icons" style="color: #03a9f4">add</i>
                          </a>
                          
                          <a style="margin-left: 6px"></a>   
                          <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </button>                          
                          
                          <a href="{{url('/empresa')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #546e7a ">keyboard_tab</i>
                          </a>          
                        </div> 
                        @include('forms.scripts.modalInformacion')
                        @include('forms.empresa.scripts.alertaConfirmacion2')         
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idempresa" value="{{ $datos->idempresa }}">

                    <div class="col s12 m8 l6">
                                       
                      <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>
                            <div class="row">
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix active">label_outline</i>
                                <input id="idempresa" name="idempresa" type="text" data-error=".errorTxt1" maxlength="3" value="{{ $datos->idempresa }}" disable>
                                <label for="idempresa">Cod. Empresa</label>
                                <div class="errorTxt1"></div>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">clear_all</i>
                                <input id="razon_social" name="razon_social" type="text" data-error=".errorTxt2" maxlength="200" value="{{ $datos->razon_social }}">
                                <label for="razon_social">Razón Social</label>
                                <div class="errorTxt2"></div>
                              </div>      
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">sim_card</i>
                                <input id="RUC" name="RUC" type="text" data-error=".errorTxt3" value="{{ $datos->RUC }}" maxlength="11">
                                <label for="RUC">RUC</label>
                                <div class="errorTxt3"></div>
                              </div>

                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">room</i>
                                <input id="direccion" name="direccion" type="text" data-error=".errorTxt4" value="{{ $datos->direccion }}">
                                <label for="direccion">Dirección</label>
                                <div class="errorTxt4"></div>
                              </div>      
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">insert_link</i>
                                <input id="referencia" name="referencia" type="text" value="{{ $datos->referencia }}">
                                <label for="referencia">Referencia</label>
                              </div>     
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">call</i>
                                <input id="telefono" name="telefono" type="text" value="{{ $datos->telefono }}">
                                <label for="telefono">Telefono</label>
                              </div>                          
                            </div>

                        </div>
                      </div>
                    </div>                                       

                  <div class="col s12 m4 l3">
                    <div class="card teal lighten-5">
                        <div class="card-content">
                            <span class="card-title teal-text">Representante</span>
                            <div class="row"> 
                              <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="representante1" name="representante1" type="text" value="{{ $datos->representante1 }}">
                                <label for="representante1">Representante 01</label>
                              </div>     
                              <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix"> picture_in_picture</i>
                                <input id="documento1" name="documento1" type="text" value="{{ $datos->documento1 }}">
                                <label for="documento1">Doc. Identidad</label>
                              </div>  
                              <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">subtitles</i>
                                <input id="DNI1" name="DNI1" type="text" value="{{ $datos->DNI1 }}">
                                <label for="DNI1">Nro. de Documento</label>
                              </div>                          
                            </div>
                           
                        </div>
                    </div>
                  </div>                        

                  <div class="col s12 m4 l3">
                    <div class="card teal lighten-5">
                        <div class="card-content">
                            <span class="card-title teal-text">Representante</span>                            
                            <div class="row"> 
                              <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="representante2" name="representante2" type="text" value="{{ $datos->representante2 }}">
                                <label for="representante2">Representante 02</label>
                              </div>     
                              <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix"> picture_in_picture </i>
                                <input id="documento2" name="documento2" type="text" value="{{ $datos->documento2 }}">
                                <label for="documento2">Doc. Identidad</label>
                              </div>  
                              <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">subtitles</i>
                                <input id="DNI2" name="DNI2" type="text" value="{{ $datos->DNI2 }}">
                                <label for="DNI2">Nro. de Documento</label>
                              </div>                          
                            </div>
                        </div>
                    </div>
                  </div>                        
                      
                  </div>
                  </form>
              </div>
  </div>
</div>
@endforeach
<br><br><br>
@endsection

@section('script')
  <script type="text/javascript" src="{{asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">
    $("#formValidate").validate({
      rules: {
        idempresa: {
          required: true,
          minlength: 1,
          maxlenght: 3
        },
        razon_social: {
            required: true,
            minlength: 3,
            maxlenght: 200
        },
        RUC: {
          required: true,
          minlength: 11          
        },
        direccion: {
          required: true          
        }
      },
        //For custom messages
        messages: {
            idempresa: {
              required: "Ingrese un código para la Empresa",
              minlength: "Ingresar 1 caracter como mínimo"
            },
            razon_social:{
                required: "Ingrese una Razón Social"
            },
            RUC: {
              required: "Ingrese el RUC"
            }, 
            direccion: {
              required: "Ingrese una dirección"
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
