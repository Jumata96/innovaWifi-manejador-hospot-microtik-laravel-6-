<script>

	$("#color_perfil_upd").focus(function () {
		$('#modal_colores_upd').modal('open');
	});


$('#guardar_colores_upd').click(function (e) {
	$('#modal_colores_upd').modal('close');

	var color_selc_upd = $('#color_selc_upd').val();
	$('#color').val(color_selc_upd);
});
$('#cancelar').click(function (e) {
	$('#modal_colores_upd').modal('close');
		var color_selc_upd = $('#color_selc_upd').val();
	$('#color').val(color_selc_upd);

});
$(document).ready(function () {
	integrity = "sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	crossorigin = "anonymous"
	$('body').on('click', '.col div', function () {
		$div = this.innerHTML;
		var frutas = this.innerHTML;
		s_obj = new String("foo")
		if( nombreElementoSelc.substr(0,1) =="#"  ){
					// console.log('FRUT',nombreElementoSelc.substr(1,7));
					// console.log('ingresa');
				$('#color_selc_upd').val(nombreElementoSelc.substr(1,7)); 
				$('#color_selc_upd').focus();
		} 

		var el = document.getElementById('iconColor_upd'); //se define la variable "el" igual a nuestro   
		var input = document.getElementById('color_perfil_upd'); //se define la variable "el" igual a nuestro  
		var icon = document.getElementById('iconColor1_upd'); //se define la variable "el" igual a nuestro   
		var inputColor = document.getElementById('color_selc_upd'); //se define la variable "el" igual a nuestro  

		var divColor = document.getElementById('divColor1_upd'); //se define la variable "el" igual a nuestro  


		var colorForm = frutas.substr(1, 7);

		el.style.color = '#' + colorForm;
		input.style.color = '#' + colorForm;
		icon.style.color = '#' + colorForm;
		inputColor.style.color = '#' + colorForm;

		$('#color_perfil_upd').val(frutas.substr(1, 7));
		// $('#color_perfil_upd').focus();

		// divColor.style.backgroundColor = '#'+colorForm; 


	})

});


</script>