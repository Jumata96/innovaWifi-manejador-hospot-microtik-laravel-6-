<div id="addTicket" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9;">
							  
							  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
								 <div class="card-header">                    
									<i class="fa fa-table fa-lg material-icons">receipt</i>
									<h2>ASIGNAR TICKETS</h2>
								 </div>
							  </div>
							  <?php  $contador = 0;   ?>
							  
							  <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
									  <div class="col s12 m12 herramienta">                         
										 <a id="addTickets" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
											<i class="material-icons " style="color: #2E7D32">check</i></a>
										 <a style="margin-left: 6px"></a> 

										 <a class=" btn-floating waves-effect waves-light grey btn  lighten-5  modal-trigger tooltipped" href="#modalAddPlan"  data-position="top" data-tooltip="AGREGAR PLAN DE INTERNET" >
											<i class="material-icons " style="color: #03a9f4">add</i>
										</a>

										 <a   id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
											<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
									  </div>   


									  
							  </div>
							     
													  
							  <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

							  
								<div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">      
										
										<div class="card white">
											<div class="card-content">
												<div class="row"> 
													
													<div class="col s12 m6 l6">
														<label for="puntoDeVenta">Puntos de Venta</label>                 
														<select class="browser-default" id="puntoDeVenta" name="puntoDeVenta" required>
														<option value="" disabled selected="">Seleccione</option>
														@foreach($zonas as $datos)
														<option value="{{$datos->id}}"> {{$datos->nombre}}</option>
														@endforeach
														</select>
														<div class="errorTxt1" id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
													</div>
													<div class="input-field col s12 m6 l6">
														<i class="material-icons prefix">assignment</i>
														<input id="cantidad" name="cantidad" type="number" style="text-align: center" data-error=".error2"    >
														<label for="cantidad"> Cantidad</label>
														<div class="errorTxt1" id="error10" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
													</div> 
													<div class="input-field col s12 m12 l12">
														<i class="material-icons prefix">comment</i>
														<label for="glosa">Glosa</label>
														<textarea  class="materialize-textarea" name="glosa" > 
														</textarea>
														<div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
														
													</div> 
												</div>                     
											</div> 
										</div> 
										<div class="card white">
											<div class="card-content" style="padding-bottom: 5px; padding-top: 10px">                                               
												<span class="card-title">Detalle</span>
		
												<table id="tableProformaDetalle" class="responsive-table display" cellspacing="0">
													<thead>
														<tr >
															<th class="center">#</th>  
															<th class="center">Tipo de Ticket</th> 
															<th class="center">Precio</th>
															<th class="center">Cantidad</th>  
															<th class="center">Acciones</th>
														</tr>
													</thead>
													 
													<tfoot>
														<tr >
															<th class="center">#</th>  
															<th class="center">Tipo de Ticket</th> 
															<th class="center">Precio</th>
															<th class="center" >Cantidad</th>  
															<th class="center" >Acciones</th>
														</tr>
													</tfoot>
			
													<tbody >  
														<tr id="detalleB">
															<td colspan="5" style="text-align: center; text: red;" > <H5 > Agregar    Concepto</H5> </td>   
														</tr>
														
													</tbody>
												</table>
								
								
										 
												  
												 
											</div>
										</div>                          
	
									</div>  
								 
								</form>
							  

	</div>
	
 </div>  
@include('forms.asignarTickets.addTipoTiketModal')
  


