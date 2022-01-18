<script type="text/javascript">

 
 
$('#Asignar').on('click', function () {
	cantidad = $('#cantidad').val();
	selet_id_vendedor = $('#selet_id_vendedor').val();
	selet_id_perfil = $('#selet_id_perfil').val();
	console.log('datos', selet_id_perfil, selet_id_vendedor, cantidad); 

 Materialize.toast('<span style="color:#e65100"><b> CARGANDO...</b> </span>', 1600);
	$.ajax({
		url: "{{ url('/fichasTrabajador/grabar') }}",
		type: "POST",
		beforeSend: function (xhr) {
			var token = $('meta[name="csrf-token"]').attr('content');

			if (token) {
				return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			}
		},
		type: 'POST',
		url: "{{ url('/fichasTrabajador/grabar') }}",
		data: {
			cantidad: cantidad,
			idPerfil: selet_id_perfil, 
			idVendedor: selet_id_vendedor
		},
		success: function (data) { 
			console.log(data['estado'],'estado');
			             $('.error_asignar_perfiles_03').text('');
			             $('.error_asignar_perfiles_02').text('');
			             $('.error_asignar_perfiles_01').text('');
              
              if ( data[0] == "error") {
                
                ( typeof data.idVendedor != "undefined" )? $('.error_asignar_perfiles_01').text(data.idVendedor) : null;
                ( typeof data.idPerfil != "undefined" )? $('.error_asignar_perfiles_02').text(data.idPerfil) : null;
                ( typeof data.cantidad != "undefined" )? $('.error_asignar_perfiles_03').text(data.cantidad) : null; 
              } else {   

															    if(data['estado']=="Nocreado"){
                        Materialize.toast('<span style="color:#e65100"><b>Perfil no existe en el RB.</b>  </span>', 1600);
                    }else{
                      $('#AsignarTickets').modal('close');
                        Materialize.toast('<span style="color:#e65100"><b> creado en el RB.</b> </span>', 1600);
																						
                      location.reload();   
                    } 
              } 


		},

		error: function () {
			// alert("error!!!!");
		}
	}); 

});


  $('#cantidad').focusout(function () {
    console.log('ingreso  a cantidad');
				cantidad = $('#cantidad').val();
    if(cantidad<5){
			 $('.error_asignar_perfiles_03').text("La cantidad ingresada debe de ser mayor a 5 ");
      	// console.log('cantidad errro');
			cantidad = $('#cantidad').val('0');


    }
 
});

	function limpiarTabla(){
		// console.log('ingresa a eliminar');
		//limpiar los elemetos de la tabla 
		var trs=$("#data-table-simpleI tbody tr").length; //obtenermos el numero de tr en la tabla  
		// console.log(trs);
		//elimnamos los tr de la tabla 
		for (var i = 0; i < trs; i++) {
			$("#data-table-simpleI tbody tr:last").remove();
			
		} 
	}

 




</script>