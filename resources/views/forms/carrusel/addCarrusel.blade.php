@extends('layouts2.app')
@section('titulo','Agregar item Carrusel')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>AGREGAR ITEM AL CARRUSEL</h2>
                  </div>
                  <form class="formValidate right-alert" id="avatarForm" method="POST" action="{{ url('/carrusel/grabar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="guardar" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>   
                          <a style="margin-left: 6px"></a>   
                          
                          <a href="{{url('/carrusel')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')                            
                  </div>                                    
                  
                  <div class="row">
                    <div class="col m4 l4">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">IMAGEN / VIDEO</span>

                            <div class="row">
                              <div class="col s12">
                                <div class="file-field input-field col s12 "> 
                                  <div class="col s8 m8 l6 offset-s2 offset-m2 offset-l3 center" style="">
                                    <img src="{{asset('images/usu-perfil.png')}}" alt="" id="avatarImage" class="circle responsive-img valign profile-image teal lighten-5" style="height: 100%; width: 100%">
                                  </div> 
                                  <div class="col s12" style="padding: 0px; padding-top:50px">
                                    <div class="btn">
                                      <span>File</span>
                                      <input type="file" id="avatarInput" name="url_imagen">
                                    </div>
                                    <div class="file-path-wrapper">
                                      <input class="file-path validate" type="text" name="imagen">
                                      <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                    </div>
                                  </div>   
                                </div>                    
                              </div>                                  
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="col m8 l8">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>

                            <div class="row">
                              
                              <div class="col s12">
                                <div class="input-field col s12">
                                 <div id="estado" class="chip center-align teal accent-4 white-text col s12 m6 l4 offset-l8">
                                    <b>NO DISPONIBLE</b>
                                    <i class="material-icons"></i>
                                  </div>
                                </div>   
                                <div class="col s12"  style="margin-bottom: 1.5rem; margin-top: 1.5rem; margin-left: 0.3rem">  
                                  <input type="checkbox" id="img_principal" name="img_principal">
                                  <label for="img_principal">Es imagen principal</label>          
                                </div>       
                                <div class="col s12">
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Seleccione el tipo de alineación del contenido a mostrar</p>                                  
                                  </div>  
                                  
                                  <div class="col s12 m6 l4">
                                    <label for="idmodelo">Alineación</label>
                                    <select id="alineacion" class="browser-default" name="alineacion" data-error=".errorTxt1"> 
                                      <option value="" disabled="" selected="">Seleccionar</option>
                                      <option value="center-align">CENTRO</option>
                                      <option value="left-align">IZQUIERDA</option>
                                      <option value="right-align">DERECHA</option>
                                    </select> 
                                  </div>           
                                </div> 
                                <div class="col s12" style="padding-bottom: 10px; padding-top: 10px">
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Seleccione el margen del contenido con respecto a la cabecera de la página web</p>                                  
                                  </div>  
                                  
                                  <div class="col s12 m6 l4">
                                    <label for="idmodelo">Margen en píxeles</label>
                                    <p class="range-field">
                                      <input type="range" name="padding_top" min="15" max="200" class="active">
                                    </p>
                                  </div>           
                                </div>     
                                <div class="col s12" style="padding-bottom: 10px; padding-top: 10px"> 
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Ingrese el código de un color que se muestra en la sección de la paleta de colores</p>
                                  </div>                                    
                                  <div class="col s12 m6 l4">
                                    <label for="color">Color</label>
                                    <input id="color" name="color" type="text" data-error=".errorTxt2" minlength="7" maxlength="100">
                                    
                                  </div> 
                                </div>  
                                <div class="col s12">
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Mostrar botón para la redirección del contenido mostrado</p>                                  
                                  </div>  
                                  
                                  <div class="col s12 m6 l4">
                                    <label for="btn_estado">Habilitar</label>
                                    <select id="btn_estado" class="browser-default" name="btn_estado" data-error=".errorTxt1"> 
                                      <option value="" disabled="" selected="">Seleccionar</option>                                      
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>                                      
                                    </select> 
                                  </div>           
                                </div>     
                                <div class="col s12" style="padding-bottom: 10px; padding-top: 10px"> 
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Ingrese el código de un color que se muestra en la sección de la paleta de colores para el botón </p>
                                  </div>                                    
                                  <div class="col s12 m6 l4">
                                    <label for="btn_color">Color</label>
                                    <input id="btn_color" name="btn_color" type="text" data-error=".errorTxt2" minlength="7" maxlength="100" value="">
                                    
                                  </div> 
                                </div>       
                                <div class="col s12" style="padding-bottom: 10px; padding-top: 10px"> 
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Ingrese el código del producto para realizar el enlace con el botón</p>
                                  </div>                                    
                                  <div class="col s12 m6 l4">
                                    <label for="btn_idprod">Cod. Producto</label>
                                    <input id="btn_idprod" name="btn_idprod" type="text" data-error=".errorTxt2" maxlength="11" value="">
                                    
                                  </div> 
                                </div>       

                                <div class="input-field col s12">
                                  <i class="material-icons prefix">clear_all</i>
                                  <input id="titulo" name="titulo" type="text" data-error=".errorTxt2" maxlength="200">
                                  <label for="titulo">Título</label>
                                  <div class="errorTxt2"></div>
                                </div>       
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">mode_edit</i>
                                  <textarea id="descripcion" name="descripcion" class="materialize-textarea" lenght="200" maxlength="200" value="" style="height: 100px"></textarea>
                                  <label for="descripcion" class="">Descripción</label>
                                </div>
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
  <script type="text/javascript">
    $(function () {
        var $avatarImage, $avatarInput, $avatarForm;

        $avatarImage = $('#avatarImage');
        $avatarInput = $('#avatarInput');
        $avatarForm = $('#avatarForm');

     

        //$avatarInput.on('change', function () {
        $('#guardar').on('click', function () {
            //alert('change');
            
            var formData = new FormData();
            formData.append('url_imagen', $avatarInput[0].files[0]);

            $.ajax({
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                url: $avatarForm.attr('action') + '?' + $avatarForm.serialize(),
                method: $avatarForm.attr('method'),               
                data: formData,
                processData: false,
                contentType: false
            }).done(function (data) {
              
                if (data.success)
                    //$avatarImage.attr('src', data.path);
                   window.location="{{ url('/carrusel') }}";
                    
            }).fail(function () {
                alert('Debe cargar un archivo / El formato del archivo es invalido ');
            });
        });
    });
  </script>
    
@endsection
