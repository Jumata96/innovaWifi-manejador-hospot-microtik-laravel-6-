<div id="updTipoAcceso" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="row cabecera" style="margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">                 
                                    <div class="col s12 m12 l12">
                                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                                      <h4 class="header2" style="margin: 10px 0px;"><b>Actualizar Tipo de Acceso</b></h4>  
                                    </div>
                                  </div>
                                  
                                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-top: 40px; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 2">
                                        <div class="col s12 m12 herramienta">                         
                                          <button id="update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar"><i class="mdi-navigation-check" style="color: #2E7D32"></i></button>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario"><i class="mdi-action-info"></i></a>
                                          <a href="#" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" id="u_cerrar" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar"><i class="mdi-hardware-keyboard-tab" style="color: #424242"></i></a>            
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  <form style="margin-top: 40px">
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">      

                                      <div class="row">                                        
                                        <div class="card white">
                                            <div class="card-content" style="padding-top: 4px">
                                              <span class="card-title">Datos Generales</span>
                                                <div class="row">
                                                  <div class="input-field col s12 m6 l6">
                                                    <i class="mdi-toggle-radio-button-off prefix active"></i>
                                                    <input id="u_idtipo" name="u_idtipo" type="text" class="validate" placeholder="" maxlength="3" minlength="1" disabled="">
                                                    <label for="u_idtipo" class="active">Cod. Tipo de Acceso</label>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
                                                    <div id="u_estado" class="chip center-align" style="width: 70%">
                                                      <b>Estado:</b> NO DISPONIBLE
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                    <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                                      <b>Estado:</b> ACTIVO
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>  
                                                <div class="row">
                                                  <div class="input-field col s12 s12 m6 l6">
                                                    <i class="mdi-editor-mode-edit prefix active"></i>
                                                    <input id="u_descripcion" name="u_descripcion" type="text" placeholder="">
                                                    <label for="u_descripcion">Descripción</label>
                                                    <div id="u_error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 45px"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6">
                                                    <i class="mdi-editor-format-strikethrough prefix active"></i>
                                                    <input id="u_dsc_corta" name="u_dsc_corta" type="text" placeholder="" maxlength="3" minlength="1">
                                                    <label for="u_dsc_corta">Desc. Corta</label>
                                                  </div>
                                                </div>    
                                                <div class="row">
                                                  <div class="input-field col s12 m6 l6">
                                                  <i class="mdi-content-sort prefix"></i>
                                                  <textarea id="u_glosa" name="u_glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"></textarea>
                                                  <label for="u_glosa" class="">Comentario</label>
                                                </div>     
                                                </div>                       
                                            </div>
                                        </div>                                        
                                      </div>                              
                                    </div> 
                                  </form>

              </div>
              
            </div>

