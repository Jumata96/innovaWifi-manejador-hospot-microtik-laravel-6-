<script>
     
	$("#color").focus(function(){ 
		$('#modal1').modal('open');

		/*$.ajax({
			 url: "{{ url('/recibir') }}",
			 type:"POST",
			 beforeSend: function (xhr) {
				  var token = $('meta[name="csrf-token"]').attr('content');

				  if (token) {
						  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
				  }
			 },
			type:'POST',
			url:"{{ url('/recibir') }}",
			data:{
				idrouter:$('#idrouter').val()
			},

			success:function(data){
			  

			},
			error:function(){ 
				alert("error!!!!");
		}

		});*/


 });  
 $('#guardar').click( function(e) {
	$('#modal1').modal('close');
	
	var color1 = $('#color1').val();
	$('#color').val(color1); 
 } );
 $('#cancelar').click( function(e) {
	$('#modal1').modal('close');
	 
 } );
 $(document).ready(function(){
	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	crossorigin="anonymous"
	$('body').on('click', '.col div', function(){ 
	 $div = this.innerHTML;
	 var frutas = this.innerHTML;
	 s_obj = new String("foo")
	 console.log(frutas.substr(1,7));  
	 //$('#color').val(frutas.substr(1,7));
	 $('#color1').val(frutas.substr(1,7)); 
	 $('#color1').focus();

	 var el = document.getElementById('iconColor'); //se define la variable "el" igual a nuestro   
		var input = document.getElementById('color'); //se define la variable "el" igual a nuestro  
		var icon = document.getElementById('iconColor1'); //se define la variable "el" igual a nuestro   
		var inputColor = document.getElementById('color1'); //se define la variable "el" igual a nuestro  

		var colorForm=frutas.substr(1,7); 
		
		el.style.color = '#'+colorForm;  
		input.style.color = '#'+colorForm; 
		icon.style.color = '#'+colorForm;  
		inputColor.style.color = '#'+colorForm; 
		




	})
	 
 });
  

</script>
