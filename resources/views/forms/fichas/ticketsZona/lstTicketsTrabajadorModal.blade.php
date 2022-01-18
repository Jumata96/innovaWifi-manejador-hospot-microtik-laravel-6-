<div id="modalPerfilesTrabajador{{$datos['id']}}" class="modal modal-fixed-footer" style="height: 80%; overflow: hidden;">
<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9;">
	<div class="card" style="position: fixed; width: 100%; z-index: 2">
		<div class="card-header">
			<i class="fa fa-table fa-lg material-icons">receipt</i>
			<h2>Perfiles Asignados</h2>
		</div>
	</div>
	<?php  $contador = 0;   ?>
	<div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
		<div class="col s12 m12 herramienta">                         
			{{-- <a id="Asignar" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Asignar">
			<i class="material-icons " style="color: #2E7D32">check</i></a>
			<a style="margin-left: 6px"></a>   --}}
			<a   id="modalCerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
			<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
		</div>
	</div>

  {{-- tabla de perfiles asignados al vendedor  --}}
	<div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px"> 
		<div class="card white col s12 m12 l12" id="historial_perfiles_asignados" > 
				<div class="card-content">     
											<table id="data-table-simpleI" class="responsive-table display" cellspacing="0">
												<thead>
													<tr>
														<th>#</th>
														<th>Vendedor</th>
														<th>Perfil</th>
														<th>T.asignados</th>
														<th>T.vendidos</th>
														<th>T.saldo</th> 
														<th>T.asignados</th>
														<th>T.vendidos</th>
														<th>T.saldo</th> 

													</tr>
												</thead> 
												<tfoot>
													<tr> 
														<th id="totalRegistros02" >#</th>
														<th></th>
														<th></th>
														<th>T.asignados</th>
														<th>T.vendidos</th>
														<th>T.saldo</th> 
														<th>T.asignados</th>
														<th>T.vendidos</th>
														<th>T.saldo</th> 
													</tr>
												</tfoot>
														<tr> 
															<td>1</td>
															<td>2</td>
															<td>3</td>
															<td>4</td>
															<td>5</td>
															<td>6</td>
													</tr>
												<tbody> 
												</tbody>
											</table> 


        </div> 
		</div>
	</div>
</div>