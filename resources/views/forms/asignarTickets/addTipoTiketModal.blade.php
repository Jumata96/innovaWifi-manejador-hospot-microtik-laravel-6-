



 <div id="modalAddPlan" class="modal modal-fixed-footer"> 
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
							  
							  <div class="card" style="position: fixed; width: 100%; z-index: 2">                 
								 <div class="card-header">                    
									<i class="fa fa-table fa-lg material-icons">receipt</i>
									<h2>TIPOS DE TICKETS</h2>
								 </div>
							  </div> 	
							  <div class="row card-header sub-header" style="margin-top: 48px; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
								<div class="col s12 m12 herramienta">   
									<center><h5>Tipo de Ticket</h5></center>  
								</div>  
								@include('forms.scripts.modalInformacion')  
							</div> 
							  
							  <form style="margin-top: 70px"> 

								<div class="row cuerpo">
									<?php 
									  $bandera = false;
		 
									  if (count($perfiles) > 0) {
										 # code...
										 $bandera = true;
										 $i = 0;
									  }
									?>
								 <br>
									<div class="col s12 m12 l12">
									  
										 <div class="card-content"> 
											<table   class="responsive-table display tabla" cellspacing="0">
												  <thead>
													  <tr> 
														  <th>Cantidad</th>
														  <th>Router</th>
														  <th>Desc. Perfil</th>
														  <th>Precio</th>
														  <th>Target</th> 
														                          
															
														  <th class="center">Acciones</th>
													  </tr>
												  </thead> 
												  <?php
														 if($bandera){                                                           
													?> 
		 
												  <tbody>
													<?php 
															foreach ($perfiles as $valor) {
															$i++;
														?>
													<tr id="ptr{{$valor->idperfil}}"> 

														  <td> <input name="cant{{$valor->idperfil}}" type="number" value="0"></td>
														  <td>
															@foreach($router as $rou) 
															  @if($rou->idrouter == $valor->idrouter)
																 {{$rou->alias}}
															  @endif
															@endforeach    
														  </td>
														  <td id="nombre"><?php echo $valor->name ?></td>
														  <td><?php echo $valor->precio ?></td>
														  <td><?php echo $valor->rate_limit ?></td>
															
														  <td class="center" style="width: 9rem"> 
																	<a  class="btnSeleccionar btn-floating waves-effect waves-light grey lighten-5 tooltipped " data-tooltip="Seleccionar"  data-id="{{$valor->idperfil}}"  data-idrouter="{{$valor->idrouter}}" data-target="{{$valor->rate_limit}}" data-name="{{$valor->name}}" data-vbajada="{{$valor->vbajada}}" data-precio="{{$valor->precio}}" data-vsubida="{{$valor->vsubida}}"><i class="material-icons " style="color: #2E7D32">check</i></a>  
														  </td>

														 
													  </tr> 
													  <?php }} ?>
												  </tbody>
											  </table>
											</div>                     
								 </div>
		 
							  </div>

							  
								


							  </form> 
	</div>
	 









</div>
  