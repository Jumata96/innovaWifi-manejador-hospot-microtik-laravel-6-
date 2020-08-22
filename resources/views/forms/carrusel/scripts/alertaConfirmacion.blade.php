<div id="confirmacion{{$i}}" class="modal" style="width: 500px">
	<div class="modal-content indigo white-text center">
		<p>Está seguro que desea eliminar este registro?</p>
	</div>
	<div class="modal-footer indigo lighten-4">
		<a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
		<a href="#" id="e{{$datos->id}}" class="waves-effect waves-light btn-flat modal-action modal-close" data-ideliminar="{{$datos->id}}" >Aceptar</a>
	</div>
</div>