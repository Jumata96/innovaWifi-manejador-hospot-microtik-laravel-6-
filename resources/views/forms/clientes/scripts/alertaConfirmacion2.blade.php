<div id="confirmacion2{{$datos->codigo}}" class="modal" style="width: 500px">
    <div class="modal-content indigo white-text center">
    	<p>Se desabilitará el usuario registrado en el Mikrotik. Está seguro que desea desabilitar este usuario?</p>
    </div>
    <div class="modal-footer indigo lighten-4">
	    <a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
    	<a class="waves-effect waves-light btn-flat modal-action modal-close" id="d{{$datos->codigo}}" data-iddesabilitar="{{$datos->codigo}}">Aceptar</a>
    </div>
</div>