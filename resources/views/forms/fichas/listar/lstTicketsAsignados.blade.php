@extends('layouts2.app')
@section('titulo','Tikets Asignados')

@section('main-content') 
<br>
@foreach ($totalesEmpresa as $totales)
				
<div class="row">
	<div class="col s12 m12 l12">
					  <div class="card">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>LISTA DE TICKETS ASIGNADOS</h2>
						 </div> 
						 <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
								 <div class="col s12 m12">
									{{-- <a class="btn-floating waves-effect waves-light modal-trigger  grey lighten-5 tooltipped"
									href="#addTicket" data-position="top" data-delay="500" data-tooltip="Nuevo">
									  <i class="material-icons" style="color: #03a9f4">add</i>
									</a>
									<a style="margin-left: 6px"></a>   --}}
									 
																			  
								 </div>  
								 {{-- @include('forms.asignarTickets.addTicketsModal')
								 @include('forms.asignarTickets.modalEliminar') 
								 @include('forms.scripts.modalInformacion') 
								 @include('forms.scripts.modalInformacion') 
								 @include('forms.asignarTickets.addTicketsTrabajadores')
								 --}}
								 
						 </div>
						 <input type="hidden" id="contadorTicketsTrabajador">
						 <input type="hidden" id="contadorTipoTicketsTrabajador"> 

												 
						 <div class="row cuerpo">
							<?php 
 
							  $bandera = false;
 
							  if (count($arrayZonas) > 0) {
								 # code...
								 $bandera = true;
								 $i = 0;
							  }
 
							?>
 
						 <br>
						 <div class="row">
							<div class="col s12 m12 l12">
							  
								 <div class="card-content" style="overflow-x:scroll">
									Existen <?php echo ($bandera)? count($arrayZonas) : 0; ?> registros. <br><br>
									<table id="data-table-simple"  style="white-space: nowrap;" class="responsive-table display centered" cellspacing="0">
										@php
											$totalAsignados=0;
											$totalvendidos=0;
											$totalsaldo=0;
											$totalTickets=0;
										@endphp
										  <thead>
											  <tr>
												  <th>#</th> 
												  <th>Punto de Venta</th>
												  <th>Trabajadores</th>
												  <th>T.asignados</th> 
												  <th>T.vendidos</th>
												  <th>T.saldo</th> 
														<th>T.asignados</th> 
												  <th>T.vendidos</th>
												  <th>T.saldo</th> 
												  <th style="width: 3em;">Acción</th>
											  </tr>
										  </thead>
										  <?php
												 if($bandera){                                                           
											?> 
										  <tbody>
												<?php 
												foreach ($arrayZonas as $datos) {
												$i++; 
												
											?>

													<tr> 
														<td>{{$datos['numero']}}</td>
														<td> {{$datos['puntoVenta']}}</td> 
														<td> {{$datos['trabajadores']}}</td>  
														<td> {{$datos['asigandos']}}</td> 
														<td> {{$datos['vendido']}}</td> 
														<td> {{$datos['saldo']}}</td>  
														<td> $ {{$datos['tAsigandos']}}</td> 
														<td> $ {{$datos['tVendido']}}</td> 
														<td> $ {{$datos['tSaldo']}}</td>  
														<td> 
															 <a href="{{ url('fichasPuntoVenta') }}/{{$datos['id']}}"  class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                 <i class="material-icons" style="color: #7986cb ">visibility</i>
                </a>  
														</td>  
											  </tr>  
											  {{-- @include('forms.asignarTickets.scripts.alertaConfirmacion') 
											  @include('forms.asignarTickets.scripts.alertaConfirmacion2') 
											  @include('forms.asignarTickets.scripts.alertaConfirmacion3') 
											  @include('forms.asignarTickets.scripts.alertaConfirmacion4')  --}}



											  <?php }} ?>

											   
											  
										  </tbody>
										   <tfoot >
											  <tr style="background-color:#03a9f4" >
												  <th></th> 
												  {{-- <th> </th> --}}
												  <th  class="center">Total</th> 
												  <th>Ven: {{$totales['Trabajadores']}}</th>
														<th>Asig: {{$totales['TotalAsignados']}}</th>
														<th>Ven:{{$totales['TotalVendidos']}}</th>
														<th>Sal: {{$totales['TotalSaldo']}}</th>
														<th>$ {{$totales['TotalAsigDirero']}}</th>
														<th>$ {{$totales['TotalVendDirero']}}</th>
														<th>$ {{$totales['TotalSaldDirero']}}</th>
												  <th></th>
											  </tr>
											</tfoot> 
									  </table>
									</div>
							
						 </div>
 
						 </div>
					  </div>
					</div>
 </div>


@endforeach
 
@endsection

@section('script') 
<script>
	$('.dropdown-trigger').dropdown(); 
	$("#dropDown").dropdown();

 
	
</script>
  {{-- @include('forms.asignarTickets.scripts.addTicketsAsignados')
  @include('forms.asignarTickets.scripts.addTicketsTrabajadores')  --}}
@endsection

 
