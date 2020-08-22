@extends('layouts.app')

@section('htmlheader_title')
  Registro Plan Queues
@endsection

@include('API.router')

@section('main-content')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card-panel-2">
                  <div class="row cabecera" style="margin-left: -0.85rem; margin-right: -0.85rem">                 
                    <div class="col s12 m12 l12">
                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                      <h4 class="header2" style="margin: 10px 0px;"><b>Registrar plan queue</b></h4>  
                    </div>
                  </div>
                  <form class="formValidate right-alert" id="formValidate" method="POST" action="{{ url('/queues/grabar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-left: -0.78rem; margin-right: -0.78rem">
                        <div class="col s12 m12 herramienta">                         
                          <button class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar"><i class="mdi-navigation-check" style="color: #2E7D32"></i></button>
                          <a style="margin-left: 6px"></a>   
                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario"><i class="mdi-action-info"></i></a>
                          <a href="{{url('/queues')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar"><i class="mdi-hardware-keyboard-tab" style="color: #424242"></i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <div class="row">
                        <div class="col s12 m6 l6">
                          <label for="idrouter">Router Mikrotik</label>
                          <select class="browser-default" id="idrouter" name="idrouter" data-error=".errorTxt1" > 
                            <option value="" disabled="" selected="">Escoja una opción</option>
                            <option value="0">Todos</option>
                            @foreach ($router as $valor)
                            <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                            @endforeach
                          </select>
                          <div class="errorTxt1"></div>
                        </div>
                                          
                      </div>                     
                      <div class="row">
                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-maps-local-offer prefix active"></i>
                          <input id="nombre" name="nombre" type="text" data-error=".errorTxt2">
                          <label for="nombre">Nombre del Plan</label>
                          <div class="errorTxt2"></div>
                        </div>      

                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-social-person prefix "></i>
                          <input id="precio" name="precio" type="number" data-error=".errorTxt3">
                          <label for="precio">Precio</label>
                          <div class="errorTxt3"></div>
                        </div>                        
                      </div>
                      <div class="row"> 
                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-social-person prefix "></i>
                          <input id="vsubida" name="vsubida" type="text" data-error=".errorTxt4">
                          <label for="vsubida">Velocidad de Subida</label>
                          <div class="errorTxt4"></div>
                        </div>     
                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-action-lock-outline prefix"></i>
                          <input id="vbajada" name="vbajada" type="text" data-error=".errorTxt5">
                          <label for="vbajada">Velocidad de descarga</label>
                          <div class="errorTxt5"></div>
                        </div>                          
                      </div>
                      <div class="row">
                        <div class="input-field col s12 m6 l6">
                          <i class="mdi-editor-mode-edit prefix"></i>
                          <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"></textarea>
                          <label for="glosa" class="">Comentario</label>
                        </div>            
                      </div>

                  </div>
                  </form>
              </div>
  </div>
</div>
<br><br><br><br>
@endsection

@section('script')
  <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script type="text/javascript">
    $("#formValidate").validate({
      rules: {
        idrouter: {
          required: true,
        },
        nombre: {
            required: true,
            minlength: 5,
            maxlenght: 50
        },
        precio: {
          required: true          
        },
        vsubida: {
          required: true          
        },
        vbajada: {
          required: true
        }
      },
        //For custom messages
        messages: {
            idrouter: {
              required: "Seleccione un Router"
            },
            nombre:{
                required: "Ingresar un nombre para el plan",
                minlength: "Ingresar 5 caracteres como mínimo"
            },
            precio: {
              required: "Ingrese el precio del plan"
            },
            vsubida: {
              required: "Ingrese la velocidad de subida"
            },
            vbajada: {
              required: "Ingrese la velocidad de bajada"
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
