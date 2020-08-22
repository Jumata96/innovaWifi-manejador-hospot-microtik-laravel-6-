<div id="updPPPoE" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>REGISTRAR PERFIL PPPoE</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12 herramienta">                         
                                          <button id="pu_update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></button>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario">
                                            <i class="material-icons ">info</i></a>
                                          <a href="#" id="pu_cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  <form style="margin-top: 70px">
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">      
                                      <input type="hidden" name="pu_idperfil" id="pu_idperfil" value=" ">
                                                                 
                                        <div class="card white">
                                            <div class="card-content" style="padding-top: 4px">
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="pu_idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="pu_idrouter" name="pu_idrouter" data-error=".errorTxt1" > 
                                                      <option value="sn" disabled="" selected="">Elija un router</option>
                                                      <option value="0">Todos</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
                                                    <div id="pu_estado" class="chip center-align" style="width: 70%">
                                                            <b>NO DISPONIBLE</b>
                                                          <i class="material-icons"></i>
                                                        </div>
                                                      
                                                        <div id="pu_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                                          <b>ACTIVO</b>
                                                          <i class="material-icons"></i>
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
                                                  <input id="pu_name" name="pu_name" type="text" data-error=".errorTxt2" value=" ">
                                                  <label for="pu_name">Nombre del Plan</label>
                                                  <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      

                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">attach_money</i>
                                                  <input id="pu_precio" name="pu_precio" type="text" data-error=".errorTxt3" value=" ">
                                                  <label for="pu_precio">Precio</label>
                                                  <div id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      
                                                <div class="col s12 m6 l6">
                                                  <label for="pu_perfil">Perfil Mikrotik</label>
                                                    <select class="browser-default" id="pu_perfil" name="pu_perfil" data-error=".errorTxt1" disabled=""> 
                                                      <option value="sn" disabled="" selected="">Elija un perfil</option>
                                                      <option value="0">Crear perfil</option>
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                    </select>
                                                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>      

                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">clear_all</i>
                                                  <input id="pu_dsc_perfil" name="pu_dsc_perfil" type="text" value=" " data-error=".errorTxt3" disabled>
                                                  <label for="pu_dsc_perfil">Desc. Perfil</label>
                                                  <div id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>   
                                                <div class="col s12 m6 l6">
                                                  <label for="pu_remote_address">Remote Address</label>
                                                    <select class="browser-default" id="pu_remote_address" name="pu_remote_address" data-error=".errorTxt1" disabled=""> 
                                                      <option value="0" disabled="" selected="">Elija un pool de ip</option>
                                                    </select>
                                                </div>      

                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">clear_all</i>
                                                  <input id="pu_local_address"" name="pu_local_address" type="text" data-error=".errorTxt3" disabledy>
                                                  <label for="pu_local_address">Dirección local</label>                                                  
                                                </div>       
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">cloud_upload</i>
                                                  <input id="pu_vsubida" name="pu_vsubida" type="text" data-error=".errorTxt4" value=" ">
                                                  <label for="pu_vsubida">Velocidad de Subida</label>
                                                  <div id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>     
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">cloud_download</i>
                                                  <input id="pu_vbajada" name="pu_vbajada" type="text" data-error=".errorTxt5" value=" ">
                                                  <label for="pu_vbajada">Velocidad de descarga</label>
                                                  <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>     
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons  prefix">mode_edit</i>
                                                  <textarea id="pu_glosa" name="pu_glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"> </textarea>
                                                  <label for="pu_glosa" class="">Comentario</label>
                                                </div>            
                                              </div> 
                                            </div>
                                        </div>     

                                     </div>   
                                  </form>

              </div>
              
            </div>
