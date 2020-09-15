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
								 @include('forms.scripts.modalInformacion') 
								 @include('forms.asignarTickets.addTicketsTrabajadores')
								
								 
						 </div>
						 <input type="hidden" id="contadorTicketsTrabajador">
						 <input type="hidden" id="contadorTipoTicketsTrabajador"> 

												 
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
							  
								 <div class="card-content" style="overflow-x:scroll">
									Existen <?php echo ($bandera)? count($tickets) : 0; ?> registros. <br><br>
									<table id="data-table-simple"  style="white-space: nowrap;" class="responsive-table display centered" cellspacing="0">
										  <thead>
											  <tr>
												  <th>#</th> 
												  <th>Punto de Venta</th>
												  <th>Detalle</th>
												  <th>Cantidad</th>
												  <th>Asignados</th>
												  <th>Vendidos</th>
												  <th>Saldo</th>
												  <th >Fecha creación</th>
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
												  <th>Detalle</th>
												  <th>Cantidad</th>
												  <th>Asignados</th>
												  <th>Vendidos</th>
												  <th>Saldo</th>
												  <th >Fecha creación</th>
												  <th>Estado</th>
												  <th>Acción</th>
											  </tr>
											</tfoot>
 
										  <tbody>
												<?php 
												foreach ($tickets as $datos) {
												$i++; 
												
											?>

											<tr> 
												  <td style="width:4ex">{{ $i }}</td> 

												  @foreach ($zonas  as $item)
														@if ($item->id ==$datos->idzona)
														<td style="width:7ex" > {{ $item->nombre }} </td>  	 
														@endif
														
												  @endforeach
												  <td style="width:3em" > {{ $datos->descripcion }} </td>
													  
												  <td style="width:3ex"><?php echo substr($datos->tickets_cant,0,30) ?></td> 
												  <td style="width:3ex">
													<?php  $totaAsig=0 ?>
													@foreach ($tickets_Asig as $asig)
													  @if ($datos->codigo==$asig->codigo)
														<?php  $totaAsig +=$asig->cantidad ?> 
													  @endif   
													@endforeach
													{{$totaAsig}} 
												   </td> 
												  <td style="width:3ex">
													<?php  $total=0 ?>
													@foreach ($tickets_Venta as $venta)
													  @if ($datos->codigo==$venta->codigo)
														<?php  $total +=$venta->cantidad ?> 
													  @endif   
													@endforeach
													{{$total}} 
												   </td> 
												  <td style="width:2ex">
														<?php  $saldo;  $saldo =$datos->tickets_cant-$total ?> 
														{{$saldo}} 
												  </td>
												  
												  <td style="width:5ex"> {{ date("Y-m-d", strtotime($datos->fecha_creacion))}} </td>  
												  <td  style="width:8ex" >
														@if($datos->estado == 0)
															<div id="u_estado" class="chip center-align" style="width: 85%">
																	<b>NO DISPONIBLE</b>
																<i class="material-icons"></i>
															</div>
														@elseif($datos->estado == 3) 
															<div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 85%">
																<b>VENDIDO</b>
																<i class="material-icons"></i>
															</div> 
														@else
															<div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 85%">
																<b>ACTIVO</b>
																<i class="material-icons"></i>
															</div>
														@endif
												  </td>
												  </td>
												  <td class="center" style="width: 10em">
													<a href="{{ url('/tickets/Asignados/mostrar') }}/{{$datos->codigo}}" target="_blank" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
														<i class="material-icons" style="color: #7986cb ">visibility</i></a>

														 <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
															<i class="material-icons" style="color: #dd2c00">remove</i>
															</a>
															@if($datos->estado == 1)                                      
															<a href="#h_confirmacion2{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
															<i class="material-icons" style="color: #757575 ">clear</i></a>
															@elseif($datos->estado == 3)
															@else 
															<a href="#h_confirmacion3{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
															<i class="material-icons" style="color: #2e7d32 ">check</i></a>
															@endif  
															@if ($datos->tickets_cant==$totaAsig)
															<a  class="btnVerTrabajador btn-floating waves-effect waves-light grey lighten-5 tooltipped  " 
																data-idTicket="{{$datos->codigo}}" 
																data-idzona="{{$datos->idzona}}" 
																data-tooltip="Ver Trabajadores Asignados" 
																><i class="material-icons " style="color: #ffd54f">autorenew</i></a> 
																@if ($datos->estado != 3)
																<a href="#confirmacion4{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
																<i class="material-icons" style="color: #dd2c00">done_all</i>
																</a>
																 
																@endif  
															@else
															<a  class="btnSeleccionarTrabajador btn-floating waves-effect waves-light grey lighten-5 tooltipped  " 
															data-idTicket="{{$datos->codigo}}" 
															data-idzona="{{$datos->idzona}}" 
															data-tooltip="Asignar Trabajadores" 
															><i class="material-icons " style="color: #ffd54f">autorenew</i></a> 
															@endif
															 
												  </td> 
											  </tr>  
											  @include('forms.asignarTickets.scripts.alertaConfirmacion') 
											  @include('forms.asignarTickets.scripts.alertaConfirmacion2') 
											  @include('forms.asignarTickets.scripts.alertaConfirmacion3') 
											  @include('forms.asignarTickets.scripts.alertaConfirmacion4') 



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
  @include('forms.asignarTickets.scripts.addTicketsTrabajadores') 
@endsection

 
