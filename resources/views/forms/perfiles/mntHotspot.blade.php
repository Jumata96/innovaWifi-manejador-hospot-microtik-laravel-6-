<div id="mntHotspot" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
	<div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
		<div class="card" style="position: fixed; width: 100%; z-index: 2">
			<div class="card-header">
				<i class="fa fa-table fa-lg material-icons">receipt</i>
				<h2>REGISTRAR PERFIL HOTSPOT</h2>
			</div>
		</div>
		<div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
			<div class="col s12 m12 herramienta">                         
				<button id="h_add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
				<i class="material-icons " style="color: #2E7D32">check</i></button>
				<a style="margin-left: 6px"></a>   
				<a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario">
				<i class="material-icons ">info</i></a>
				<a href="#" id="h_cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
				<i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
			</div>
			@include('forms.scripts.modalInformacion')              
		</div>
		<form style="margin-top: 70px">
			<div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">
				<div class="card white">
					<div class="card-content">
						<div class="row">
							<div class="col s12 m6 l6">
								<label for="idrouter">Router Mikrotik</label>
								<select class="browser-default" id="h_idrouter" name="h_idrouter" data-error=".errorTxt1" >
									<option value="" disabled="" selected="">Elija un router</option>
									<option value="0">Todos</option>
									@foreach ($router as $valor)
									<option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
									@endforeach
								</select>
								<div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
							</div>
							<div class="input-field col s12 s12 m6 l6 right-align">
								<div class="chip center-align" style="width: 70%">
									<b>Estado:</b> No Disponible
									<i class="material-icons mdi-navigation-close"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card white">
					<div class="card-content">
						<span class="card-title">Datos Generales</span>
						<div class="row">

              	<div class="input-field col s12 m6 l6">
		<i class="material-icons prefix active">label_outline</i>
		<input id="h_name" name="h_name" type="text" data-error=".errorTxt2">
		<label for="h_name">Nombre del Plan</label>
		<div id="h_error2" style="color: red; font-size: 12px; font-style: italic;"></div>
	</div>
	<div class="input-field col s12 m6 l6">
		<i class="material-icons prefix">attach_money</i>
		<input id="h_precio" name="h_precio" type="number" data-error=".errorTxt3">
		<label for="h_precio">Precio</label>
		<div id="h_error3" style="color: red; font-size: 12px; font-style: italic;"></div>
	</div>
	<div class="col s12 m6 l6">
		<label for="h_perfil">Acción</label>
		<select class="browser-default" id="h_perfil" name="h_perfil" data-error=".errorTxt1" >
			<option value="0" selected="">Crear perfil </option>
		</select>
		<div class="errorTxt1" id="h_error4" style="color: red; font-size: 12px; font-style: italic;"></div>
	</div>
	<div class="input-field col s12 m6 l6">
		<i  id="iconColor" class="material-icons prefix">color_lens</i>
		<label for="color">Color</label>
		<input id="color" name="color" type="text" readonly="readonly"  placeholder=""> 
		<div id="h_error50" style="color: red; font-size: 12px; font-style: italic;"></div>
	</div>
	<div class="input-field col s12 m6 l6">
		<i class="material-icons prefix">cloud_upload</i>
		<input id="h_vsubida" name="h_vsubida" type="text" data-error=".errorTxt4">
		<label for="h_vsubida">Velocidad de Subida</label>
		<div id="h_error6" style="color: red; font-size: 12px; font-style: italic;"></div>
	</div>
	<div class="input-field col s12 m6 l6">
		<i class="material-icons prefix">cloud_download</i>
		<input id="h_vbajada" name="h_vbajada" type="text" data-error=".errorTxt5">
		<label for="h_vbajada">Velocidad de descarga</label>
		<div id="h_error7" style="color: red; font-size: 12px; font-style: italic;"></div>
	</div>

  	<div class="input-field col s12 m6 l6">
					<i class="material-icons prefix">timer</i>
					<label for="h_vsubida">Tiempo de conexión </label>
					<br>
					<br>
					<div class="row">
						<div class="col l12 "> 
							<div class="row">
								<div class="col s6 m6 l6">
									<input id="h_dias_t" name="h_dias_t" type="number" min="0"  data-error=".errorTxt5" placeholder="DIAS" disabled> 
								</div>
								<div class="col s6 m6 l6">
									<input id="h_dias" name="h_dias" type="number" min="0"  value="0" data-error=".errorTxt5" > 
									<div id="h_error_dias" style="color: red; font-size: 12px; font-style: italic;"></div>
								</div>
							</div>
							<div class="row">
								<div class="col s6 m6 l6">
									<input id="h_horas_t" name="h_horas_t" type="number" min="0" max="60" data-error=".errorTxt5" placeholder="HORAS" disabled> 
								</div>
								<div class="col s6 m6 l6">
									<input id="h_horas" name="h_horas" type="number" min="0" value="0"  max="60" data-error=".errorTxt5"> 
									<div id="h_error_hor" style="color: red; font-size: 12px; font-style: italic;"></div>
								</div>
							</div>
							<div class="row">
								<div class="col s6 m6 l6">
									<input id="h_minutos_t" name="h_minutos_T" type="number" min="0" max="60" maxlength="2" data-error=".errorTxt5" placeholder="MINUTOS" disabled >  
								</div>
								<div class="col s6 m6 l6">
									<input id="h_minutos"  value="0"  name="h_minutos" type="number" min="0" max="60" maxlength="2" data-error=".errorTxt5" placeholder="MINUTOS"> 
									<div id="h_error_min" style="color: red; font-size: 12px; font-style: italic;"></div>
								</div>
							</div>
						</div>
					</div>
				</div> 
  
 
							<div class="input-field col s12 m6 l6">
								<i class="material-icons prefix">mode_edit</i>
								<textarea id="h_glosa" name="h_glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"></textarea>
								<label for="glosa" class="">Comentario</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>