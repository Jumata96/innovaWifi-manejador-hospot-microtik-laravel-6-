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
		<div class="col s12">
			<div class="row">
				@if (count($errors)>0)
				<div id="card-alert" class="card red lighten-5">
					<div class="card-content red-text">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
							@endforeach
						</ul>
					</div>
					<button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				@endif
			</div>
		</div>
	   	<form action="{{ url('/ofuscar/resultado') }}" method="POST" accept-charset="UTF-8">
	   	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  	<div class="row">											
				<div class="row">
					<div class="input-field col s12">
						<textarea name="codigo" id="" class="materialize-textarea" placeholder="Copia aqu&iacute; tu c&oacute;digo"></textarea>
						<label for="codigo">Codigo a Ofuscar</label>											
					</div>
				</div>	
				<button class="btn #558b2f light-green darken-3 right" type="submit">Ofuscar
				  <i class="material-icons right">send</i>
				 </button>					
		</div>
		</form>
	  </div>
	</div>
  </div>
</div>
</div>
@endsection

@section('script')

@endsection