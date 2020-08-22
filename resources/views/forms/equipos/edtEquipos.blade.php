@extends('layouts2.app')
@section('titulo','Registro de Equipo')

@section('main-content')
<br>
@foreach($equipos as $valor)
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRAR EQUIPO</h2>
                  </div>
                  
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">                         
                          <button id="updEquipo" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons blue-text text-darken-2">check</i></button>
                          <a style="margin-left: 6px"></a>   
                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario">
                            <i class="material-icons">info</i></a>
                          <a href="{{url('/equipos')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
    <div class="row cuerpo">
      <div class="col s12 m12 l12">
          <div class="card white">
            <div class="card-content">
              <div class="row">
                <div class="col s12 m6 l6">
                <label for="idgrupo">Grupo</label>
                <select class="browser-default" id="idgrupo" name="idgrupo" data-error=".errorTxt1" > 
                  <option value="" disabled="">Elija un grupo</option>
                  @foreach($grupo as $val)
                    @if($val->idgrupo == $valor->idgrupo)
                      <option value="{{$val->idgrupo}}" selected="">{{$val->descripcion}}</option>
                    @else
                      <option value="{{$val->idgrupo}}">{{$val->descripcion}}</option>
                    @endif
                  @endforeach                                                      
                </select>
                <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
              </div>

              <div class="input-field col s12 s12 m6 l6 right-align">
                @if($valor->estado == 0)
                <div id="u_estado" class="chip center-align" style="width: 70%">
                  <b>Estado:</b> <b>NO DISPONIBLE</b>
                  <i class="material-icons"></i>
                </div>
                @else
                <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                  <b>Estado:</b>    <b>ACTIVO</b>
                  <i class="material-icons"></i>
                </div>
                @endif
              </div> 
            </div>                     
          </div>
        </div>       
    </div>
      <div class="col s12 m12 l6">                        
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idequipo" value="{{ $valor->idequipo }}">
                    <div class="card white">
                        <div class="card-content">
                          <span class="card-title">Datos generales</span>

                          <div class="row">
                            <div class="col s12 m6 l6">
                              <label for="idmarca">Marca</label>
                              <select class="browser-default" id="idmarca" name="idmarca" data-error=".errorTxt1"> 
                                <option value="" disabled="">Elija una marca</option>
                                @foreach($marca as $val)
                                  @if($val->idmarca == $valor->idmarca)
                                    <option value="{{$val->idmarca}}" selected="">{{$val->descripcion}}</option>
                                  @else
                                    <option value="{{$val->idmarca}}">{{$val->descripcion}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <div class="errorTxt1" id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div>
                            <div class="col s12 m6 l6">
                              <label for="idmodelo">Modelo</label>
                              <select class="browser-default" id="idmodelo" name="idmodelo" data-error=".errorTxt1"> 
                                <option value="" disabled="">Elija un modelo</option>
                                @foreach($modelo as $val)                                  
                                  @if($val->idmodelo == $valor->idmodelo)
                                    <option value="{{$val->idmodelo}}" selected="">{{$val->descripcion}}</option>
                                  @else
                                    <option value="{{$val->idmodelo}}">{{$val->descripcion}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <div class="errorTxt1" id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div>                 
                          </div>                     
                          <div class="row">                            
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">clear_all</i>
                              <input id="descripcion" name="descripcion" type="text" data-error=".errorTxt4" value="{{$valor->descripcion}}">
                              <label for="descripcion">Descripcion</label>
                              <div class="errorTxt4" id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div> 
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">picture_in_picture</i>
                              <input id="serie_equipo" name="serie_equipo" type="text" data-error=".errorTxt4" value="{{$valor->serie_equipo}}">
                              <label for="serie_equipo">Nº de serie del equipo</label>
                              <div class="errorTxt4"></div>
                            </div>      
                            <div class="col s12 m6 l6">
                              <label for="iddocumento">Documento</label>
                              <select class="browser-default" id="iddocumento" name="iddocumento" data-error=".errorTxt1" value="{{$valor->iddocumento}}"> 
                                <option value="" disabled="">Elija un documento</option>
                                @foreach($documento as $val)
                                  @if($val->iddocumento == $valor->iddocumento)
                                    <option value="{{$val->iddocumento}}" selected="">{{$val->descripcion}}</option>
                                  @else
                                    <option value="{{$val->iddocumento}}">{{$val->descripcion}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div>

                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">picture_in_picture</i>
                              <input id="numero_serie" name="numero_serie" type="text" data-error=".errorTxt4" value="{{$valor->numero_serie}}">
                              <label for="numero_serie">Nº de serie</label>
                              <div class="errorTxt4"></div>
                            </div>   
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">insert_invitation</i>
                              <input id="fecha_ingreso" name="fecha_ingreso" type="text" data-error=".errorTxt3" value="{{date_format(date_create($valor->fecha_ingreso),'d/m/Y')}}">
                              <label for="fecha_ingreso">Fecha Ingreso</label>
                              <div class="errorTxt3"></div>
                            </div>

                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">attach_money</i>
                              <input id="precio" name="precio" type="text" data-error=".errorTxt4" value="{{$valor->precio}}">
                              <label for="precio">Precio</label>
                              <div class="errorTxt4" id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div>                        
                          </div>
                  </div>
                </div>
      </div>
      <div class="col s12 m12 l6">                      
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card white">
                        <div class="card-content">
                          <span class="card-title">Datos técnicos</span>
                          <div class="row">
                            <div class="col s12 m6 l6">
                              <label for="idmodo">Modo equipo</label>
                              <select class="browser-default" id="idmodo" name="idmodo" data-error=".errorTxt1" > 
                                <option value="" disabled="">Elija un grupo</option>
                                @foreach($modo as $val)
                                  @if($val->idmodo == $valor->idmodo)
                                    <option value="{{$val->idmodo}}" selected="">{{$val->descripcion}}</option>
                                  @else
                                    <option value="{{$val->idmodo}}">{{$val->descripcion}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                            </div>
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">perm_scan_wifi</i>
                              <input id="SSID" name="SSID" type="text" value="{{$valor->SSID}}">
                              <label for="SSID">SSID</label>
                            </div>        
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">settings_ethernet</i>
                              <input id="ip" name="ip" type="text" data-error=".errorTxt5" value="{{$valor->ip}}">
                              <label for="ip">Dirección IP</label>
                              <div class="errorTxt5"></div>
                            </div>     
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">blur_linear</i>
                              <input id="mac" name="mac" type="text" data-error=".errorTxt6" value="{{$valor->mac}}">
                              <label for="mac">MAC</label>
                              <div class="errorTxt6"></div>
                            </div>         
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">person</i>
                              <input id="usuario" name="usuario" type="text" value="{{$valor->usuario}}">
                              <label for="usuario">Usuario</label>
                            </div>     
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">lock_outline</i>
                              <input id="contrasena" name="contrasena" type="text" value="{{$valor->contrasena}}">
                              <label for="contrasena">Contraseña</label>
                            </div>        
                            <div class="input-field col s12 m6 l6">
                              <i class="material-icons prefix">mode_edit</i>
                              <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;">{{$valor->glosa}}</textarea>
                              <label for="glosa" class="">Comentario</label>
                            </div>            
                          </div>
                  </div>
                </div>
      </div>

    </div>
                  
              </div>
  </div>
</div>
@endforeach
<br><br><br><br><br>
@endsection

@section('script')
  @include('forms.equipos.scripts.equipos')       
  @include('forms.equipos.scripts.updEquipo')                          
@endsection
