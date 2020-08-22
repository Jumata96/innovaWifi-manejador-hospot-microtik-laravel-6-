@extends('layouts2.app')
@section('titulo','Datos para página de bienvenida')

@section('main-content')
<br>
@foreach($logout as $datos)
<div class="row">
  <div class="col s12 m7 l7">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>MANTENEDOR PÁGINA DE BIENVENIDA</h2>
                  </div>
                 <form class="formValidate right-alert" id="myForm" method="POST" action="{{ url('/vision/grabar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
                        <div class="col s12 m12">
                          <a id="addLogout" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>   
                          <a href="{{ url('/hotspot/pagina-cerrar-sesion') }}" target="_blank" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver prototipo página">
                            <i class="material-icons" style="color: #7986cb ">visibility</i>
                          </a>   
                          <a style="margin-left: 6px"></a>   
                                                        
                        </div>  
                        @include('forms.scripts.modalInformacion')                               
                  </div>
                  
                  <br>                  
                  <div class="row cuerpo col s12">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="hidden" name="id" value="">
                    <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>

                            <div class="row">
                              
                              <div class="col s12">
                                <div class="input-field col s12 m6 l8">                                  
                                  <p>Definir color para el fondo de la pagina web del detalle de estado de conexión.</p>
                                </div>
                                <div class="col s12 m6 l4">
                                  <label for="color" class="active">Definir Color</label>
                                  <input id="color_fondo" name="color_fondo" type="text" value="{{$datos->color_fondo}}" data-error=".errorTxt2" maxlength="100">                                    
                                </div>
                                <div class="input-field col s12 m6 l8">                                  
                                  <p>Definir color de fondo para el botón de navegar en internet.</p>
                                </div>
                                <div class="col s12 m6 l4">
                                  <label for="color" class="active">Definir Color</label>
                                  <input id="color_btn_iniciar" name="color_btn_iniciar" type="text" value="{{$datos->color_btn_iniciar}}" data-error=".errorTxt2" maxlength="100">                                    
                                </div>                                
                              </div>

                            </div>

                        </div>
                    </div>
                 
                </div>
              </form>
              </div>
              <a href="{{url('hotspot/pagina-cerrar-sesion')}}" target="_blank" class="btn waves-effect waves-light gradient-45deg-indigo-blue col s12" style="height: 44px; letter-spacing: .5px; padding-top: 0.3rem"><b>VER PROTOTIPO DE LA PÁGINA</b>
                <i class="mdi-content-send right"></i>
              </a>
  </div>

  <div class="col s12 m5 l5">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>PARÁMETROS</h2>
                  </div>
                
                <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                          <a id="addParametros" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar" data-tooltip-id="103dd92a-bdba-f28a-8fbe-a2f566abf2af">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>     
                          <a href="{{ url('/hotspot/pagina-cerrar-sesion') }}" target="_blank" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver prototipo página">
                            <i class="material-icons" style="color: #7986cb ">visibility</i>
                          </a>                        
                          <a style="margin-left: 6px"></a>   
                        </div>                         
                  </div>
                  
                  <form class="formValidate right-alert grey lighten-5" id="myForm2" method="POST" action="{{ url('/vision/grabar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  
                    <div class="row cuerpo-2">
                    
                      
                      <div class="card white">
                          <div class="card-content" style="padding-top: 4px">
                            <div class="row" style="padding-top: 20px">
                              <div class="col s6 m8 l10">
                                <p style="padding: 0px">Mostrar dirección IP</p>

                              </div>
                              <div class="col s6 m4 l2">
                                <div class="switch secondary-content">                     
                                  <label>     
                                    @if($datos->mostrar_ip == 1)                         
                                    <input type="checkbox" id="mostrar_ip" name="mostrar_ip" checked="">
                                    @else
                                    <input type="checkbox" id="mostrar_ip" name="mostrar_ip">
                                    @endif
                                    <span class="lever"></span> 
                                  </label>
                                </div>
                              </div>
                            </div>
                                                                   
                          </div>
                      </div>  
                      <div class="card white">
                          <div class="card-content" style="padding-top: 4px">
                            <div class="row" style="padding-top: 20px">
                              <div class="col s6 m8 l10">
                                <p style="padding: 0px">Mostrar MAC</p>

                              </div>
                              <div class="col s6 m4 l2">
                                <div class="switch secondary-content">                     
                                  <label>   
                                    @if($datos->mostrar_mac == 1)                                                    
                                    <input type="checkbox" id="mostrar_mac" name="mostrar_mac" checked="">
                                    @else
                                    <input type="checkbox" id="mostrar_mac" name="mostrar_mac">
                                    @endif
                                    <span class="lever"></span> 
                                  </label>
                                </div>
                              </div>
                            </div>
                                                                   
                          </div>
                      </div>  
                      <div class="card white">
                          <div class="card-content" style="padding-top: 4px">
                            <div class="row" style="padding-top: 20px">
                              <div class="col s6 m8 l10">
                                <p style="padding: 0px">Mostrar up/down </p>

                              </div>
                              <div class="col s6 m4 l2">
                                <div class="switch secondary-content">                     
                                  <label>      
                                    @if($datos->mostrar_up_down == 1)                             
                                    <input type="checkbox" id="mostrar_up_down" name="mostrar_up_down" checked="">
                                    @else
                                    <input type="checkbox" id="mostrar_up_down" name="mostrar_up_down">
                                    @endif
                                    <span class="lever"></span> 
                                  </label>
                                </div>
                              </div>
                            </div>
                                                                   
                          </div>
                      </div>  
                     <div class="card white">
                          <div class="card-content" style="padding-top: 4px">
                            <div class="row" style="padding-top: 20px">
                              <div class="col s6 m8 l10">
                                <p style="padding: 0px">Mostrar tiempo de conexión</p>

                              </div>
                              <div class="col s6 m4 l2">
                                <div class="switch secondary-content">                     
                                  <label>        
                                    @if($datos->mostrar_tiempo_con == 1)                                                                          
                                    <input type="checkbox" id="mostrar_tiempo_con" name="mostrar_tiempo_con" checked="">
                                    @else
                                    <input type="checkbox" id="mostrar_tiempo_con" name="mostrar_tiempo_con">
                                    @endif
                                    <span class="lever"></span> 
                                  </label>
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
  @include('forms.hotspot.scripts.addLogout')  
  @include('forms.hotspot.scripts.addParametrosLogout')  
@endsection

