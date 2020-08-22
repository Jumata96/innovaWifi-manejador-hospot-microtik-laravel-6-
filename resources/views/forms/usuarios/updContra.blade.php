<div id="updContra" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
                                    <div class="card-header">                    
                                      <i class="fa fa-table fa-lg material-icons">receipt</i>
                                      <h2>ACTUALIZAR CONTRASEÑA</h2>
                                    </div>
                                  </div>
                                  
                                  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
                                        <div class="col s12 m12">                         
                                          <button id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                                            <i class="material-icons " style="color: #2E7D32">check</i></button>
                                          <a style="margin-left: 6px"></a>   
                                         
                                          <a href="#" id="cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  <form style="margin-top: 70px" id="myForm2" accept-charset="UTF-8" enctype="multipart/form-data">
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; margin-top:8rem; z-index: 1"> 
                                  <input type="hidden" name="id" id="id" value="{{$datos->id}}">    
                                                                                                           
                                        <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Datos Generales</span>
                                              <div class="row">
                                                <div class="input-field col s12 m8 l6 offset-l3 offset-m2">
                                                  <i class="material-icons prefix">lock</i>
                                                  <input id="contra" name="contra" type="password">
                                                  <label for="contra">Contraseña actual</label>
                                                  <div id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>    
                                                <div class="input-field col s12 m8 l6 offset-l3 offset-m2">
                                                  <i class="material-icons prefix">lock_outline</i>
                                                  <input id="contra2" name="contra2" type="password">
                                                  <label for="contra2">Nueva contraseña</label>
                                                  <div id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>    
                                                <div class="input-field col s12 m8 l6 offset-l3 offset-m2">
                                                  <i class="material-icons prefix">lock_outline</i>
                                                  <input id="contra3" name="contra3" type="password">
                                                  <label for="contra3">Repetir contraseña nueva</label>
                                                  <div id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>           
                                              </div> 
                                            </div>
                                        </div>     

                                    </div>   
                                  </form>

              </div>
              
            </div>
s