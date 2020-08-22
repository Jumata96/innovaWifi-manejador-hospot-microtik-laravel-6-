<script type="text/javascript">
cantidadTotal
	 
	var detalle = [];  
	var contadorConceptos=0;  
	var total=0;
	var =0;
	//---JMAZUELOS-21-08-2020----------------GRABAR-----------------------------

	function eliminar_elemento(valor){ 
		$('#EliminarConcepto').modal('open');
		$('#cancelarVerificacion').on('click',function (j) {
			valorEliminado=$("input[name=des"+valor+"]").val(); 
			cantidadTotal -=parseInt(valorEliminado); 
			$('#cantidad').val(parseInt(cantidadTotal)); 
			ActualizarDescuento();
			fila='fila'+valor;//--id del tr a eliminar   
			//-buscar y eliminar el elemnto  de la tabla
			for (var i = 0; i < detalle.length; i++) { 
				//detalle[i][0]-id del array
				//detalle[i][1]-elemento html del array 
				if(detalle[i][0]==fila){
					detalle.splice(i,1); 
				}  
			}  
			//------------captar descuento ingresado en la vista y guardarlo en el array 
			limpiarTabla();//funcion para limpiar tabla  
			pintarTabla(detalle)////agregamos los nuevos elementos a la tabla 
			//-------pintar el descuento ingresado en el array y mostrarlo en la vista
			ActualizarDescuentoTabla();
			//console.log(detalle);  
			
		});   
	} 
	//---------------JMAZUELOS 23/07/2020-limpiar datos de la tabla -------------------------------------------------------- 
	function limpiarTabla(){
		//limpiar los elemetos de la tabla 
		var trs=$("#tableProformaDetalle tbody tr").length; //obtenermos el numero de tr en la tabla  
		//elimnamos los tr de la tabla 
		for (var i = 0; i < trs; i++) {
			$("#tableProformaDetalle tbody tr:last").remove();
			
		} 
	}
	//---------------JMAZUELOS 23/07/2020-pintar datos de la tabla -------------------------------------------------------- 

	function pintarTabla(detalle1){
		//agregamos los nuevos elementos a la tabla  
		for (var i = 0; i < detalle1.length; i++) {
			$("#tableProformaDetalle").append( detalle1[i][1]);
		} 
	} 
	//------------captar descuento ingresado en la vista y guardarlo en el array
	function ActualizarDescuento(){
		if(detalle.length >0) {//---------verificamos que existan elementos en el detalle
			detalleId=0;
			for (var i = 0; i < detalle.length; i++) { 
				//detalle[i][0]-id del array
				//detalle[i][1]-elemento html del array  
				detalleId=i+1; 
				detalle[i][8]=$("input[name=des"+detalleId+"]").val();  
			}  
		} 
	} 
	//-------pintar el descuento ingresado en el array y mostrarlo en la vista
	function ActualizarDescuentoTabla(){
		if(detalle.length >0) {//---------verificamos que existan elementos en el detalle
			detalleId=0;
			for (var i = 0; i < detalle.length; i++) {  
					detalleId=i+1; //id del input descuento 
				$('#des'+detalleId).val(detalle[i][8]);  
			}  
		}  
	}
	
	//---------------JMAZUELOS 23/07/2020- DATOS DEL PLAN------------------------------------------------------------------------	
	$('.btnSeleccionar').on('click',function () { 
		var dataId = $(this).attr("data-id"); 
		cantidad=$("input[name=cant"+dataId+"]").val();  //obtenner el descuento 
		var name = $(this).attr("data-name");
		var precio = $(this).attr("data-precio");
		var vsubida = $(this).attr("data-vsubida");
		var vbajada = $(this).attr("data-vbajada"); 
		var target = $(this).attr("data-target"); 
		cantidadTotal +=parseInt(cantidad); 
		$('#cantidad').val(parseInt(cantidadTotal)); 
		
		//console.log(cantidad); 
		if(cantidad==null){
			cantidad=0; 
		}
		//console.log(cantidad);
		descripcion="Servicio de Internet Banda ancha:  Plan de Internet-"+name+"  velocidades-"+target;
		contadorConceptos +=1;   

		//------------captar descuento ingresado en la vista y guardarlo en el array
		ActualizarDescuento();  
		//------------agregar el nuevo tr al array 
		detalle.push( ['fila'+contadorConceptos,'<tr id="fila'+contadorConceptos+'" class="center">'  +
				'<td class="center">'+contadorConceptos+' </td>'+  
				'<td class="center"> '+name+'<br> '+target+' </td>'+
				'<td class="center"   id="precio'+contadorConceptos+'"   name="precio'+contadorConceptos+'" > '+precio+' </td> '+
				'<td class=" col s12 m5 l6 offset-l3"><input id="des'+contadorConceptos+'"  value="'+cantidad+'" name="des'+contadorConceptos+'" type="number" > </td> '+
				'<td class="center">'+ 
					'<a onclick="eliminar_elemento( '+contadorConceptos+');" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">delete</i></a>' 
				+' </td> '+  
			'</tr>','PLAN',dataId,'SERVICIO DE  INTERNET',descripcion,precio,contadorConceptos,cantidad ]  
		);

		limpiarTabla();//funcion para limpiar tabla  
		pintarTabla(detalle)////agregamos los nuevos elementos a la tabla  
		$('#modalAddPlan').modal('close');//cerramos el modal
		//-------pintar el descuento ingresado en el array y mostrarlo en la vista
		ActualizarDescuentoTabla();

		
		//console.log(detalle); 
	}); 
 
 $('#addTickets').click(function(e){
		e.preventDefault();
		

		

		if(detalle.length != 0 ){
			totalC=0;
			for (var i = 0; i < detalle.length; i++) { 
				totalC +=cantidad=parseInt($("input[name=des"+detalle[i][7]+"]").val()); 
			}  
			 
			$('#cantidad').val(parseInt(totalC)); 

			var data = $('#myForm').serializeArray(); 
			console.log(data);
			$.ajax({
				url: "{{ url('/tickets/Asignados/grabar') }}",
				type:"POST",
				beforeSend: function (xhr) {
					var token = $('meta[name="csrf-token"]').attr('content');

					if (token) {
							return xhr.setRequestHeader('X-CSRF-TOKEN', token);
					}
				},
				type:'POST',
				url:"{{ url('/tickets/Asignados/grabar') }}",
				data:data,

				success:function(data){
					
					if ( data[0] == "error") {
						( typeof data.puntoDeVenta != "undefined" )? $('#error1').text(data.puntoDeVenta) && $('#puntoDeVenta').focus() : null;
						( typeof data.cantidad != "undefined" )? $('#error2').text(data.cantidad) : null;
						( typeof data.glosa != "undefined" )? $('#error3').text(data.glosa) : null;

						// ( typeof data.nombre != "undefined" )? $('#error2').text(data.nombre) : null; 
									
					} else {   

						var codigo =data.codigo ;

						//alert(data.success);
						/*  setTimeout(function() {
							Materialize.toast('<span style="color:#e65100"><b></b> Registrado.</i></span>', 500);
					}, 000);  */
						//

							for (var i = 0; i < detalle.length; i++) {
								conceptoId=detalle[i][3];//obtenemos el id del plan guardado en el array
								Concepto=detalle[i][4];//obtenemos el concepto guardado en el array
								descripcion=detalle[i][5];//obtenemos la descripcion guardado en el array
								precio=detalle[i][6];  //obtenemos el precio guardado en el array
								cantidad=$("input[name=des"+detalle[i][7]+"]").val();  //obtenner el cantidad ingresado en la vista
								 
				 

								if(detalle[i][2]=='PLAN'){
									$.ajax({
										url: "{{ url('/tickets/Asignados/grabarDetalle') }}",
										type:"POST",
										beforeSend: function (xhr) {
											var token = $('meta[name="csrf-token"]').attr('content');
						
											if (token) {
													return xhr.setRequestHeader('X-CSRF-TOKEN', token);
											}
										},
										type:'POST',
										url:"{{ url('/tickets/Asignados/grabarDetalle') }}",
										data:{
											conceptoId		:conceptoId,
											Concepto		:Concepto,
											descripcion	:descripcion,
											precio		:precio,
											cantidad	:cantidad, 
											codigo	: codigo  

										},
						
										success:function(data){
											
											if ( data[0] == "error") {
												( typeof data.puntoDeVenta != "undefined" )? $('#error1').text(data.puntoDeVenta) && $('#puntoDeVenta').focus() : null;
												( typeof data.cantidad != "undefined" )? $('#error2').text(data.cantidad) : null;
												( typeof data.glosa != "undefined" )? $('#error3').text(data.glosa) : null;
						
												// ( typeof data.nombre != "undefined" )? $('#error2').text(data.nombre) : null; 
															
											} else {   
						
												//alert(data.success);
												/*setTimeout(function() {
													Materialize.toast('<span style="color:#e65100"><b></b> Registrado.</i></span>', 500);
											}, 000);*/
												//window.location="{{ url('/tickets/Asignar') }}";
						
											}
											
										},
						
										error:function(){ 
											alert("error!!!!");
											}
									});
									 
								}
							}


							setTimeout(function() {
													Materialize.toast('<span style="color:#e65100"><b></b> Registrado.</i></span>', 500);
											}, 000);
							window.location="{{ url('/tickets/Asignar') }}";

						

					}
					
				},

				error:function(){ 
					alert("error!!!!");
					}
			});

			   
		}else{
			limpiarTabla();
			$("#tableProformaDetalle").append( 
				'<tr  >'+ 
					'<td colspan="6" style="text-align: center; text: red;" > <H5 style="color: red;">'+
						 'El campo detalle es obligatorio</H5> </td>' +
				'</tr> ' 
			); 
			console.log( "no data"); 

		} 
		
		

  
  
 });    

</script>