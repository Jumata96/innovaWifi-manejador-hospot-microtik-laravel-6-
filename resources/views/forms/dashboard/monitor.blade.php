
<div class="container">


<div class="row">
	<div class="col s12 m6 l6">       	
		<select class="browser-default" id="idrouter" name="idrouter"> 
	        <option value="" disabled="" selected="">Elija un router</option>
	        @foreach ($router as $valor)
	        @if($valor->idrouter == $idrouter)
	        	<option value="{{ $valor->idrouter }}" selected="">{{ $valor->alias }}</option>
	        @else
	        	<option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
	        @endif
	        @endforeach
        </select>        
	</div>
	<div class="col s12 m6 l6">       	
		<select class="browser-default" id="interface" name="interface" > 
	        <option value="LAN" disabled="" selected="">Seleccionar interface</option>
        </select>        
	</div>

</div>	

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
   
<br>


