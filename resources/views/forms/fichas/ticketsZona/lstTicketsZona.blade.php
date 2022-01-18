@extends('layouts2.app')
@section('titulo','Asignar tickets a vendedor ')
@section('main-content')
<br>
<div class="row">
<div class="col s12 m12 l12">
	<div class="card">
		<div class="card-header">
			<i class="fa fa-table fa-lg material-icons">receipt</i>
			<h2>ASIGNAR TICKETS A VENDEDOR</h2>
		</div>
		<form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
			<div class="row card-header sub-header">
				<div class="col s12 m12 herramienta">                         
					{{-- <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
					<i class="material-icons blue-text text-darken-2">check</i></a> --}}
					<a style="margin-left: 6px"></a>
					<a class=" btn-floating waves-effect waves-light grey btn  lighten-5  modal-trigger tooltipped" href="#AsignarTickets"  data-position="top" data-tooltip="AGREGAR TICKETS" >
					<i class="material-icons " style="color: #03a9f4">add</i>
					</a>   
					<a href="{{url('/lsttickets')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
					<i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
				</div>
				@include('forms.fichas.ticketsZona.addTicketsTrabajadorModal') 
			</div>
			<div class="row cuerpo">
        @foreach ($arrayZona as $zona) 
				<br><br>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="col col s12 m12 l12   ">
					{{-- <input id="idVendedor" maxlength="4" value="{{$vend->id}}"  type="hidden"   readonly="readonly" > --}}
					<div class="card white">
						<div class="card-content">
							<span class="card-title">Datos Generales</span> 
							<div class="input-field col s12 m4 l3"> 
										<div class="input-field col s12 m12 l12">
												<i class="material-icons prefix">map</i>
												<input value="{{$zona['ZonaNombre']}}" name="Punto" type="text"  readonly="readonly" >
												<label for="puntoVenta">Punto de Venta </label> 
										</div> 
										<div class="input-field col s12 m12 l12">
												<i class="material-icons prefix">wc</i>
												<input value="{{$zona['ZonaTrabajadores']}}" name="Trabajadores" type="text"  readonly="readonly" >
												<label for="Trabajadores">Total Trabajadores</label> 
										</div> 
							</div>
							<div class="col s12 m8 l9">

								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">book</i>
										<input value="{{$zona['ZonaTotalAsignados']}}" name="Asignados" type="text"  readonly="readonly" >
										<label for="Asignados">Total Asignados</label> 
								</div> 
								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">book</i>
										<input value="{{$zona['ZonaTotalVendidos']}}" name="Vendidos" type="text"  readonly="readonly" >
										<label for="Vendidos">Total Vendidos</label> 
								</div> 
								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">book</i>
										<input value="{{$zona['ZonaTotalSaldo']}}" name="Saldo" type="text"  readonly="readonly" >
										<label for="Saldo">Total Saldo</label> 
								</div> 

									<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">attach_money</i>
										<input value="{{$zona['ZonaTotalAsigDirero']}}" name="AsignadosD" type="text"  readonly="readonly" >
										<label for="AsignadosD">Total Asignados</label> 
								</div> 
								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">attach_money</i>
										<input value="{{$zona['ZonaTotalVendDirero']}}" name="VendidosD" type="text"  readonly="readonly" >
										<label for="VendidosD">Total Vendidos</label> 
								</div> 
								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">attach_money</i>
										<input value="{{$zona['ZonaTotalSaldDirero']}}" name="SaldoD" type="text"  readonly="readonly" >
										<label for="SaldoD">Total Saldo</label> 
								</div> 


							</div>
						</div>
					</div>
					<div class="card white">
						<div class="card-content">
							<div class="row cuerpo">
								<?php 
									$bandera = false; 
									if (count($arrayTabla) > 0) {
									   # code...
									   $bandera = true;
									   $i = 0;
									} 
									?>
								<br>
								<div class="row">
									<div class="col s12 m12 l12">
										<div class="card-content">
											Existen <?php echo ($bandera)? count($arrayTabla) : 0; ?> registros. <br><br>
											<table id="data-table-simple" class="responsive-table display" cellspacing="0">
												<thead>
													<tr>
														<th>#</th>
														<th>Vendedor</th>
														<th>T.asignados</th>
														<th>T.vendidos</th>
														<th>T.saldo</th>
														<th>T.asignados $</th>
														<th>T.vendidos $</th>
														<th>T.saldo $</th>
              <th>Acción</th>

													</tr>
												</thead>
												<?php
													if($bandera){                                                           
													?>
												<tfoot>
													<tr style="background-color:#03a9f4">
														<th>TOTALES</th>
														<th>Ven: {{$zona['ZonaTrabajadores']}}</th>
														<th>Asig: {{$zona['ZonaTotalAsignados']}}</th>
														<th>Ven:{{$zona['ZonaTotalVendidos']}}</th>
														<th>Sal: {{$zona['ZonaTotalSaldo']}}</th>
														<th>$ {{$zona['ZonaTotalAsigDirero']}}</th>
														<th>$ {{$zona['ZonaTotalVendDirero']}}</th>
														<th>$ {{$zona['ZonaTotalSaldDirero']}}</th>
														{{-- <th>{{$zona['ZonaTotalAsigDirero']}}</th>
														<th>{{$zona['ZonaTotalVendDirero']}}</th>
														<th>{{$zona['ZonaTotalSaldDirero']}}</th> --}}
              <th> </th>
													</tr>
												</tfoot>
												<tbody>
													<tr>
														<?php 
															foreach ($arrayTabla as $datos) { 
															?>
														<td>{{$datos['numero']}}</td>
														<td>{{$datos['nombre']}}</td>
														<td>{{$datos['asignado']}}</td>
														<td>{{$datos['vendido']}}</td>
														<td>{{$datos['saldo']}}</td>
														<td>$ {{$datos['asignadoD']}}</td>
														<td>$ {{$datos['vendidoD']}}</td>
														<td>$ {{$datos['saldoD']}}</td>
														<td>
																<a href="{{ url('fichasZonaTrabajador') }}/{{$datos['id']}}"  target="_bank"  id="updHotspot{{$datos['id']}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver" data-id="{{$datos['id']}}"  >
																<i class="material-icons" style="color: #7986cb ">visibility</i></a> 
 													</td>             
													</tr>
														{{-- @include('forms.fichas.ticketsZona.lstTicketsTrabajadorModal')  --}}
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
		</form>
		</div>
	</div>
</div>
<br><br><br>

@endsection
@section('script')
{{-- @include('forms.asignarTickets.asignarTicketTrabajador.scripts.addTicketsTrabajadorModal')  --}}
@include('forms.fichas.ticketsZona.scripts.addTicketsTrabajadorModal') 
@endsection