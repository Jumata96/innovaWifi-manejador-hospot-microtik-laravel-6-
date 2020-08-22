<div id="addPPPoE" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>REGISTRAR PERFIL PPPoE</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <button id="p_add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></button>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario">
                                            <i class="material-icons ">info</i></a>
                                          <a href="#" id="p_cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  <form style="margin-top: 70px">
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">      

                                                                          
                                        <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="p_idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="p_idrouter" name="p_idrouter" data-error=".errorTxt1" > 
                                                      <option value="e" disabled="" selected="">Elija un router</option>
                                                      <option value="0">Todos</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
                                                    <div class="chip center-align" style="width: 70%">
                                                      <b>Estado:</b> No Disponible
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                                          
                                        <div class="card white">
                                            <div class="card-content" style="padding-top: 4px">                                               
                                              <span class="card-title">Datos Generales</span>
                                              <div class="row">
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix active">label_outline</i>
                                                  <input id="p_name" name="p_name" type="text" data-error=".errorTxt2">
                                                  <label for="p_name">Nombre del Plan</label>
                                                  <div id="p_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      

                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">attach_money</i>
                                                  <input id="p_precio" name="p_precio" type="number" data-error=".errorTxt3">
                                                  <label for="p_precio">Precio</label>
                                                  <div id="p_error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>    
                                                <div class="col s12 m6 l6">
                                                  <label for="p_perfil">Perfil Mikrotik</label>
                                                    <select class="browser-default" id="p_perfil" name="p_perfil" data-error=".errorTxt1" disabled=""> 
                                                      <option value="sn" disabled="" selected="">Elija un perfil</option>
                                                      <option value="0">Crear perfil</option>
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                    </select>
                                                    <div class="errorTxt1" id="p_error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      

                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">clear_all</i>
                                                  <input id="p_dsc_perfil" name="p_dsc_perfil" type="text" data-error=".errorTxt3" disabled value=" ">
                                                  <label for="p_dsc_perfil">Desc. Perfil</label>
                                                  <div id="p_error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>           
                                                <div class="col s12 m6 l6">
                                                  <label for="p_remote_address">Remote Address</label>
                                                    <select class="browser-default" id="p_remote_address" name="p_remote_address" data-error=".errorTxt1" disabled=""> 
                                                      <option value="0" disabled="" selected="">Elija un pool de ip</option>
                                                    </select>
                                                </div>      

                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">clear_all</i>
                                                  <input id="p_local_address"" name="p_local_address" type="text" data-error=".errorTxt3" disabledy>
                                                  <label for="p_local_address">Dirección local</label>                                                  
                                                </div>        
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">cloud_upload</i>
                                                  <input id="p_vsubida" name="p_vsubida" type="text" data-error=".errorTxt4">
                                                  <label for="h_vsubida">Velocidad de Subida</label>
                                                  <div id="p_error6" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>     
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">cloud_download</i>
                                                  <input id="p_vbajada" name="p_vbajada" type="text" data-error=".errorTxt5">
                                                  <label for="p_vbajada">Velocidad de descarga</label>
                                                  <div id="p_error7" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>         
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">mode_edit</i>
                                                  <textarea id="p_glosa" name="p_glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"></textarea>
                                                  <label for="glosa" class="">Comentario</label>
                                                </div>            
                                              </div> 
                                            </div>
                                        </div>       

                                    </div>   
                                  </form>

              </div>
              
            </div>

