<script type="text/javascript">
  //---------JPaiva--14-01-2019---------VALIDAR INPUT-----------------------------------
	@foreach($parametros as $parametro)
		@if($parametro->parametro == "DIA_FECHA_VENC")
			$('#DIA_FECHA_VENC').mask('09', {reverse: false});
		@endif
		@if($parametro->parametro == "VALOR_IGV")
			$('#VALOR_IGV').mask('09', {reverse: false});
		@endif
		@if($parametro->parametro == "LOCAL_ADDR")
			$('#LOCAL_ADDR').mask('099.099.099.099');
		@endif
		@if($parametro->parametro == "DIA_GENERACION_FAC")
			$('#DIA_GENERACION_FAC').mask('09', {reverse: false});
		@endif
		@if($parametro->parametro == "DIA_PAGO_CLIENTES")
			$('#DIA_PAGO_CLIENTES').mask('09', {reverse: false});
		@endif
	@endforeach  
</script>