<div id="modalAddVendedores" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">  
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
		<div class="card-header" style="position: fixed; width:33.35em; z-index: 2">                    
			<i class="fa fa-table fa-lg material-icons">receipt</i>
			<h2>LISTA DE VENDEDORES</h2>   
			</div> <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width:33.35em; z-index: 3">
			<div class="col s12 m12 herramienta"> 
				<div class="col l1">
					<a id="select"  rel="modal:close"  class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Seleccionar">
					<i class="material-icons " style="color: #2E7D32">check</i></a> 
				</div>  
				
				<div class="col l1" style="padding-left:25px;padding-bottom:10px;"> 
						<p class="center" >  
							<input  id="checkFiltro"   type="checkbox"  class='filled-in' name="checkFiltro"/>
							<label   class="center" for="checkFiltro">
							</label> 
						</p>  
				</div>  

				<div class="col l10">
					<a href="#" rel="modal:close" id="" class="btn-floating right waves-effect waves-light grey lighten-5 " data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
					<i class="material-icons" style="color: #424242">keyboard_tab</i></a>
				</div>  
					
  
				
					 


			</div>    
			@include('forms.scripts.modalInformacion')              
			
	  </div>
	  <br><br><br><br><br>
		<form action="#" id="myFormCkeck">
			<div class="row cuerpo"> 
				<div class="row">  
						<div class="card-content herramienta"> 
							<table  id="tablaFiltroVendedores" class="bordered" >
								<thead>
									<tr>
										<th>#</th>
										<th class="center">Check</th>
										<th>Nombre</th>  
									</tr>
								</thead> 
								<tbody>
									<tr>
										<td colspan="3" class="center"><h5 style="color: red;">Seleccionar punto de venta</h5></td>
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

