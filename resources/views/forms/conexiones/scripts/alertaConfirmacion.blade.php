<div id="confirmacion{{$i}}" class="modal" style="width: 500px">
	<div class="modal-content indigo white-text center">
		<p>Está seguro que desea desconectar este usuario?</p>
	</div>
	<div class="modal-footer indigo lighten-4">
		<a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
		<a href="{{url('/desconectar')}}/{{$collection[$i]['.id']}}/{{$collection[$i]['idrouter']}}" id="e{{$i}}" class="waves-effect waves-light btn-flat modal-action modal-close" data-ideliminar="{{$i}}" >Aceptar</a>
	</div>
</div>