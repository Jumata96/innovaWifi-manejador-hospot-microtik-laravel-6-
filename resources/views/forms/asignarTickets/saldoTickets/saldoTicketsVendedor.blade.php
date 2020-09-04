@extends('layouts2.app')
@section('titulo','Tikets Asignados')

@section('main-content') 
<br>
<div class="row" onload="funload();">
	<div class="col s12 m12 l12">
					  <div class="card">
						 <div class="card-header">                    
							<i class="fa fa-table fa-lg material-icons">receipt</i>
							<h2>LISTA DE TICKETS ASIGNADOS</h2>
						 </div>
						
						 <div class="row card-header sub-header">
							<div class="col s12 m12 herramienta">                         
							              
							</div>  

								  
							
					</div>

					@foreach ($usuarios as $usuario)
						 
					
												 
						 <div class="row cuerpo">
						 
						 <br>
						 <div class="card white">
							<div class="card-content">
								<div class="row">  
                                    <input id="idUsuario" type="hidden" value="{{$usuario->id}}"  >

                                    <div class="input-field col s12 m6 l6">
										<i class="material-icons prefix">assignment</i>
                                    <input id="cantidad" name="cantidad" type="text" value="{{$usuario->nombre." ".$usuario->apellidos}}" style="text-align: center" data-error=".error2"  readonly="readonly" >
										<label for="cantidad"> Vendedor</label>
										<div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
									</div> 
									<div class="input-field col s12 m6 l6">
										<i class="material-icons prefix">assignment</i>
										<input id="cod_alterno" name="cod_alterno" type="Text" value=" {{$usuario->cod_alterno}}" style="text-align: center" data-error=".error2"  readonly="readonly" >
										<label for="cod_alterno"> Código alterno</label>
										<div class="errorTxt1" id="error15" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
									</div> 
									{{-- <div class="input-field col s12 m12 l6">
										<i class="material-icons prefix">comment</i>
										<label for="glosa">Glosa</label>
										<textarea  class="materialize-textarea" name="glosa" > 
										</textarea>
										<div class="errorTxt1" id="error3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
										
									</div>  --}}
								</div>                   
							</div> 
						</div> 
						<div class="card white">
							<div class="card-content"> 
								<div class="row cuerpo">
									 
		 
								 <br>
								 <div class="row">
									<div class="col s12 m12 l12">
									  
										 <div class="card-content">
											 <p id="registros"></p>
											<table id="data-table-simple" class="tablaVendedorSaldoVer responsive-table display centered" cellspacing="0">
												  <thead>
													  <tr>
														  <th>#</th> 
														  <th>Perfil</th>
														  <th>Name</th>
														  <th>Precio</th>
														  <th>Target</th> 
													  </tr>
												  </thead> 
												  <tfoot>
													  <tr>
														  <th class="center"  >#</th> 
														  <th class="center" >Perfil</th>
														  <th class="center" >Name</th>
														  <th class="center" >Precio</th>
														  <th class="center" >Target</th> 
													  </tr>
													</tfoot>
		 
												  <tbody>
													@foreach($data as $val)
														  <tr>{{ $valor->id }}</tr>
														  <tr>{{ $valor->plan }}</tr>
														  <tr>{{ $valor->nombre }}</tr>
														  <tr>{{ $valor->precio }}</tr>
														  <tr>{{ $valor->target }}</tr>

													@endforeach
												  </tbody>
											  </table>
											</div>
									
									</div> 
								 </div>
								 </div>                  
							</div> 
						</div> 
					  </div>
					  @endforeach
					</div>
 </div>


 
@endsection

 

@section('script') 

    
@endsection

