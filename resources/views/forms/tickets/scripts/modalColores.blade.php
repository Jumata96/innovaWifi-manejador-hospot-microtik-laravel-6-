<script>
     
	$("#color").focus(function(){ 
		$('#modal1').modal('open');
 }); 
		$("#color_upd").focus(function(){ 
		$('#modal1').modal('open');
 });  

 $('#guardar').click( function(e) {
	$('#modal1').modal('close');
	
	var color1 = $('#color1').val();
	$('#color').val(color1); 
	$('#color_upd').val(color1); 


		var iconColor_Crt = document.getElementById('iconColor'); //se define la variable "iconColor_Crt" igual a nuestro   
		var input = document.getElementById('color'); //se define la variable "iconColor_Crt" igual a nuestro  
		iconColor_Crt.style.color = color1;  
		input.style.color = color1; 

			var iconColor_upd = document.getElementById('iconColor_upd'); //se define la variable "iconColor" igual a nuestro   
		var input_upd = document.getElementById('color_upd'); //se define la variable "iconColor" igual a nuestro  
		iconColor_upd.style.color = color1;  
		input_upd.style.color = color1; 


 } );


 $('#h_cerrar').click( function(e) {
					$('#modal1').modal('close'); 
					var color1 = $('#color1').val();
					// console.log(color1 ,"colr cerar");
					$('#color').val(color1); 
					$('#color_upd').val(color1); 

					

	 
 } );
 $(document).ready(function(){
	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	crossorigin="anonymous"
	$('body').on('click', '.col div', function(){ 
		var nombreElementoSelc=null;
	 $div = this.innerHTML;
	  nombreElementoSelc = this.innerHTML;
	 s_obj = new String("foo") ;
		if( nombreElementoSelc.substr(0,1) =="#"  ){
					// console.log('FRUT',nombreElementoSelc.substr(1,7));
					// console.log('ingresa');
				$('#color1').val(nombreElementoSelc.substr(1,7));  
				$('#color1').focus(); 
		}  
		var icon = document.getElementById('iconColor1'); //se define la variable "el" igual a nuestro   
		var inputColor = document.getElementById('color1'); //se define la variable "el" igual a nuestro  
		var divColor = document.getElementById('divColor1'); //se define la variable "el" igual a nuestro   
		var colorForm=nombreElementoSelc.substr(1,7);  
		icon.style.color = '#'+colorForm;  
		inputColor.style.color = '#'+colorForm; 
		// divColor.style.backgroundColor = '#'+colorForm; 
		




	})
	 
 });
  

</script>
