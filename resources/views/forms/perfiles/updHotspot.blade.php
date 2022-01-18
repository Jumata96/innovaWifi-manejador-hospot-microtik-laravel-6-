<div id="updHotspot" class="modal modal-fixed-footer" style="height: 100%; overflow: hidden;">
   <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
      <div class="card" style="position: fixed; width: 100%; z-index: 2">
         <div class="card-header">
            <i class="fa fa-table fa-lg material-icons">receipt</i>
            <h2>ACTUALIZAR PERFIL HOTSPOT</h2>
         </div>
      </div>
      <div class="row card-header sub-header" style="margin-top: 3.15rem; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">
         <div class="col s12 m12 herramienta">                         
            <button id="hu_update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
            <i class="material-icons " style="color: #2E7D32">check</i></button>
            <a style="margin-left: 6px"></a>   
            <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario">
            <i class="material-icons ">info</i></a>
            <a href="#" id="hu_cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>  
         </div>
         @include('forms.scripts.modalInformacion')              
      </div>
      <form style="margin-top: 55px">
         <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">
            <input type="hidden" name="hu_idperfil" id="hu_idperfil" value="aa">
            <div class="card white">
               <div class="card-content">
                  <div class="row">
                     <div class="col s12 m6 l6">
                        <label for="hu_idrouter">Router Mikrotik</label>
                        <select class="browser-default" id="hu_idrouter" name="hu_idrouter" data-error=".errorTxt1" >
                           <option value="sn" disabled="" selected="">Elija un router</option>
                           <option value="0">Todos</option>
                           @foreach ($router as $valor)
                           <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                           @endforeach
                        </select>
                        <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                     </div>
                     <div class="input-field col s12 s12 m6 l6 right-align">
                        <div id="hu_estado" class="chip center-align" style="width: 70%">
                           <b>NO DISPONIBLE</b>
                           <i class="material-icons"></i>
                        </div>
                        <div id="hu_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                           <b>ACTIVO</b>
                           <i class="material-icons"></i>
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
                        <input id="hu_name" name="hu_name" type="text" data-error=".errorTxt2" value=" ">
                        <label for="hu_name">Nombre del Plan</label>
                        <div id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                     </div>
                     <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">attach_money</i>
                        <input id="hu_precio" name="hu_precio" type="text" data-error=".errorTxt3" value=" ">
                        <label for="hu_precio">Precio</label>
                        <div id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                     </div>
                     <div class="col s12 m6 l6" disabled="">
                        <label for="hu_perfil">Perfil Mikrotik</label>
                        <select class="browser-default" id="hu_perfil" name="hu_perfil" data-error=".errorTxt1" disabled="">
                           <option value="sn" disabled="" selected="">Elija un perfil</option>
                           {{-- <option value="0">Crear perfil</option> --}}
                           {{-- <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option> --}}
                        </select>
                        <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                     </div>
                     
                              {{-- <div class=" input-field col s12 m6 l6"   >
                                <i id="iconColor"  style="color:#{{$valor->color}};" class="material-icons prefix" >color_lens</i>
                                <label  for="color">Color</label>
                                <input id="color" value="{{ $valor->color }}" style="text-align: center;color:#{{$valor->color}};" name="color" type="text" readonly="readonly">
                              </div>   --}}
                     {{-- <div class="input-field col s12 m6 l6">
                        <i  id="iconColor_upd" class="material-icons prefix">color_lens</i>
                        <input id="color_perfil_upd" name="color_perfil_upd" type="text" value=" " data-error=".errorTxt3"  readonly="readonly"  >
                        <label for="color_perfil_upd">color</label>
                        <div id="error50" style="color: red; font-size: 12px; font-style: italic;"></div>
                     </div> --}}

                     	<div class="input-field col s12 m6 l6">
                           <i  id="iconColor_upd" class="material-icons prefix">color_lens</i>
                           <label for="color_upd">Color</label>
                           <input id="color_upd" name="color_upd" type="text" readonly="readonly"  placeholder=""> 
                           <div id="h_error55" style="color: red; font-size: 12px; font-style: italic;"></div>
                        </div>

                    


                     <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">cloud_upload</i>
                        <input id="hu_vsubida" name="hu_vsubida" type="text" data-error=".errorTxt4" value=" ">
                        <label for="hu_vsubida">Velocidad de Subida</label>
                        <div id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                     </div>
                     <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">cloud_download</i>
                        <input id="hu_vbajada" name="hu_vbajada" type="text" data-error=".errorTxt5" value=" ">
                        <label for="hu_vbajada">Velocidad de descarga</label>
                        <div id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
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
						<input id="h_dias_upd" name="h_dias_upd" type="number" min="0"  value="0" data-error=".errorTxt5" > 
						<div id="h_error_dias_upd" style="color: red; font-size: 12px; font-style: italic;"></div>
					</div>
				</div>
				<div class="row">
					<div class="col s6 m6 l6">
						<input id="h_horas_t" name="h_horas_t" type="number" min="0" max="60" data-error=".errorTxt5" placeholder="HORAS" disabled> 
					</div>
					<div class="col s6 m6 l6">
						<input id="h_horas_upd" name="h_horas_upd" type="number" min="0" value="0"  max="60" data-error=".errorTxt5"> 
						<div id="h_error_hor_upd" style="color: red; font-size: 12px; font-style: italic;"></div>
					</div>
				</div>
				<div class="row">
					<div class="col s6 m6 l6">
						<input id="h_minutos_t" name="h_minutos_T" type="number" min="0" max="60" maxlength="2" data-error=".errorTxt5" placeholder="MINUTOS" disabled >  
					</div>
					<div class="col s6 m6 l6">
						<input id="h_minutos_upd"  value="0"  name="h_minutos_upd" type="number" min="0" max="60" maxlength="2" data-error=".errorTxt5" placeholder="MINUTOS"> 
						<div id="h_error_min_upd" style="color: red; font-size: 12px; font-style: italic;"></div>
					</div>
				</div>
			</div>
		</div>
	</div> 
                     <div class="col s12 m6 l6" >
                        <label for="hu_eliminacion">AUTOELIMINAR </label>
                        <select class="browser-default" id="hu_eliminacion" name="hu_eliminacion" data-error=".errorTxt1" >
                           {{-- <option value="sn"  selected="">Elija un perfil</option>  --}}
                        </select>
                        {{-- <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div> --}}
                     </div>

                      

                     <div class="input-field col s12 m6 l6">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea id="hu_glosa" name="hu_glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"> </textarea>
                        <label for="hu_glosa" class="">Comentario</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>