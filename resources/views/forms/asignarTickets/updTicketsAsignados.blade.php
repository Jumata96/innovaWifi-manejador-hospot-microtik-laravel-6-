@extends('layouts2.app')
@section('titulo','Tikets Asignados')

@section('main-content') 
<br>
<div class="row">
	<div class="col s12 m12 l12">
					  <div class="card">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>LISTA DE TICKETS ASIGNADOS</h2>
						 </div>
						
						 <div class="row card-header sub-header">
							<div class="col s12 m12 herramienta">                         
							  <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
								 <i class="material-icons blue-text text-darken-2">check</i></a>
							  <a style="margin-left: 6px"></a>   
							  
							  <a href="{{url('/tickets/Asignar')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
								 <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
							</div>  

								  
							
					</div>
												 
						 <div class="row cuerpo">
						 
						 <br>
						 <div class="card white">
							<div class="card-content">
								<div class="row"> 
									
									<div class="col s12 m6 l6">
										<label for="puntoDeVenta">Puntos de Venta</label>                 
										<select class="browser-default" id="puntoDeVenta" name="puntoDeVenta" required>
										<option value="" disabled selected="">Seleccione</option>
										@foreach($zonas as $datos)
										<option value="{{$datos->id}}"> {{$datos->nombre}}</option>
										@endforeach
										</select>
										<div class="errorTxt1" id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
									</div>
									<div class="input-field col s12 m6 l6">
										<i class="material-icons prefix">assignment</i>
										<input id="cantidad" name="cantidad" type="number" style="text-align: center" data-error=".error2"  readonly="readonly" >
										<label for="cantidad"> Cantidad</label>
										<div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
									</div> 
									<div class="input-field col s12 m12 l12">
										<i class="material-icons prefix">comment</i>
										<label for="glosa">Glosa</label>
										<textarea  class="materialize-textarea" name="glosa" > 
										</textarea>
										<div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
										
									</div> 
								</div>                     
							</div> 
						</div> 
					  </div>
					</div>
 </div>


 
@endsection

 