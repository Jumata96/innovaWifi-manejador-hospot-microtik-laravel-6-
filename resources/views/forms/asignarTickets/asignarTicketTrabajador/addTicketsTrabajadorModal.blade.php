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
                              <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1; margin-top: 70px">
                                  <div class="card white col s12 m12 l6 offset-l3" >
                                  <form  id="myFormModal" accept-charset="UTF-8" enctype="multipart/form-data">
                                      <div class="card-content"> 
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="col s12 m12 l12"   >
                                            <label for="tipoTicket">Tipo de tickets</label>                 
                                            <select class="browser-default" id="tipoTicket" name="tipoTicket" required>
                                              <option value="" disabled selected="">Seleccione</option> 
                                              @foreach($tickets_per_det as $val)
                                              @foreach ($perfiles as $per)
                                              @if ($per->idperfil==$val->idperfil)
                                              <option value="{{$val->idperfil_det}}"> {{$per->name}}</option>
                                              @endif 
                                              @endforeach 
                                              @endforeach
                                            </select> 
                                            <div class="errorTxt1" id="errorModal1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                        </div>
                                        
                                        <div  id="total1" class="input-field col s12 m12 l12  ">  
                                            <input id="total" style="text-align: center;"  name="total" type="number"  readonly="readonly" >
                                            <label class="active" for="total">Disponibles</label>
                                            <div class="errorTxt1" id="errorModal5" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                              
                                        </div> 

                                        <div class="input-field col s12 m12 l12"> 
                                            <input id="cantidad" style="text-align: center;"  name="cantidad" type="number"  readonly="readonly" >
                                            <label for="cantidad">cantidad</label>
                                            <div class="errorTxt1" id="errorModal2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div> 
                                        </div>
                                        <div class="col s12 m12 l12"> 
                                            <label for="codigoAlterno">Codigo alterno</label>
                                                <select class="browser-default" id="codigoAlterno" name="codigoAlterno" data-error=".errorTxt1" > 
                                                        {{-- <option value="" disabled selected="">Seleccione</option>  --}}
                                                    @foreach ($codigos as $valor)  
                                                        @if ($valor->estado=1)
                                                            <option value="{{ $valor->codigo }}">{{ $valor->descripcion }}</option>  
                                                        @else
                                                            <option value="{{ $valor->codigo }}"  disabled  >{{ $valor->descripcion }}</option>
                                                        @endif
                                                      
                                                    @endforeach 
                                                     
                                                </select>
                                                <div class="errorTxt1" id="errorModal6" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>  
                                                <br><br>          
                                        </div>   
                                      </div>
                                    </form>
                                  </div> 
							  

	</div>
	
 </div>   
  


