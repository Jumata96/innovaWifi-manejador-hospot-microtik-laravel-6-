<div id="AsignarTickets" class="modal modal-fixed-footer" style="height: 80%; overflow: hidden;">
<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9;">
	<div class="card" style="position: fixed; width: 100%; z-index: 2">
		<div class="card-header">
			<i class="fa fa-table fa-lg material-icons">receipt</i>
			<h2>ASIGNAR TICKETS</h2>
		</div>
	</div>
	<?php  $contador = 0;   ?>
	<div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
		<div class="col s12 m12 herramienta">                         
			<a id="Asignar" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Asignar">
			<i class="material-icons " style="color: #2E7D32">check</i></a>
			<a style="margin-left: 6px"></a>  
			<a   id="" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
			<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
		</div>
	</div>

  {{-- tabla de perfiles asignados al vendedor  --}}
	<div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">
		<div class="card white col s12 m12 l12" >
			<form  id="myFormModal" accept-charset="UTF-8" enctype="multipart/form-data">
				<div class="card-content">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col s12 m4 l4"   >
						<label for="selet_id_vendedor">Vendedor</label>                 
						<select class="browser-default" id="selet_id_vendedor" name="selet_id_vendedor" required>
							<option value="" disabled  >Seleccione</option>
              	@foreach($vendedores as $vendedorList) 
                <option value="{{$vendedorList->id}}" selected> {{$vendedorList->nombre}} {{$vendedorList->apellidos}}</option> 
                @endforeach 
						</select>
						<div class="error_asignar_perfiles_01" id="errorModal1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
					</div>
          <div class="col s12 m4 l4"   >
						<label for="selet_id_perfil">Perfiles de Internet</label>                 
						<select class="browser-default" id="selet_id_perfil" name="selet_id_perfil" required>
							<option value="" disabled selected="">Seleccione</option>
              	@foreach($perfiles as $perfilList) 
                <option value="{{$perfilList->idperfil}}"> {{$perfilList->name}} </option> 
                @endforeach 
						</select>
						<div class="error_asignar_perfiles_02" id="errorModal1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
					</div> 
					<div class="input-field col s12 m4 l4">
						<input id="cantidad" style="text-align: center;" value="1"  name="cantidad" type="number">
						<label for="cantidad_l">cantidad</label>
						<div class="error_asignar_perfiles_03" id="errorModal2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
					</div> 
				</div>
					<br><br><br>
			</form>
		</div> 
	</div>
</div>