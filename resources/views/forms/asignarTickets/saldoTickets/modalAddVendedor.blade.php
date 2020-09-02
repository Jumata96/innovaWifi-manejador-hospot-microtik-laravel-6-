<div id="modalAddVendedores" class="modal modal-fixed-footer">  
	<div class="card-header">                    
		<i class="fa fa-table fa-lg material-icons">receipt</i>
		<h2>LISTA DE VENDEDORES</h2>   
	</div> 
	<div class="row card-header sub-header"  >
		<div class="col s12 m12 l1  herramienta">    
			{{-- <a href="{{url('tecnicos')}}"  target="_blank" class="btn-floating  waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Agregar Tecnico">
				<i class="material-icons" style="color: #2E7D32">add</i></a> --}}
		</div>    
		@include('forms.scripts.modalInformacion')  
	</div>
			<div class="row cuerpo">
				<?php 

				$bandera = false;

				if (count($vendedores) > 0) {
					# code...
					$bandera = true;
					$i = 0;
				}

				?> 
				<br>
				<div class="row">  
						<div class="card-content">
							Existen <?php echo ($bandera)? count($vendedores) : 0; ?> registros. <br><br>
							<table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display" cellspacing="0">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th> 
										<th>Acción</th>
									</tr>
								</thead>
								<?php
										if($bandera){                                                           
									?>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Acción</th>
									</tr>
									</tfoot>

								<tbody>
									<tr>
									<?php 
											foreach ($vendedores as $datos) {
											$i++;
										?>
										<td><?php echo $i; ?></td>
										<td>
											 {{$datos->nombre}} {{$datos->apellidos}} 
										</td>  
										<td class="center" style="width: 9rem">
											<a  class="btnSeleccionarVendedor btn-floating  waves-light grey lighten-5 tooltipped" data-tooltip="Seleccionar Vendedor"
											data-id="{{$datos->id}}"
											data-nombre="{{$datos->nombre}} {{$datos->apellidos}}"
											data-nro_documento="{{$datos->nro_documento}}"
											><i class="material-icons " style="color: #2E7D32">check</i></a>
										</td>
									</tr> 
									<?php }} ?>
								</tbody>
							</table>
						</div>  
				</div>
			</div>


</div>

