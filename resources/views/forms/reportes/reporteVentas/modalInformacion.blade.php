<div id="modalInformacion" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">  
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 200%; background-color: #f9f9f9">
		<div class="card-header" style="position: fixed; width:33.35em; z-index: 2">                    
			<i class="fa fa-table fa-lg material-icons">receipt</i>
			<h2>LEYENDA DE COLORES</h2>   
			</div> 
	  <br><br> <br>
		<form action="#" id="myFormCkeck">
			<div class="row cuerpo"> 
				<div class="row">  
						<div class="card-content herramienta"> 
							<table  class="bordered" >
								<thead>
									<tr>
										<th>Color</th> 
										<th>Referencia</th>  
									</tr>
								</thead> 
								<tbody>
									<tr>
										<td><button style="background-color:#64b5f6" type="submit" id="filtrarVendedores" class="btn-floating" ></button> </td>
										<td>Paquete de tickets cerrados(Vendidos).</td>

									</tr>
									<tr>
										<td><button style="background-color:#e6ee9c" type="submit" id="filtrarVendedores" class="btn-floating" ></button> </td>
										<td>Total asignados en cantidad y monto.</td>

									</tr>
									<tr>
										<td><button style="background-color:#dce775" type="submit" id="filtrarVendedores" class="btn-floating" ></button> </td>
										<td>Saldo total a vender  de tickets asignados.</td>

									</tr>
									<tr>
										<td><button style="background-color:#ffcc80" type="submit" id="filtrarVendedores" class="btn-floating" ></button> </td>
										<td>Total de tickets vendidos.</td>

									</tr>
									<tr>
										<td><button style="background-color:#c5e1a5" type="submit" id="filtrarVendedores" class="btn-floating" ></button> </td>
										<td>Cantidad de tickets vendidos por registro de venta.</td>

									</tr>
									
								</tbody>
							</table>
							 
						</div>  
				</div>
			<input type="hidden" id="contadorChecks" name="contadorChecks" value="0">
			</div>
		</form>
	</div>


</div>

