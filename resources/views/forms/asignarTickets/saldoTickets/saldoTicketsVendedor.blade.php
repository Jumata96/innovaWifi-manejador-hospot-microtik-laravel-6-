@extends('layouts2.app')
@section('titulo','Tikets Asignados')

@section('main-content') 
 
								
<div class="row" onload="funload();">
	<div class="col s12 m12 l12"> 
									<div class="col s12 m6 l4">
											<div class="card light-blue lighten-2 gradient-shadow min-height-100 white-text">
											<div class="padding-4">
												<div class="col s7 m7">
												<i class="material-icons background-round mt-5">attach_money</i>
												<p>Asignado</p>
												</div>
												<div class="col s5 m5 right-align">
												<h4 class="mb-0" style="color: white">{{$asignadosPrecio}}</h4>
												<p class="no-margin">Total</p>
												<p></p>
												</div>
											</div>
											</div>
									</div>
									<div class="col s12 m6 l4">
										<div class="card green lighten-2 gradient-shadow min-height-100 white-text">
											<div class="padding-4">
												<div class="col s7 m7">
												<i class="material-icons background-round mt-5">attach_money</i>
												<p>Vendido</p>
												</div>
												<div class="col s5 m5 right-align">
													@php
														$vendido=intval($asignadosPrecio)-intval($saldoPrecio);
														if($vendido<1 ){
															$vendido=0;
														}
													@endphp
												<h4 class="mb-0" style="color: white">{{$vendido}}</h4>
												<p class="no-margin">Total</p>
												<p></p>
												</div>
											</div>
										</div>
									</div>
									<div class="col s12 m6 l4">
										<div class="card red lighten-2 gradient-shadow min-height-100 white-text">
											<div class="padding-4">
												<div class="col s7 m7">
												<i class="material-icons background-round mt-5">attach_money</i>
												<p>Saldo</p>
												</div>
												<div class="col s5 m5 right-align">
												<h4 class="mb-0" style="color: white">{{$saldoPrecio}}</h4>
												<p class="no-margin">Total</p>
												<p></p>
												</div>
											</div>
										</div>
									</div> 
								</div> 
	<div class="col s12 m12 l12"> 
					@foreach ($usuarios as $usuario)   
								<div class="col s12 m6 l4">
									<div class="card white"> 
										<div class="card-content">
											<span>Datos del Vendedor</span><br>
											<div class="row">  
												<input id="idUsuario" type="hidden" value="{{$usuario->id}}"  >

												<div class="input-field col s12 m6 l12">
													<i class="material-icons prefix">account_box</i>
												<input id="cantidad" name="cantidad" type="text" value="{{$usuario->nombre."  ".$usuario->apellidos}}" style="text-align: center" data-error=".error2"  readonly="readonly" >
													<label for="cantidad"> Vendedor</label>
													<div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
												</div> 
												<div class="input-field col s12 m6 l12">
													<i class="material-icons prefix">assignment</i>
													<input id="cod_alterno" name="cod_alterno" type="Text" value=" {{$usuario->cod_alterno}}" style="text-align: center" data-error=".error2"  readonly="readonly" >
													<label for="cod_alterno"> Código alterno</label>
													<div class="errorTxt1" id="error15" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
												</div> 
												@foreach ($puntoVenta as $item) 
													@if ( $item->id==$usuario->idzona)
														<div class="input-field col s12 m6 l12">
															<i class="material-icons prefix">my_location</i>
															<input id="cod_alterno" name="cod_alterno" type="Text" value="{{$item->nombre}}" style="text-align: center" data-error=".error2"  readonly="readonly" >
															<label for="cod_alterno">Punto de Venta</label>
															<div class="errorTxt1" id="error15" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
														</div> 
														
													@endif  
													
												@endforeach

												

											</div>                   
										</div> 
									</div> 
								</div>  
								<div class="col s12 m6 l8">
									<div class="card white">
										<div class="card-content"> 
											<div class="row cuerpo"> 
											<div class="row">
												<div class="col s12 m12 l12">
													<span>Tickets Pendientes</span>
												
													<div class="card-content">
														<p id="registros"></p>
														<table id="data-table-simple" class="tablaVendedorSaldoVer responsive-table display centered" cellspacing="0">
															<thead>
																<tr>
																	<th>#</th> 
																	<th>Perfil</th>
																	<th>Name</th>
																	<th>Precio</th>
																	<th>Target</th> 
																</tr>
															</thead> 
															<tfoot>
																<tr>
																	<th class="center"  >#</th> 
																	<th class="center" >Perfil</th>
																	<th class="center" >Name</th>
																	<th class="center" >Precio</th>
																	<th class="center" >Target</th> 
																</tr>
																</tfoot>
					
															<tbody>
																@foreach($data as $valor) 
																	<tr>
																		<td>{{ $valor['id'] }}</td>
																		<td>{{ $valor ['plan'] }}</td>
																		<td>{{ $valor ['nombre'] }}</td>
																		<td>{{ $valor ['precio'] }}</td>
																		<td>{{ $valor ['target'] }}</td>
																	</tr> 
																@endforeach
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


 
@endsection

 

@section('script') 

    
@endsection

