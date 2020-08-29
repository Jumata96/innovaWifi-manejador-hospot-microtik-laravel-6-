 

	<div id="modalUpdate" class="addTicketTrabajadores modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
		<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9;">
								  
								  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
									 <div class="card-header">                    
										<i class="fa fa-table fa-lg material-icons">receipt</i>
										<h2>Modificar Venta</h2>
									 </div>
								  </div> 
								  
								  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
										  <div class="col s12 m12 herramienta">                         
											 <a id="upd" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
												<i class="material-icons " style="color: #2E7D32">check</i></a>
										
	 
	
											 <a   id="cerrarModalVendedores" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
												<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
										  </div>   
	
	
										  
								  </div>
	
								  <br><br><br><br>
								  <div class="card white">
									<div class="card-content">

										<div class="card white">
											<div class="card-content">

												<div class="row "   > 
													<form class="formValidate right-alert" id="myForm" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
														<div class="col s12 m6 l8 offset-l2 offset-m3 card white">
															
															<span class="card-title">Modificar Venta</span> 
															<div class="input-field col s12 m6 l6">
																{{-- <i class="material-icons prefix">cantidad</i> --}}
																<input  class="active"    id="perfilTicket" name="perfilTicket" type="text"  readonly="readonly" placeholder="">
																<label for="perfilTicket">Perfil</label>
																<div class="errorTxt1" id="errorUpadate1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div> 
															</div>   
															<div class="input-field col s12 m6 l6">
																{{-- <i class="material-icons prefix">cantidad</i> --}}
																<input  class="active"    id="cantidadTicket" name="cantidadTicket" type="number"   placeholder="" >
																<label for="cantidadTicket">cantidad</label>
																<div class="errorTxt1" id="errorUpadate" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
											
															</div> 
															<div class=" input-field col s12 m6 l6">                    
																<input  class=" input-field active"    id="precioTicket"  name="precioTicket" type="number" value="" data-error=".errorTxt2"  placeholder="" >  
																<label for="precioTicket">Precio</label> 
																<div class="errorTxt1" id="errorUpadate3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>                                                                                            
															</div>   
															<div class=" input-field col s12 m6 l6">                    
																<input  class="active"  id="codigoTicket" name="codigoTicket"   type="text" value="" data-error=".errorTxt2" maxlength="100"  placeholder="" >  
																<label for="codigoTicket">Codigo</label> 
																<div class="errorTxt1" id="errorUpadate4" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>                                                                                            
															</div> 
															<div class="input-field col s12 m12 l12"> 
																<textarea id="glosa" name="glosa" class="materialize-textarea active"  value=""  > </textarea>
																<label for="glosa" class="">Motivo del cambio </label>
																<div class="errorTxt1" id="errorUpadate5" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>  
															</div> 
															<input id="idPerfilTicket" name="idPerfilTicket"   type="hidden" value=""  > 
															<input id="idTicket" name="idTicket"   type="hidden" value=""  > 



														</div>
													</form>
													
												</div>
									
											</div>
											</div> 
										</div>
	
	
	
									 
	
								 
										 
	
	 
										  
														 
									</div> 
								</div>                         
	
									  
	
		</div>
		
	 </div>  <br> 
	  
	
	
	
 