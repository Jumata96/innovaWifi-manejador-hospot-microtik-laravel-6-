@extends('layouts2.app')
@section('titulo','Registrar Empresa')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRAR EMPRESA</h2>
                  </div>
                  <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons blue-text text-darken-2">check</i></a>
                          <a style="margin-left: 6px"></a>   
                          
                          <a href="{{url('/empresa')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="col m4 l3">
                    
                      <div class="card white">
                          <div class="card-content">
                              <span class="card-title">LogoOOOO</span>

                              <div class="row">
                                <div class="file-field input-field col s12">
                                  
                                    <div class="col s8 m8 l6 center" style="margin: auto; width: 100%">
                                      <img src="{{asset('images/usu-perfil.png')}}" alt="" id="avatarImage" class="circle responsive-img valign profile-image teal lighten-5" style="width: 100px">
                                    </div> 
                                    <div class="col s12" style="padding: 0px; padding-top:20px">
                                      <div class="btn">
                                        <span>File</span>
                                        <input type="file" id="imagenURL" name="imagenURL">
                                      </div>
                                      <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" name="imagen">
                                        <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                      </div>
                                    </div>                                    
                                </div>
                                <div class="col s12 hide">
                                    <label for="idmodelo">Margen en píxeles</label>
                                    <p class="range-field">
                                      <input type="range" name="padding_top" min="15" max="200" class="active">
                                    </p>
                                </div>      
                                <div class="input-field col s12">                                  
                                  <input id="marca" name="marca" type="text" data-error=".errorTxt2" maxlength="200">
                                  <label for="razon_social">Marca</label>
                                  <div class="errorTxt2"></div>
                                </div>      
                                    
                              </div>

                          </div>
                      </div>
                    </div>
                    <div class="col col s12 m8 l6">
                      <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>

                            <div class="row">
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix active">label_outline</i>
                                <input id="idempresa" name="idempresa" type="text" data-error=".errorTxt1" maxlength="3" onkeyup="mayus(this);">
                                <label for="idempresa">Cod. Empresa</label>
                                <div id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">clear_all</i>
                                <input id="razon_social" name="razon_social" type="text" data-error=".errorTxt2" maxlength="200" >
                                <label for="razon_social">Nombre Empresa</label>
                                <div id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                              </div>       
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">sim_card</i>
                                <input id="RUC" name="RUC" type="text" data-error=".errorTxt3" minlength="9" maxlength="20" onkeyup="mayus(this);">
                                <label for="RUC">RUC</label>
                                <div class="error3"></div>
                              </div>

                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">room</i>
                                <input id="direccion" name="direccion" type="text" data-error=".errorTxt4" >
                                <label for="direccion">Dirección</label>
                                <div id="error4" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">insert_link</i>
                                <input id="referencia" name="referencia" type="text">
                                <label for="referencia">Referencia</label>
                              </div>     
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">call</i>
                                <input id="telefono" name="telefono" type="text">
                                <label for="telefono">Telefono</label>
                              </div>                          
                            </div>

                        </div>
                      </div>
                    </div>
                    
                    <div class="col col s12 m8 l3">
                      <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title">Representantes</span>

                            <div class="row"> 
                              <div class="col s12">
                                <label for="iddocumento">Documento</label>
                                <select class="browser-default" id="iddocumento" name="iddocumento" required>
                                  <option value="" disabled selected="">Seleccione</option>
                                  @foreach($tipo_documento as $documento)
                                  <option value="{{$documento->iddocumento}}">{{$documento->dsc_corta}} - {{$documento->descripcion}}</option>
                                  @endforeach
                                </select>
                                <div id="error7" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                              </div>  
                              <div class="input-field col s12">
                                <i class="material-icons prefix">subtitles</i>
                                <input id="DNI1" name="DNI1" type="text" onkeyup="mayus(this);">
                                <label for="DNI1">Nro. de Documento</label>
                                <div id="error8" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                              </div>      
                              <div class="input-field col s12">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="representante1" name="representante1" type="text" >
                                <label for="representante1">Nombre</label>
                                <div id="error9" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
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
<br><br><br>
@endsection

@section('script')
  @include('forms.empresa.scripts.validacion')
  @include('forms.empresa.scripts.addEmpresa')
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
