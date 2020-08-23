<script type="text/javascript">
	//--------JMAZUELOS 22/08/2020- ---------------------------------------------------------------
	function cargar(valor){ 
		var dataIdTicket = $('.btnTrabajadorDet').attr("data-idTrabajador");  
		console.log(dataIdTicket);
		//window.location = "{{ url('/asignar') }} {{   }}";

	}
	$('.btnSeleccionarTrabajador').on('click',function () {
			var dataIdTicket = $(this).attr("data-idTicket");
			var idZona = $(this).attr("data-idzona");  
			contador =0;
			nombre=null;  
			 trs=$("#tableTicketsTrabajadores tbody tr").length; //obtenermos el numero de tr en la tabla  
			 
			//elimnamos los tr de la tabla 
			for (var i = 0; i < trs; i++) {
				$("#tableTicketsTrabajadores tbody tr:last").remove();
				
			}  
		@foreach ($vendedores as $ven) 
			idZonaVen='{{ $ven->idzona }}'; 
			if(idZonaVen==idZona){
				contador+=1;
				nombre='{{ $ven->nombre }}';
				idvendedor='{{ $ven->id}}'; 
				//console.log(contador);

				$("#tableTicketsTrabajadores").append(  
					'<tr>'+ 
							'<td>'+contador+' </td>'+ 
							'<td>'+nombre+' </td>'+  
							'<td class="center" style="width: 9rem">'+ 
								'<a  onclick="cargar('+contador+');"  class="btnTrabajadorDet btn-floating waves-effect  waves-light grey lighten-5 tooltipped" '+
								'data-position="top" data-delay="500"' +
								'data-idTrabajador="'+idvendedor+'"'+
								'data-tooltip="Editar">'+
									'<i class="material-icons" style="color: #7986cb ">visibility</i>'+
									'</a>' +
							'</td>'+
						'</tr>' 
				); 


			}
		@endforeach
		if(contador==0){
			$("#tableTicketsTrabajadores").append(  
					'<tr>'+ 
							'<td colspan="3" style="text-align: center;color:red;"><h5>no se registraron vendedores</h5> </td>'+ 
							 
						'</tr>' 
				); 

		}
		
	//console.log(dataIdTicket,idZona);
	$('#addTicketTrabajadores').modal('open');  
	
	});

	$('.btnTrabajadorDet').on('click',function (l) {
		var dataIdTicket = $(this).attr("data-idTrabajador");  
		window.location = "{{ url('/empresas') }} ";
						

		 
	});
 
</script>