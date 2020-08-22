@switch($valida)
	@case(1)
		@section('script')
			<script type="text/javascript">
				// Toast Notification			   
			    setTimeout(function() {
	            	Materialize.toast('<span>Registro exitoso</span>', 1500);
	            }, 100); 
			</script>
		@endsection
		@break

	@case(2)
		@section('script')
			<script type="text/javascript">
				// Toast Notification
				setTimeout(function() {
	            	Materialize.toast('<span>Registro actualizado</span>', 1500);
	            }, 100); 
			</script>
		@endsection
		@break

	@case(3)
		@section('script')
			<script type="text/javascript">
				// Toast Notification
				setTimeout(function() {
	            	Materialize.toast('<span>Registro eliminado</span>', 1500);
	            }, 100); 
			</script>
		@endsection
		@break
@endswitch




