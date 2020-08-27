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
						
						 <div class="row card-header sub-header">
							<div class="col s12 m12 herramienta">                         
							  <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
								 <i class="material-icons blue-text text-darken-2">check</i></a>
							  <a style="margin-left: 6px"></a>   
							  
							  <a href="{{url('/tickets/Asignar')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
								 <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
							</div>  

								  
							
					</div>

					@foreach ($tickets as $ticket)
						 
					
												 
						 <div class="row cuerpo">
						 
						 <br>
						 <div class="card white">
							<div class="card-content">
								<div class="row">  
									<div class="col s12 m6 l6">
										<label for="puntoDeVenta">Puntos de Venta</label>                 
										<select class="browser-default" id="puntoDeVenta" name="puntoDeVenta" required>
										  <option value="" disabled selected="">Seleccione</option>
										  @foreach($zonas as $val)
										  @if($val->id == $ticket->idzona)
											 <option value="{{$val->id}}" selected> {{$val->nombre}}</option>
										  @endif
										  @endforeach
										  @foreach($zonas as $val)
										  @if($val->id != $ticket->idzona)
											 <option value="{{$val->id}}"> {{$val->nombre}}</option>
										  @endif
										  @endforeach
										</select>
										<div class="errorTxt1" id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
									 </div>


									<div class="input-field col s12 m6 l6">
										<i class="material-icons prefix">assignment</i>
										<input id="cantidad" name="cantidad" type="number" value="{{ $ticket->tickets_cant }}" style="text-align: center" data-error=".error2"  readonly="readonly" >
										<label for="cantidad"> Cantidad</label>
										<div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
									</div> 
									<div class="input-field col s12 m12 l12">
										<i class="material-icons prefix">comment</i>
										<label for="glosa">Glosa</label>
										<textarea  class="materialize-textarea" name="glosa" > 
										</textarea>
										<div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
										
									</div> 
								</div>  
								<div class="row cuerpo">
									<?php 
		 
									  $bandera = false;
		 
									  if (count($ticketsDet) > 0) {
										 # code...
										 $bandera = true;
										 $i = 0;
									  }
		 
									?>
		 
								 <br>
								 <div class="row">
									<div class="col s12 m12 l12">
									  
										 <div class="card-content">
											Existen <?php echo ($bandera)? count($ticketsDet) : 0; ?> registros. <br><br>
											<table id="data-table-simple" class="responsive-table display centered" cellspacing="0">
												  <thead>
													  <tr>
														  <th>#</th> 
														  <th>Perfil</th>
														  <th>Precio</th>
														  <th>Cantidad</th>
														  <th>Asignados</th>
														  <th>Ventas</th>
														  <th>Saldo</th>  
														 {{--  <th>Acción</th> --}}
													  </tr>
												  </thead>
												  <?php
														 if($bandera){                                                           
													?>
												  <tfoot>
													  <tr>
														  <th>#</th> 
														  <th>Perfil</th>
														  <th>Precio</th>
														  <th>Cantidad</th>
														  <th>Asignados</th>
														  <th>Ventas</th>
														  <th>Saldo</th> 
														  {{-- <th>Acción</th> --}}
													  </tr>
													</tfoot>
		 
												  <tbody>
													<tr>
													  <?php 
															foreach ($ticketsDet as $datos) {
															$i++; 
															 
														?>
														  <td><?php echo $i; ?></td>
															
														  <td>
															  @foreach ($perfiles as $perfil)
																	 @if ($perfil->idperfil==$datos->idperfil )
																	 {{ $perfil->name }} 
																  	@endif
																	
															  @endforeach
															  
														  </td> 
														  <td>{{ $datos->precio }}</td>
														  <td>{{ $datos->cantidad }}</td>
														  <td>
															
															@php
																  $totalAsignados=0;
															  @endphp
															  @foreach ($asignados as $asig)
																@if ($datos->idperfil_det ==$asig->idperfil_det)
																	@php
																		$totalAsignados +=$asig->cantidad;
																	@endphp 
																@endif   
															  @endforeach
															  {{$totalAsignados}}


														  </td>
														  <td>
															  @php
																  $total=0;
															  @endphp
															  @foreach ($tickets_Venta as $venta)
																@if ($datos->idperfil_det ==$venta->idperfil_det)
																	@php
																		$total +=$venta->cantidad;
																	@endphp 
																@endif   
															  @endforeach
															  {{$total}}
														  </td>
														  <td>

															{{$datos->cantidad-$total}}

														  </td>
		
														   
														   
														  {{-- <td class="center" style="width: 9rem">
															 <a href="{{ url('#') }}/{{$datos->idperfil_det}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Editar">
															  <i class="material-icons" style="color: #7986cb ">visibility</i>
															</a>   
														  </td> --}}
													  </tr>  
													  <?php }} ?>
												  </tbody>
											  </table>
											</div>
									
									</div> 
								 </div>
								 </div>                  
							</div> 
						</div> 
					  </div>
					  @endforeach
					</div>
 </div>


 
@endsection

 