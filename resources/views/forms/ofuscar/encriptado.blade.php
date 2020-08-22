@extends('layouts2.app')
@section('titulo','OFUSCAR CODIGO')
@section('main-content')
<div id="app">
<br>
<div class="row"> 
  <div class="col s12 m12 l12">
	<div class="card">
		<div class="card-header">                    
		  <i class="fa fa-table fa-lg material-icons">receipt</i>
		  <h2>OFUSCAR CODIGO</h2>
		</div> 		    
	  <div class="card-content">
		@if (session('success')) 
			<div class="col s12">
				<div class="row">
					<div id="card-alert" class="card green">
						<div class="card-content white-text">
							<p>&Eacute;XITO! : {{session('success')}}</p>
						</div>
						<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
			</div>
		@endif	   
	   	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  	<div class="row">	
	  		    <div class="row">
					<div class="input-field col s12">
						<textarea name="codigo" id="" class="materialize-textarea">{{$texto}}</textarea>
						<label for="codigo">Codigo ingresado</label>												
					</div>
				</div>										
				<div class="row">
					<div class="input-field col s12">
						<textarea name="codigo" id="" class="materialize-textarea">{{$encriptado}}</textarea>
						<label for="codigo">Codigo a Ofuscado</label>												
					</div>
				</div>					
				<a href="{{url('/ofuscar')}}" class="btn #558b2f light-green darken-3 right">Ofuscar otra cosa<i class="material-icons right">send</i></a>					
		</div>		
	  </div>
	</div>
  </div>
</div>
</div>
@endsection

@section('script')

@endsection