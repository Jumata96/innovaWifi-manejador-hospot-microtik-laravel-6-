<div id="confirmacion4{{$i}}" class="modal" style="width: 500px">
	<div class="modal-content indigo white-text center">
		<p>Está seguro de dar por finalizado este ticket?</p>
	</div>
	<div class="modal-footer indigo lighten-4">
		<a href="#" class="waves-effectwaves-light btn-flat modal-action modal-close">Cancelar</a>
		<a href="{{url('/tickets/Asignados/cerrar')}}/{{$datos->codigo}}" id="Finalizar" class="waves-effect waves-light btn-flat modal-action modal-close">Aceptar</a>
	</div>
</div>

