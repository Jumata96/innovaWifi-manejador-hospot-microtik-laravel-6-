@extends('layouts2.app')
@section('titulo','Actualizar item del carrusel')

@section('main-content')
<br>
@foreach($carrusel as $datos)
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>ACTUALIZAR ITEM DEL CARRUSEL</h2>
                  </div>
                  <form class="formValidate right-alert" id="myForm" method="POST" action="{{ url('/carrusel/actualizar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>   
                          <a style="margin-left: 6px"></a>   
                          
                          <a href="{{url('/carrusel')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $datos->id }}">

                    <div class="col s12 m4 l4">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">
                                   @if($datos->extension == 'mp4' || $datos->extension == 'mp4v' || $datos->extension == 'mpg4' || $datos->extension =='mpeg' || $datos->extension =='mpg')                                    
                                      VIDEO                                   
                                  @else
                                    IMAGEN
                                  @endif
                            </span>

                            <div class="row">
                              <div class="col s12">
                                <div class="file-field input-field col s12 "> 
                                  <div class="col s12 m12 l12  center" style="">
                                  @if($datos->extension == 'mp4' || $datos->extension == 'mp4v' || $datos->extension == 'mpg4' || $datos->extension =='mpeg' || $datos->extension =='mpg')
                                    <video src="{{asset('/')}}{{$datos->url_imagen}}" controls width="340" height="260" autoplay>
                                      Video
                                    </video>
                                  @else
                                    <img src="{{asset('/')}}{{$datos->url_imagen}}" alt="" class="z-depth-1" style="height: 100%; width: 100%">
                                  @endif
                                  </div> 
                                  <div class="col s12" style="padding: 0px; padding-top:50px">
                                    <div class="btn">
                                      <span>File</span>
                                      <input type="file" id="avatarInput" name="url_imagen">
                                    </div>
                                    <div class="file-path-wrapper">
                                      <input class="file-path validate" type="text" name="imagen" value="{{$datos->imagen}}">
                                      <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                    </div>
                                  </div>   
                                </div>                    
                              </div>
                              <div class="col s12" style="margin-bottom: 1.5rem; margin-left: 0.3rem">  
                                  @if($datos->img_principal == 1)                               
                                  <input type="checkbox" id="img_principal" name="img_principal" checked="">
                                  @else
                                  <input type="checkbox" id="img_principal" name="img_principal">
                                  @endif
                                  <label for="img_principal">Es imagen principal</label>          
                                </div>    
                               
                        </div>
                    </div>
                  </div>
                  </div>

                    <div class="col s12 m8 l8">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>

                            <div class="row">
                             
                              <div class="col s12">
                                <div class="input-field col s12">
                                 <div id="estado" class="chip center-align teal accent-4 white-text col s12 m6 l4 offset-m6 offset-l8">
                                    ESTADO:<b> ACTIVO</b>
                                    <i class="material-icons"></i>
                                  </div>
                                </div>                                   
                                <div class="col s12">
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Seleccione el tipo de alineación del contenido a mostrar</p>                                  
                                  </div>  
                                  
                                  <div class="col s12 m6 l4">
                                    <label for="idmodelo">Alineación</label>
                                    <select id="alineacion" class="browser-default" name="alineacion" data-error=".errorTxt1"> 
                                      <option value="" disabled="">Seleccionar</option>
                                      @switch($datos->alineacion)      
                                      @case('center-align')                              
                                        <option value="center-align" selected="">CENTRO</option>
                                        <option value="left-align">IZQUIERDA</option>
                                        <option value="right-align">DERECHA</option>

                                        @break
                                      @case('left-align')                              
                                        <option value="center-align">CENTRO</option>
                                        <option value="left-align" selected="">IZQUIERDA</option>
                                        <option value="right-align">DERECHA</option>

                                        @break
                                      @case('right-align')                              
                                        <option value="center-align">CENTRO</option>
                                        <option value="left-align">IZQUIERDA</option>
                                        <option value="right-align" selected="">DERECHA</option>

                                        @break
                                      @endswitch
                                      
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
                                      <input type="range" name="padding_top" min="15" max="200" value="{{$datos->padding_top}}" class="active">
                                    </p>
                                  </div>           
                                </div>    
                                <div class="col s12" style="padding-bottom: 10px; padding-top: 10px"> 
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Ingrese el código de un color que se muestra en la sección de la paleta de colores</p>
                                  </div>                                    
                                  <div class="col s12 m6 l4">
                                    <label for="color">Color</label>
                                    <input id="color" name="color" type="text" data-error=".errorTxt2" minlength="7" maxlength="100" value="{{$datos->color}}">
                                    
                                  </div> 
                                </div>     
                                <div class="col s12">
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Mostrar botón para la redirección del contenido mostrado</p>                                  
                                  </div>  
                                  
                                  <div class="col s12 m6 l4">
                                    <label for="btn_estado">Habilitar</label>
                                    <select id="btn_estado" class="browser-default" name="btn_estado" data-error=".errorTxt1"> 
                                      <option value="" disabled="">Seleccionar</option>
                                      @if($datos->btn_estado == 0)
                                        <option value="1">SI</option>
                                        <option value="0" selected="">NO</option>                                        
                                      @endif
                                      @if($datos->btn_estado == 1)
                                        <option value="1" selected="">SI</option>
                                        <option value="0">NO</option>
                                      @endif
                                    </select> 
                                  </div>           
                                </div>     
                                <div class="col s12" style="padding-bottom: 10px; padding-top: 10px"> 
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Ingrese el código de un color que se muestra en la sección de la paleta de colores para el botón </p>
                                  </div>                                    
                                  <div class="col s12 m6 l4">
                                    <label for="btn_color">Color</label>
                                    <input id="btn_color" name="btn_color" type="text" data-error=".errorTxt2" minlength="7" maxlength="100" value="{{$datos->btn_color}}">
                                    
                                  </div> 
                                </div>       
                                <div class="col s12" style="padding-bottom: 10px; padding-top: 10px"> 
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>Ingrese el código del producto para realizar el enlace con el botón</p>
                                  </div>                                    
                                  <div class="col s12 m6 l4">
                                    <label for="btn_idprod">Cod. Producto</label>
                                    <input id="btn_idprod" name="btn_idprod" type="text" data-error=".errorTxt2" minlength="7" maxlength="100" value="{{$datos->btn_idprod}}">
                                    
                                  </div> 
                                </div>       
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">clear_all</i>
                                  <input id="titulo" name="titulo" type="text" data-error=".errorTxt2" maxlength="50" value="{{$datos->titulo}}">
                                  <label for="titulo">Título</label>
                                  <div class="errorTxt2"></div>
                                </div>       
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">mode_edit</i>
                                  <textarea id="descripcion" name="descripcion" class="materialize-textarea" lenght="200" maxlength="200" value="" style="height: 100px">{{$datos->descripcion}}</textarea>
                                  <label for="descripcion" class="">Descripción</label>
                                </div>
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
@endforeach
@endsection

@section('script')
  @include('forms.carrusel.scripts.updCarrusel')    
@endsection
