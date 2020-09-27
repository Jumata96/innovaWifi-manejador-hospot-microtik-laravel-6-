<script type="text/javascript">
	//--------JMAZUELOS 22/08/2020- ---------------------------------------------------------------
	function cargar(valor) {
		 dataIdVendedor = $('#btnTrabajadorDet'+valor).attr("data-idTrabajador"); 
		 dataIdTicket = $('#btnTrabajadorDet'+valor).attr("data-idTticket");    
		 redirec =  "{{url('tickets/Asignados/AsignarTrabajador/')}}/"+dataIdVendedor+"/"+dataIdTicket;  
		//  setTimeout("location.href='"+redirec+"'", 0000);  
		 var win = window.open(redirec, '_blank');
        // Cambiar el foco al nuevo tab (punto opcional)
       	 win.focus(); 
	}  
	$('.btnSeleccionarTrabajador').on('click',function  () {
		trs=$("#tableTicketsTrabajadores tbody tr").length; //obtenermos el numero de tr en la tabla  
		for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
			$("#tableTicketsTrabajadores tbody tr:last").remove(); 	
		}
		$("#tableTicketsTrabajadores").append(
			'<tr >'+
				'<td colspan="4" >'+
					'<div class="preloader-wrapper big active">'+
						'<div class="spinner-layer spinner-blue-only">'+
							'<div class="circle-clipper left"> <div class="circle"></div> </div>'+
							'<div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right">'+
							'<div class="circle"></div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</td>'+
			'</tr>'  					  
		);  
		$('#addTicketTrabajadores').modal('open');
			var dataIdTicket = $(this).attr("data-idTicket");
			var idZona = $(this).attr("data-idzona");  
			var bandera= null;
			contador =0;
			nombre=null;
			function pintarModal() { 
			  
				trs=$("#tableTicketsTrabajadores tbody tr").length; //obtenermos el numero de tr en la tabla  
				for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
					$("#tableTicketsTrabajadores tbody tr:last").remove(); 	
				}   
				@foreach ($vendedores as $ven) 
					idZonaVen='{{ $ven->idzona }}'; 
					if(idZonaVen==idZona){ 
						contador+=1;
						idvendedor='{{ $ven->id}}';
						$.ajax({
							url: "{{ url('/tickets/Asignados/contarTicketsvendedor2') }}",
							async:false,
							type:"POST",
							beforeSend: function (xhr) {
								var token = $('meta[name="csrf-token"]').attr('content');

								if (token) {
										return xhr.setRequestHeader('X-CSRF-TOKEN', token);
								}
							},
							
							type:'POST', 
							url:"{{ url('/tickets/Asignados/contarTicketsvendedor2') }}",
							data:{
								idticket:dataIdTicket,
								idvendedor:idvendedor
							}, 
							success:function(data){     
								// contadorTickets(dataIdTicket,idvendedor);  
								ventas= data.cantidad;  
								tipos=data.ticketsTipos; 
								idvendedor=data.idvendedor;
								nombre=data.nombre;
								ticketsActivos=data.ticketsActivos; 
								console.log(tipos,ticketsActivos);
								//  if(tipos==ticketsActivos){
									$("#tableTicketsTrabajadores").append(  
										'<tr>'+  
												'<td>'+nombre+' </td>'+  
												'<td>'+ventas+' </td>'+
												'<td>'+tipos+' </td>'+
												'<td class="center" style="width: 9rem">'+ 
													'<a id="btnTrabajadorDet'+contador+'"  onclick="cargar('+contador+');"   class="btnTrabajadorDet btn-floating waves-effect  waves-light grey lighten-5 tooltipped" target="_blank" '+
													'data-position="top" data-delay="500"' +
													'data-idTrabajador="'+idvendedor+'"'+
													'data-idTticket="'+dataIdTicket+'"'+
													'data-tooltip="Editar">'+
														'<i class="material-icons" style="color: #7986cb ">visibility</i>'+
														'</a>' +
												'</td>'+
											'</tr>' 
									);  
								//  }
							}, 
							error:function(){ 
									alert("error!!!!");
							}
						});  
					}
				@endforeach
				if(contador==0){
					$("#tableTicketsTrabajadores").append(  
							'<tr>'+ 
									'<td colspan="4" style="text-align: center;color:red;"><h5>no se registraron vendedores</h5> </td>'+ 
									
								'</tr>' 
						); 

				}
			} 

				$('#cerrarModalVendedores').on('click',function(l){
					bandera ="cerrar";

				});   
				// pintarModal(); 
				var id = setInterval(function(){
					pintarModal(); 
					if(bandera =="cerrar") 
					{
						clearInterval(id);
					}
    			}, 1000); 
 
	
	}); 
	$('.btnVerTrabajador').on('click',function  () {

		trs=$("#tableTicketsTrabajadores tbody tr").length; //obtenermos el numero de tr en la tabla  
		for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
			$("#tableTicketsTrabajadores tbody tr:last").remove(); 	
		}
		$("#tableTicketsTrabajadores").append(
			'<tr >'+
				'<td colspan="4" >'+
					'<div class="preloader-wrapper big active">'+
						'<div class="spinner-layer spinner-blue-only">'+
							'<div class="circle-clipper left"> <div class="circle"></div> </div>'+
							'<div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right">'+
							'<div class="circle"></div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</td>'+
			'</tr>'  
								  
		);  
		$('#addTicketTrabajadores').modal('open');
			  
			var dataIdTicket = $(this).attr("data-idTicket");
			var idZona = $(this).attr("data-idzona");  
			var bandera= null;
			contador =0;
			nombre=null;
			function pintarModal() { 
			  
				trs=$("#tableTicketsTrabajadores tbody tr").length; //obtenermos el numero de tr en la tabla  
				for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
					$("#tableTicketsTrabajadores tbody tr:last").remove(); 	
				}   
				@foreach ($vendedores as $ven) 
					idZonaVen='{{ $ven->idzona }}'; 
					if(idZonaVen==idZona){ 
						contador+=1;
						idvendedor='{{ $ven->id}}';
						$.ajax({
							url: "{{ url('/tickets/Asignados/contarTicketsvendedor2') }}",
							async:false,
							type:"POST",
							beforeSend: function (xhr) {
								var token = $('meta[name="csrf-token"]').attr('content');

								if (token) {
										return xhr.setRequestHeader('X-CSRF-TOKEN', token);
								}
							},
							
							type:'POST', 
							url:"{{ url('/tickets/Asignados/contarTicketsvendedor2') }}",
							data:{
								idticket:dataIdTicket,
								idvendedor:idvendedor
							}, 
							success:function(data){     
								// contadorTickets(dataIdTicket,idvendedor);  
								ventas= data.cantidad;  
								tipos=data.ticketsTipos; 
								idvendedor=data.idvendedor;
								nombre=data.nombre; 
								if(tipos>0){ 								
									$("#tableTicketsTrabajadores").append(  
										'<tr>'+  
												'<td>'+nombre+' </td>'+  
												'<td>'+ventas+' </td>'+
												'<td>'+tipos+' </td>'+
												'<td class="center" style="width: 9rem">'+ 
													'<a id="btnTrabajadorDet'+contador+'"  onclick="cargar('+contador+');"   class="btnTrabajadorDet btn-floating waves-effect  waves-light grey lighten-5 tooltipped" target="_blank" '+
													'data-position="top" data-delay="500"' +
													'data-idTrabajador="'+idvendedor+'"'+
													'data-idTticket="'+dataIdTicket+'"'+
													'data-tooltip="Editar">'+
														'<i class="material-icons" style="color: #7986cb ">visibility</i>'+
														'</a>' +
												'</td>'+
											'</tr>' 
									);
								}  
							}, 
							error:function(){ 
									alert("error!!!!");
							}
						});  
					}
				@endforeach
				if(contador==0){
					$("#tableTicketsTrabajadores").append(  
							'<tr>'+ 
									'<td colspan="4" style="text-align: center;color:red;"><h5>no se registraron vendedores</h5> </td>'+ 
									
								'</tr>' 
						); 

				}
			} 

				$('#cerrarModalVendedores').on('click',function(l){
					bandera ="cerrar";

				});   
				var id = setInterval(function(){
					pintarModal(); 
					if(bandera =="cerrar") 
					{
						clearInterval(id);
					}
    			}, 1000); 
 
	
	}); 

/* 	$('#addTicketTrabajadores').modal({ 
					onCloseEnd: function() { // Callback for Modal close
						alert('Closed');  
					} 
					}
	); */
 
</script>