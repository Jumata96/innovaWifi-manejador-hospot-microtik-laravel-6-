<div id="h_confirmacion3{{$datos->codigo }}" class="modal" style="width: 500px">
	<div class="modal-content teal white-text">
	  <p>Está  seguro que desea habilitar este registro ?</p>
	</div>
	<div class="modal-footer teal lighten-4">
		<a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
	  <a  href="{{url('/tickets/Asignados/habilitar')}}/{{$datos->codigo }}"  class="waves-effect waves-light btn-flat modal-action modal-close" id="h{{$datos->codigo }}" data-idcliente="{{$datos->codigo }}">Aceptar</a>
	</div>
 </div>



 

 


