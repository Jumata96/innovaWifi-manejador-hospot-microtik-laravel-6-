<div id="modalAddVendedores" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">  
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
		<div class="card-header" style="position: fixed; width: 100%; z-index: 2">                    
			<i class="fa fa-table fa-lg material-icons">receipt</i>
			<h2>LISTA DE VENDEDORES</h2>   
			</div> <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
			<div class="col s12 m12 herramienta">                         
			  <a id="select" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Seleccionar">
				<i class="material-icons " style="color: #2E7D32">check</i></a>
			  <a style="margin-left: 6px"></a>   
			  <a id="i_allCheck" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Seleccionar todo">
				<i class="material-icons " style="color: #4a148c">radio_button_checked</i></a>
			  <a id="i_clearCheck" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Quitar checkeds">
				<i class="material-icons " style="color: #616161">radio_button_unchecked</i></a>
			  <a href="#" id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
				<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
			</div>  
			@include('forms.scripts.modalInformacion')              
			
	  </div>
	  <br>
		<form action="#" id="myFormCkeck">
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
						<div class="card-content herramienta">
							@php
								$contador=0;
							@endphp
							Existen <?php echo ($bandera)? count($vendedores) : 0; ?> registros. <br><br>
							<table {{-- id={{ ($bandera)? "data-table-simple" : "" }} --}} class="{{-- responsive-table --}} {{-- display --}}" cellspacing="0">
								<thead>
									<tr>
										<th>#</th>
										<th class="center">Check</th>
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
										<th>Check</th>
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
										<td style="width:4em;"><?php echo $i; ?></td>
										<td style="width:4em;"> 
											<p class='center'>  
												<input  id="check{{$i}}"  type="checkbox"  class='filled-in' name="check{{$i}}"/>
												
												<label  for="check{{$i}}">
												</label>
											  </p> 
										 </td>
										 <input type="hidden" name="checkValue{{$i}}" id="checkValue{{$i}}" value="{{$datos->id}}">

										  
										<td  style="width:12em;" >
											 {{$datos->nombre}} {{$datos->apellidos}} 
										</td>  
										<td class="center" style="width: 9rem">
											<a  class="btnSeleccionarVendedor btn-floating  waves-light grey lighten-5 tooltipped" data-tooltip="Seleccionar Vendedor"
											data-id="{{$datos->id}}"
											data-nombre="{{$datos->nombre}} {{$datos->apellidos}}"
											data-nro_documento="{{$datos->nro_documento}}"
											><i class="material-icons " style="color: #2E7D32">check</i></a>
										</td>
										@php
											$contador+=1;
										@endphp
									 
									</tr> 
									<?php }} ?>
								</tbody>
							</table>
							<input type="hidden" name="cont" id="cont" value="{{$i}}">
						</div>  
				</div>
			
			</div>
		</form>
	</div>


</div>

