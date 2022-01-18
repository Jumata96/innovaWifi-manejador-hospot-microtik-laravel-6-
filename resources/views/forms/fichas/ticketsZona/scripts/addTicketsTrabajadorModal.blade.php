<script type="text/javascript">

$('#selet_id_vendedor').focusout(function () {
	// console.log('ingreso');
 		document.getElementById("historial_perfiles_asignados").style.display = "block"; 


	let id_vendedor = $('#selet_id_vendedor').val(); 
	if (id_vendedor != null) { 
		$.ajax({
			url: "{{ url('/fichasAsignados/trabajador') }}",
			type: "POST",
			beforeSend: function (xhr) {
				var token = $('meta[name="csrf-token"]').attr('content');

				if (token) {
					return xhr.setRequestHeader('X-CSRF-TOKEN', token);
				}
			},
			type: 'POST',
			url: "{{ url('/fichasAsignados/trabajador') }}",
			data: {
				id_vendedor: id_vendedor, 
			},

			success: function (data) {
				 // console.log('datos',data);
				// console.log('totales',data.totales); 
					limpiarTabla();
					$('#totalRegistros').text("");
					$('#totalAsignados').text("");
					$('#totalVendidos').text("");
					$('#totalSaldo').text(""); 
				
				if(data.array.length>=1){
					var perfilesArray=data.array;
					for(var i=0;i<perfilesArray.length;i++){
						var contador=i+1;
					
							$("#data-table-simpleI").append( "<tr> "+
								"<td>"+contador+"</td>"+
								"<td>"+perfilesArray[i]['Vendedor']+"</td>"+
								"<td>"+perfilesArray[i]['perfil']+"</td>"+
								"<td>"+perfilesArray[i]['asignado']+"</td>"+
								"<td>"+perfilesArray[i]['vendido']+"</td>"+
								"<td>"+perfilesArray[i]['saldo']+"</td>"+ 
								+"</tr>  ");
					}
 
			 $('#totalRegistros').text(data.array.length);
			 $('#totalAsignados').text(data.totales[0]["Asignados"]);
			 $('#totalVendidos').text(data.totales[0]["Vendido"]);
			 $('#totalSaldo').text(data.totales[0]["Saldo"]); 

				}else{ 
									$("#data-table-simpleI").append( "<tr> <td colspan='6'  style='color: red'><center>NO TIENE PERFILES ASIGNADOS</center></td> </tr> ");
									
				}
				// console.log('datos de retorno ' , data);

				// cantidadDisponible = data.ticketsTotal - data.ticketsAsignados;
				// $('#total').val(cantidadDisponible);
				// if (cantidadDisponible > 0) { 
				// 			document.getElementById("historial_perfiles_asignados").style.display = "block"; 

				// }

			},

			error: function () {
				alert("error!!!!");
			}
		});
	}

});
 
$('#Asignar').on('click', function () {
	cantidad = $('#cantidad').val();
	selet_id_vendedor = $('#selet_id_vendedor').val();
	selet_id_perfil = $('#selet_id_perfil').val();
 Materialize.toast('<span style="color:#e65100"><b></b> CARGANDO....</i></span>', 1600);

	// console.log('datos', selet_id_perfil, selet_id_vendedor, cantidad);
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
      $('.error_asignar_perfiles_03').text('');
			$('.error_asignar_perfiles_02').text('');
			$('.error_asignar_perfiles_01').text('');
			             
              
              if ( data[0] == "error") {
                
                ( typeof data.idVendedor != "undefined" )? $('.error_asignar_perfiles_01').text(data.idVendedor) : null;
                ( typeof data.idPerfil != "undefined" )? $('.error_asignar_perfiles_02').text(data.idPerfil) : null;
                ( typeof data.cantidad != "undefined" )? $('.error_asignar_perfiles_03').text(data.cantidad) : null; 
              } else {    

                    if(data['estado']=="Nocreado"){
                        Materialize.toast('<span style="color:#e65100"><b></b> Perfil no existe en el RB.</i></span>', 1600);
                    }else{
                      $('#AsignarTickets').modal('close');
																						  Materialize.toast('<span style="color:#e65100"><b></b> REGISTRADO.</i></span>', 1600);
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
			cantidad = $('#cantidad').val('5');


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