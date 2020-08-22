@extends('layouts2.app')
@section('titulo','Registrar Ususario')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRAR USUARIO</h2>
                  </div>
                  <form class="formValidate right-alert" id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons blue-text text-darken-2">check</i></a>
                          <a style="margin-left: 6px"></a>   
                          
                          <a href="{{url('/usuarios')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    <div class="col s12 m7 l8">
                      
                    
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="card white">
                          <div class="card-content">
                              <span class="card-title">Generales</span>

                              <div class="row">
                                <div class="col s12 m6 l6">
                                  <label for="idtipo">Tipo usuario</label>                 
                                  <select class="browser-default" onchange="elegirTipoUsuario(this)" id="idtipo" name="idtipo" required>
                                    <option data-parametro4='SEL'value="" disabled selected="">Seleccione</option>                                    
                                    <option data-parametro4='ADM' value="ADM">Administrador</option>    
                                    <option data-parametro4='VEN' value="VEN">Vendedor</option>                                      
                                  </select>
                                  <div class="errorTxt1" id="error8" style="color: red; font-size: 8px; font-style: italic;"></div> 
                                </div>
                                <div class="col s12 m6 l6" id="divZona" style="display: none;">
                                  <label for="zonas">Puntos de Venta</label>
                                  <select class="browser-default" id="zonas" name="zonas" required>
                                    <option value="" disabled selected="">Seleccione</option>
                                    @foreach($zonas as $zn)
                                    <option value="{{$zn->id }}">{{$zn->nombre}}</option>
                                    @endforeach
                                  </select> 
                                  <div class="errorTxt1" id="error10" style="color: red; font-size: 8px; font-style: italic;"></div> 
                                </div>
                                <div class="col s12 m6 l6">
                                  <label for="idempresa">Empresa</label>                 
                                  <select class="browser-default" id="idempresa" name="idempresa" required>
                                    <option value="" disabled selected="">Seleccione</option>
                                    @foreach($empresa as $datos)
                                    <option value="{{$datos->idempresa}}"> {{$datos->razon_social}}</option>
                                    @endforeach
                                  </select>
                                  <div class="errorTxt1" id="error9" style="color: red; font-size: 8px; font-style: italic;"></div> 
                                </div>
                                <div class="col s12 m6 l6">
                                  <label for="iddocumento">Tipo documento</label>  
                                  <select class="browser-default" id="iddocumento" name="iddocumento" required> 
                                    <option value="" disabled selected="">Seleccione</option>
                                    @foreach($tipo_documento as $documento)
                                    <option value="{{$documento->iddocumento}}">{{$documento->dsc_corta}} - {{$documento->descripcion}}</option> 
                                    @endforeach                                                                                  
                                  </select>
                                </div>                                
                                <div class="input-field col s12 m6 l6">
                                  <i class="material-icons prefix active">label_outline</i>
                                  <input id="nro_documento" name="nro_documento" type="text" data-error=".errorTxt1" minlength="8" maxlength="11">
                                  <label for="nro_documento">Nro. doc. Identidad</label>
                                  <div id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                </div>   
                                <div class="input-field col s12 m6 l6">
                                  <i class="material-icons prefix">clear_all</i>
                                  <input id="cargo" name="cargo" type="text" data-error=".errorTxt2" maxlength="50" onkeyup="mayus(this);">
                                  <label for="cargo">Cargo</label>
                                  <div id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                </div> 
                                <div class="input-field col s12 m6 l6">
                                  <i class="material-icons prefix">account_circle</i>
                                  <input id="nombre" name="nombre" type="text" data-error=".errorTxt4" maxlength="50" onkeyup="mayus(this);">
                                  <label for="nombre">Nombres</label>
                                  <div id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                </div>   
                                <div class="input-field col s12 m6 l6">
                                  <i class="material-icons prefix">account_circle</i>
                                  <input id="apellidos" name="apellidos" type="text" maxlength="50" onkeyup="mayus(this);">
                                  <label for="apellidos">Apellidos</label>
                                  <div id="error4" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                </div>   
                               
                                <div class="input-field col s12 m6 l6">
                                  <i class="material-icons prefix">call</i>
                                  <input id="telefono" name="telefono" type="text" maxlength="20">
                                  <label for="telefono">Telefono</label>
                                </div>    
                                <div class="input-field col s12 m6 l6">
                                  <i class="material-icons prefix">mode_edit</i>
                                  <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" value="" style="height: 84px"></textarea>
                                  <label for="glosa" class="">Comentario</label>
                                </div>                              
                              </div>

                          </div>
                      </div>
                    </div>

                    <div class="col s12 m5 l4">

                      <div class="card white">
                          <div class="card-content">
                              <span class="card-title">Datos de Acceso</span>

                              <div class="row">                             
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">face</i>
                                  <input id="usuario" name="usuario" type="text" data-error=".errorTxt3" maxlength="20">
                                  <label for="usuario">Usuario</label>
                                  <div id="error5" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                </div>
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">email</i>
                                  <input id="email" name="email" type="text">
                                  <label for="email">Email</label>
                                  <div id="error6" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                </div>  
                                
                                

                                <div class="input-field col s12">
                                  <i class="material-icons prefix">lock_outline</i>
                                  <input id="password" name="password" type="password">
                                  <label for="password">contaseña</label>
                                  <div id="error7" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                </div>     
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">lock_outline</i>
                                  <input id="password_confirmation" name="password_confirmation" type="password">
                                  <label for="telefono">Repetir contraseña</label>
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
  @include('forms.usuarios.scripts.validacion')
  @include('forms.usuarios.scripts.addUsuario')
@endsection
