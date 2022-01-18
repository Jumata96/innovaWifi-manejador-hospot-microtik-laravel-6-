@extends('layouts2.app')
@section('titulo','Asignar tickets a vendedor ')
@section('main-content')
<br>
@foreach ($arrayTrabajador as $Trabajador) 
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
					<a href="{{ url('fichasPuntoVenta') }}/{{$Trabajador['ZonaId']}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
					<i class="material-icons" style="color: #424242">keyboard_tab</i></a>     
					
						<a id="exportReportPdf"  class=" right btn-floating red tooltipped center"  data-tooltip="Descargar PDF"> 
                            <i class="material-icons">picture_as_pdf</i></a> 
				</div>
				{{-- @include('forms.fichas.ticketsZona.addTicketsTrabajadorModal')  --}}
				@include('forms.fichas.ticketsTrabajador.addTicketsTrabajadorModal') 
			</div>
			<div class="row cuerpo">
        
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
												<input value="{{$Trabajador['ZonaNombre']}}" name="Punto" type="text"  readonly="readonly" >
												<label for="puntoVenta">Punto de Venta </label> 
										</div>  
										<div class="input-field col s12 m12 l12">
												<i class="material-icons prefix">wc</i>
												<input value="{{$Trabajador['TrabajadorNombre']}}" class="Trabajadores" name="Trabajadores" type="text"  readonly="readonly" >
												<label for="Trabajadores"> Trabajador</label> 
										</div> 
							</div>
							<div class="col s12 m8 l9">

								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">book</i>
										<input value="{{$Trabajador['TrabajadoresTotalAsignados']}}" name="Asignados" type="text"  readonly="readonly" >
										<label for="Asignados">Total Asignados</label> 
								</div> 
								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">book</i>
										<input value="{{$Trabajador['TrabajadoresTotalVendidos']}}" name="Vendidos" type="text"  readonly="readonly" >
										<label for="Vendidos">Total Vendidos</label> 
								</div> 
								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">book</i>
										<input value="{{$Trabajador['TrabajadoresTotalSaldo']}}" name="Saldo" type="text"  readonly="readonly" >
										<label for="Saldo">Total Saldo</label> 
								</div> 

									<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">attach_money</i>
										<input value="{{$Trabajador['TrabajadoresTotalAsigDirero']}}" name="AsignadosD" type="text"  readonly="readonly" >
										<label for="AsignadosD">Total Asignados</label> 
								</div> 
								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">attach_money</i>
										<input value="{{$Trabajador['TrabajadoresTotalVendDirero']}}" name="VendidosD" type="text"  readonly="readonly" >
										<label for="VendidosD">Total Vendidos</label> 
								</div> 
								<div class="input-field col s12 m4 l4">
										<i class="material-icons prefix">attach_money</i>
										<input value="{{$Trabajador['TrabajadoresTotalSaldDirero']}}" name="SaldoD" type="text"  readonly="readonly" >
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
											<table id="data-table-simple" class=" tablaFiltro responsive-table display" cellspacing="0">
												<thead>
													<tr>
														<th>#</th>
														<th>Vendedor</th>
														<th>Precio</th>
														<th>T.asignados</th>
														<th>T.vendidos</th>
														<th>T.saldo</th>
														<th>T.asignados</th>
														<th>T.vendidos</th>
														<th>T.saldo</th>
              <th>Acción</th>

													</tr>
												</thead>
												<?php
													if($bandera){                                                           
													?>
												<tfoot>
													<tr>
														<th style="background-color:#03a9f4" colspan="3" >TOTALES</th> 
														<th style="background-color:#03a9f4" class="TotalAsig">Asig: {{$Trabajador['TrabajadoresTotalAsignados']}}</th>
														<th style="background-color:#03a9f4" class="TotalVend">Ven:{{$Trabajador['TrabajadoresTotalVendidos']}}</th>
														<th style="background-color:#03a9f4" class="TotalSaldo">Sal: {{$Trabajador['TrabajadoresTotalSaldo']}}</th>
														<th style="background-color:#03a9f4" class="TotalAsigD">$ {{$Trabajador['TrabajadoresTotalAsigDirero']}}</th>
														<th style="background-color:#03a9f4" class="TotalVenD">$ {{$Trabajador['TrabajadoresTotalVendDirero']}}</th>
														<th style="background-color:#03a9f4" class="TotalSalD">$ {{$Trabajador['TrabajadoresTotalSaldDirero']}}</th> 
              <th style="background-color:#03a9f4"> </th>
													</tr>
												</tfoot>
												<tbody>
													<tr>
														<?php 
															foreach ($arrayTabla as $datos) { 
															?>
														<td class="numero" >{{$datos['numero']}}</td>
														<td class="nombre" >{{$datos['nombre']}}</td>
														<td class="precio" >$ {{$datos['precio']}}</td>
														<td class="asignado" >{{$datos['asignado']}}</td>
														<td class="vendido" >{{$datos['vendido']}}</td>
														<td class="saldo" >{{$datos['saldo']}}</td>
														<td class="asignadoD" >$ {{$datos['asignadoD']}}</td>
														<td class="vendidoD" >$ {{$datos['vendidoD']}}</td>
														<td class="saldoD" >$ {{$datos['saldoD']}}</td>
														<td>
																{{-- <a href="{{ url('fichasZonaTrabajador') }}/{{$datos['id']}}"  target="_bank"  id="updHotspot{{$datos['id']}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver" data-id="{{$datos['id']}}"  >
																<i class="material-icons" style="color: #7986cb ">visibility</i></a>  --}}

																<a    href="{{url('/imprimir/fichaTrabajador')}}/{{$datos['perfilAsignado']}}" target="_bank"   class="btn-floating waves-effect waves-light grey lighten-5 tooltipped " data-position="top" data-delay="500" data-tooltip="Descargar PDF"    >
																<i class="material-icons" style="color: #7986cb ">local_printshop</i></a> 
                                  {{--href="http://localhost:3000/empleado/{{$datos['perfilAsignado']}}"  --}}
                                <a  
                                href="{{url('/reporte/#/fichas')}}/{{$datos['perfilAsignado']}}"
                                target="_blank"
                                   class="btn-floating waves-effect waves-light red lighten-5 tooltipped " 
                                   data-position="top" data-delay="500" data-tooltip="Descargar PDF QR"     >
                                  <i class="material-icons" style="color: #159911 ">local_printshop</i></a> 

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
		</form>
		</div>
	</div>
	 @endforeach
</div>
<br><br><br>

@endsection
 @section('script') 
@include('forms.fichas.ticketsTrabajador.scripts.addTicketsTrabajadorModal') 
 	<script src="{{ asset('dist/jspdf.min.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.12/jspdf.plugin.autotable.min.js" integrity="sha512-LbuBII6okEnUBAlReVukUVcO73H/Fna8DGcFsCI9mKvoRHVpAdbc2ahE9SEkMcjIplETjaUA4sAMPGiy08MEvg==" crossorigin="anonymous">
		</script>
		<script>  
			$(document).on('click','#exportReportPdf', function(){  

										let materiales = [];

														document.querySelectorAll('.tablaFiltro tbody tr').forEach(function(e){ 
																materiales.push(new Array(   
																										e.querySelector('.numero').innerText,
																										e.querySelector('.nombre').innerText,
																										e.querySelector('.precio').innerText,
																										e.querySelector('.asignado').innerText, 
																											e.querySelector('.vendido').innerText,
																											e.querySelector('.saldo').innerText,
																											e.querySelector('.asignadoD').innerText,
																											e.querySelector('.vendidoD').innerText,
																											e.querySelector('.saldoD').innerText,   ));
														}); 
										materiales.push(new Array(" "," "," Totales :",document.querySelector('.TotalAsig').innerText,document.querySelector('.TotalVend').innerText,document.querySelector('.TotalSaldo').innerText , document.querySelector('.TotalAsigD').innerText , document.querySelector('.TotalVenD').innerText , document.querySelector('.TotalSalD').innerText    ));

										// console.log(materiales);
										// var text=$('#TotalSalD').val();
										// var doc = new jsPDF();
										var doc = new jsPDF({
												orientation: "landscape"
												// unit: "in",
												// format: [4, 3]
										});
										
										// doc.text("REPORTE DE VENTAS", 4.5, 0.5);
										// doc.text("___________________",4.5,0.7);  
										var tipo=null; 
													// tipo ='striped';  
													tipo ='grid';  
										
										// doc.text(150,20,"PUNTO DE VENTA : ");  
										
										doc.text(110,15,"REPORTE DE VENTAS"); 
										doc.text(110,16,"___________________"); 

										doc.text(30,25,"VENDEDOR  : "+$('.Trabajadores').val());  
										// doc.text(140,25,"VENDEDOR :");   

									/*   var logo = new Image(); 
										logo.src = " {{asset('images/img8.jpg') }} ";  
										doc.addImage(logo, 'JPG', 10, 10, 50, 70); */
										
											var columns = ["NUMERO", "PLAN", "PRECIO","TICKETS ASIGNADOS", "TICKETS VENDIDOS","TICKETS SALDO","ASIGNADO","VENDIDO", "SALDO"];   
										doc.autoTable(columns,materiales,{
												margin:{ top: 28},content: 'Text',theme:tipo,styles: { halign: 'center' } 
										} ,materiales
										); 

			

										doc.save('Reporte ventas.pdf');  
										// temas :  ->grid,plain,striped
			}); 
		</script>
@endsection