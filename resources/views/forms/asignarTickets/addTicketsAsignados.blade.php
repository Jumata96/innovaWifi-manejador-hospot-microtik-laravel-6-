@extends('layouts2.app')
@section('titulo','Registrar Zona')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l10 offset-l1">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>ASIGNAR TICKETS</h2>
                  </div>
                  <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                            
                            <i class="material-icons blue-text text-darken-2">check</i></a>
                          <a style="margin-left: 6px">   </a>   
                          
                          <a href="{{url('/tickets/Asignar')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div> 

                             
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="col col s12 m10 l8 offset-m2 offset-l2">
                      <div class="card white">
                        <div class="card-content">
                            <span class="card-title">Datos Generales</span>

                            <div class="row">
                              <div class="input-field col s12 m6 l6 ">
                                <i class="material-icons prefix active">label_outline</i>
                                <input id="idzona" name="idzona" type="text"   maxlength="3" onkeyup="mayus(this);">
                                <label for="idzona">Cod.Zona</label>
                                <div id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                              </div>   
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">assignment</i>
                                <input id="nombre" name="nombre" type="text" data-error=".error2" maxlength="200" >
                                <label for="nombre"> Nombre Zona</label>
                                <div id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                              </div>       
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">description</i>
                                <input id="descripcion" name="descripcion" type="text"  maxlength="20" onkeyup="mayus(this);">
                                <label for="descripcion">Descripción</label>
                                 
                              </div>

                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">assignment</i>
                                <input id="dsCorta" maxlength="4" name="dsCorta" type="text" data-error=".errorTxt4" >
                                <label for="dsCorta">Ds.Corta</label>
                                <div class="error3"></div>
                              </div>    
                              <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">comment</i>
                                <label for="glosa">Glosa</label>
                                <textarea  class="materialize-textarea" name="glosa" rows="1" cols="2"> 
                                </textarea>
                                 
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

  