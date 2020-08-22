	<script>
		
		$("#color").focus(function(){ 
			$('#modalcolores').modal('open'); 


	}) ;
	$('#guardar').click( function(e) {
		$('#modalcolores').modal('close');
		
		var color1 = $('#color1').val();
		$('#color').val(color1); 
	} );
	$('#cancelar').click( function(e) {
		$('#modalcolores').modal('close');
		
	} );
	$(document).ready(function(){
		
		$('body').on('click', '.col div', function(){ 
		$div = this.innerHTML;
		var colores = this.innerHTML; 
		console.log(colores.substr(1,7),"est es");  
		//$('#color').val(colores.substr(1,7));
		$('#color1').val(colores.substr(1,7)); 
		$('#color1').focus(); 
		var el = document.getElementById('iconColor'); //se define la variable "el" igual a nuestro   
		var input = document.getElementById('color'); //se define la variable "el" igual a nuestro  
		var icon = document.getElementById('iconColor1'); //se define la variable "el" igual a nuestro   
		var inputColor = document.getElementById('color1'); //se define la variable "el" igual a nuestro  

		var colorForm=colores.substr(1,7); 
		
		el.style.color = '#'+colorForm;  
		input.style.color = '#'+colorForm; 
		icon.style.color = '#'+colorForm;  
		inputColor.style.color = '#'+colorForm; 
		
		
		



		})
		
	});
	

	</script>