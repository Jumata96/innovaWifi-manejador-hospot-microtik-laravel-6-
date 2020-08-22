@extends('layouts2.app')
@section('titulo','Tikets Asignados')

@section('main-content') 
<br>
<div class="row">
	<div class="col s12 m12 l12">
					  <div class="card">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>LISTA DE TICKETS ASIGNADOS</h2>
						 </div>
						
						 <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
								 <div class="col s12 m12">
									<a class="btn-floating waves-effect waves-light modal-trigger  grey lighten-5 tooltipped"
									href="#addTicket"
									{{--  href="{{ url('/tickets/Asignados/nuevo') }}"  --}} data-position="top" data-delay="500" data-tooltip="Nuevo">
									  <i class="material-icons" style="color: #03a9f4">add</i>
									</a>
									<a style="margin-left: 6px"></a>                          
																			  
								 </div>  
								 @include('forms.asignarTickets.addTicketsModal')
								 @include('forms.asignarTickets.modalEliminar') 
								 @include('forms.scripts.modalInformacion') 
								 
						 </div>
												 
						 <div class="row cuerpo">
							<?php 
 
							  $bandera = false;
 
							  if (count($tickets) > 0) {
								 # code...
								 $bandera = true;
								 $i = 0;
							  }
 
							?>
 
						 <br>
						 <div class="row">
							<div class="col s12 m12 l12">
							  
								 <div class="card-content">
									Existen <?php echo ($bandera)? count($tickets) : 0; ?> registros. <br><br>
									<table id="data-table-simple" class="responsive-table display" cellspacing="0">
										  <thead>
											  <tr>
												  <th>#</th> 
												  <th>Punto de Venta</th>
												  <th>Cantidad</th>
												  <th>Vendidos</th>
												  <th>Saldo</th>
												  <th>Fecha creación</th>
												  <th>Estado</th>
												  <th>Acción</th>
											  </tr>
										  </thead>
										  <?php
												 if($bandera){                                                           
											?>
										  <tfoot>
											  <tr>
												  <th>#</th> 
												  <th>Punto de Venta</th>
												  <th>Cantidad</th>
												  <th>Vendidos</th>
												  <th>Saldo</th>
												  <th>Fecha creación</th>
												  <th>Estado</th>
												  <th>Acción</th>
											  </tr>
											</tfoot>
 
										  <tbody>

											<tr>
											  <?php 
													foreach ($tickets as $datos) {
													$i++;
													$e=0;
													 
												?>
												  <td><?php echo $i; ?></td> 

												  @foreach ($zonas  as $item)
														@if ($item->id ==$datos->idzona)
														<td> {{ $item->nombre }} </td>  	 
														@endif
														
												  @endforeach
													  
												  <td><?php echo substr($datos->tickets_cant,0,30) ?></td> 
													<td><?php               ?>   </td> 
												  <td> <?php               ?>		</td>
												  <td><?php echo $datos->fecha_creacion ?></td>  
												  <td>
														@if($datos->estado == 0)
														<div id="u_estado" class="chip center-align" style="width: 70%">
																<b>NO DISPONIBLE</b>
															<i class="material-icons"></i>
														</div>
														@else
														<div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
															<b>ACTIVO</b>
															<i class="material-icons"></i>
														</div>
														@endif
												  </td>
												  <td class="center" style="width: 9rem">
													<a href="{{ url('/tickets/Asignados/mostrar') }}/{{$datos->codigo}}" target="_blank" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
														<i class="material-icons" style="color: #7986cb ">visibility</i></a>

														 

													<a href="#addTicketTrabajadores"  class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Agregar Trabajadores">
															<i class="material-icons" style="color: #7986cb ">visibility</i></a> 
												  </td>
												  
											  </tr>  
											  @include('forms.asignarTickets.addAsignarTticketsTrabajadores')  
											  

											  

											  

											  <?php }} ?>
											  
										  </tbody>
									  </table>
									</div>
							
						 </div>
 
						 </div>
					  </div>
					</div>
 </div>


 
@endsection

@section('script') 
  @include('forms.asignarTickets.scripts.addTicketsAsignados')
@endsection

 
