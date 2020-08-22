<div id="mntPost" class="modal modal-fixed-footer" style="height: 100%">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: auto">
                

                  
                                  <div class="row cabecera" style="margin-left: 0rem; margin-right: 0rem">                 
                                    <div class="col s12 m12 l12">
                                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                                      <h4 class="header2" style="margin: 10px 0px;"><b>Registrar Post</b></h4>  
                                    </div>
                                  </div>
                                  <form>
                                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-left: 0rem; margin-right: 0rem">
                                        <div class="col s12 m12 herramienta">                         
                                          <button id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-close" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar"><i class="mdi-navigation-check" style="color: #2E7D32"></i></button>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario"><i class="mdi-action-info"></i></a>
                                          <a href="{{url('/router')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar"><i class="mdi-hardware-keyboard-tab" style="color: #424242"></i></a>            
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem">
                                    
                                    
                                      <div class="row">
                                        <div class="input-field col s12 s12 m6 l6">
                                          <i class="mdi-maps-local-offer prefix active"></i>
                                          <input id="titulo" name="titulo" type="text">
                                          <label for="titulo">Título</label>
                                        </div>

                                        <div class="input-field col s12 s12 m6 l6">
                                          <i class="mdi-maps-local-offer prefix"></i>
                                          <input id="comentario" name="comentario" type="text">
                                          <label for="comentario">Comentario</label>
                                        </div>                        
                                      </div>                     
                                      
                                                     
                                  </div>
                                  </form>
                            
                


              </div>
              
            </div>