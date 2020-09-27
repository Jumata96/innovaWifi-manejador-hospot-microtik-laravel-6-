<div id="modalAddCodAlt" class="modalConcepto modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
							  
							  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
								 <div class="card-header">                    
									<i class="fa fa-table fa-lg material-icons">receipt</i>
									<h2>AGREGAR CODIGO ALTERNO</h2>
								 </div>
							  </div>
							  
							  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
									  <div class="col s12 m12 herramienta">                         
										 <a id="addNewCodAltm" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
											<i class="material-icons " style="color: #2E7D32">check</i></a>
										 <a style="margin-left: 6px"></a>   
										 
										 <a   id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
											<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
									  </div>  

									  
							  </div>
													  
							  
							  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:40px; z-index: 1; margin-top: px">      
								<br><br><br><br>
									<div class="card white">
											<div class="card-content">
											  <form id="FormNewComceptoManual" accept-charset="UTF-8" enctype="multipart/form-data"> 
												<input type="hidden" name="_token" value="{{ csrf_token() }}">  
												 <div class="row">  
													 
													<div class="input-field col s12 m6 l6 offset-l3">
														<i class="material-icons prefix">account_circle</i>
													  <label for="codigoAlternoNuevo">Nuevo código alterno  </label>
													  <input id='codigoAlternoNuevo'  name='codigoAlternoNuevo' type='text'    >
													 <div id="codigoAlterno4" style="color: red; font-size: 12px; font-style: italic;"></div>
													</div> 

													
												 </div> 
											  </form>                    
											</div>
									  </div>                          
							
											

								 </div>   
							  

	</div>
	
 </div>

