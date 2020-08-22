@extends('layouts2.app')
@section('titulo','Campañas')
@section('main-content')
<div id="app">
<br>
<div class="row"> 
  <div class="col s12 m12 l12">
	<div class="card">
		<div class="card-header">                    
		  <i class="fa fa-table fa-lg material-icons">receipt</i>
		  <h2>Campa&ntilde;as</h2>
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
	   	<form action="{{ url('/mails/enviarCampana') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
	   	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  	<div class="row">
			<form class="col s12">
				<div class="row">					
					<div class="col s12 m12">
						<label for="correos">Seleccione los Destinatarios</label>
						<select name="correos[]" id="destino" multiple>
							<option value="" disabled>Selecione Destinatarios</option>
							@foreach($correos as $correo)
							<option value="{{$correo->email}}">{{$correo->email}}</option>
							@endforeach
						</select>													
					</div>
				</div>							
				<div class="row">
					<div class="input-field col s12">
						<input name="asunto" id="asunto" type="text" class="validate" >
						<label for="asunto">Asunto</label>							
					</div>
				</div>
				<div class="row">
				<div class="input-field col s12">						
					<input type="file" id="url_imagen" name="url_imagen">										
				</div>
				</div>
				<div class="row">
					<div class="input-field col s12">					
						<textarea name="contenido" id="editor1" rows="10" cols="80">
                		ESCRIBA UN MENSAJE
            </textarea>					
					</div>
				</div>
				<button class="btn #558b2f light-green darken-3 right" type="submit" v-on:click="enviar" v-if="enviando == 1">Enviar Campaña
				  <i class="material-icons right">send</i>
				 </button>
				 <button class="btn #558b2f light-green darken-3 right" disabled v-else>Enviar Campaña
				  <i class="material-icons right">send</i>
				 </button>
			</form>			
		</div>
		</form>
	  </div>
	</div>
  </div>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>   
  


    var app = new Vue({      
      el: '#app',
      data: {
      	enviando: '1', 
      },
      created: function () {                 
      },
      methods: {       
     	enviar: function(){
           this.enviando = '2';
        }	
       }
    }); 

   CKEDITOR.config.height = 400;
   CKEDITOR.config.width = 'auto';
   CKEDITOR.replace('editor1');    
</script>

@endsection