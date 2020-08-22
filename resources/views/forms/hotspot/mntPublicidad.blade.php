@extends('layouts2.app')
@section('titulo','Mantenedor de Publicidad')

@section('main-content')
<br>

<div class="row">
  <div class="col s12 m12 l12">

                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>MANTENEDOR PUBLICIDAD</h2>
                  </div>
                 <form class="formValidate right-alert" id="formMision" method="POST" action="{{ url('/carrusel/grabar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
                        <div class="col s12 m12">
                          <a id="update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>   
                          <a style="margin-left: 6px"></a>                          
                          <a href="{{url('/hotspot/lstPublicidad')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i>
                          </a>                               
                        </div>  
                        @include('forms.scripts.modalInformacion')                               
                  </div>
                  
                  <br>                  
                  <div class="row cuerpo">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">

                   <div class="col m6 l6">
                                          <div class="card white">
                                              <div class="card-content">
                                                  <div class="row">                                                    
                                                    <div class="col s12">                                                      
                                                      <div class="file-field input-field col s12" style="margin: 0px; padding: 0px"> 
                                                        <div class="col s12  center" style="">                                                     
                                                                                                                  
                                                          <img class="z-depth-1" src="{{asset('/images/user-profile-bg.jpg')}}" alt="" style="height: 300px; width: 100%">
                                                          
                                                        </div>                                                         
                                                      </div>                                                    
                                                      
                                                      <div class=" col s12">
                                                        <label for="u_imagen" class="col s12" style="padding-left: 5px; padding-bottom: 5px">Seleccionar tipo</label>
                                                        <div class="col s12 m6 l6">
                                                          <p>
                                                            <input class="with-gap" name="group1" type="radio" id="test3" value="0">
                                                            <label for="test3">Imágen</label>
                                                          </p>                                                          
                                                        </div>                                                        
                                                        <div class="col s12 m6 l6">
                                                          <p>
                                                            <input class="with-gap" name="group1" type="radio" id="test4" value="1">
                                                            <label for="test4">Video</label>
                                                          </p>
                                                        </div>                                                           
                                                      </div>                                                       
                                                      <div class="file-field input-field col s12" id="bbb">
                                                          <div class="btn">
                                                              <span>File</span>
                                                              <input type="file" id="u_imagenURL" name="u_imagenURL">
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                              <input class="file-path validate" type="text" name="u_imagen" id="u_imagen" value="">
                                                              <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                            </div>             
                                                      </div> 
                                                      
                                                      <div id="u_error3" style="color: red; font-size: 12px; font-style: italic; padding-left: 1rem;"></div>
                                                    </div>

                                                  </div>
                                              </div>
                                          </div>
                            </div>

                  <div class="col m6 l6">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>

                            <div class="row">
                              
                              <div class="input-field col s12">
                                <i class="material-icons prefix">clear_all</i>
                                <input id="titulo" name="titulo" type="text" data-error=".errorTxt2" maxlength="200" value="">
                                <label for="titulo">Título</label>
                                <div id="u_error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem;"></div>
                              </div>
                              <div class="input-field col s12">
                                <i class="material-icons prefix">mode_edit</i>
                                <textarea id="descripcion" name="descripcion" class="materialize-textarea" lenght="200" style="height: 80px"></textarea>
                                <label for="descripcion" class="">Detalle de la oferta</label>
                              </div>    
                              <div class="input-field col s12">
                                <i class="material-icons prefix">clear_all</i>
                                <input id="titulo" name="titulo" type="text" data-error=".errorTxt2" maxlength="200" value="">
                                <label for="titulo">Descripción del botón oferta</label>
                                <div id="u_error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem;"></div>
                              </div>
                              <div class="input-field col s12">
                                <i class="material-icons prefix">clear_all</i>
                                <input id="titulo" name="titulo" type="text" data-error=".errorTxt2" maxlength="200" value="">
                                <label for="titulo">Link para la redirección</label>
                                <div id="u_error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 3rem;"></div>
                              </div>
                              <div class="input-field col s12 m6 l7">                                  
                                <p>Definir el color de fondo para el contenedor de la publicidad</p>                                  
                              </div>  
                              <div class="col s12 m6 l5">
                                <label for="color">Definir Color Fondo</label>
                                <input id="img_color" name="img_color" type="text" value="" maxlength="100">
                              </div>         
                              <div class="input-field col s12 m6 l7">                                  
                                <p>Definir el color de fondo para el botón de la oferta</p>                                  
                              </div>  
                              <div class="col s12 m6 l5">
                                <label for="color">Definir Color botón</label>
                                <input id="img_color" name="img_color" type="text" value="" maxlength="100">
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

<div id="comodin" data-valor="0" class="hiden"></div>

@endsection
  
@section('script')
    
@endsection

