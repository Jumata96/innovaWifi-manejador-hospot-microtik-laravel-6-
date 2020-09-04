<script type="text/javascript">
	//--------JMAZUELOS 02/09/2020- ---------------------------------------------------------------
    var contador=0;//contador de filas de la tabla de vendedores 
    var contador2=0;
    var array;

    @foreach ($vendedores as $item)
    idVendedorFor ={{$item->id}}
    $.ajax({
                                url: "{{ url('/tickets/Asignados/Vendedor') }}",
                                /* async:false, */
                                type:"POST",
                                beforeSend: function (xhr) {
                                    var token = $('meta[name="csrf-token"]').attr('content');

                                    if (token) {
                                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                    }
                                },
                                
                                type:'POST', 
                                url:"{{ url('/tickets/Asignados/Vendedor') }}",
                                data:{
                                    idvendedor:idVendedorFor
                                }, 
                                success:function(data){      
                                    /* console.log(data);   */
                                    var cod_alterno=data.alterno;
                                    var cantidad=data.cantidad;
                                    var nombre=data.nombre;
                                    var idvendedor=data.idvendedor;
                                    var arrayTickets=data.ARRAY;
                                    var vendidos=0;
                                    var saldo=0;
                                    contador2+=1; 
                                    //prueba 02
                                    for (x=0;x<arrayTickets.length; x++) {  
                                        if(arrayTickets[x].name.substr(0,cod_alterno.length)==cod_alterno){
                                            saldo+=1;
                                            // console.log(arrayTickets[x].name.substr(0,3),cod_alterno); 
                                        } 
                                    }
                                     vendidos =cantidad-saldo; 
                                    if(contador2==1){
                                        trs=$(".tablaVendedoresSaldo tbody tr").length; //obtenermos el numero de tr en la tabla  
                                        for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
                                            $(".tablaVendedoresSaldo tbody tr:last").remove(); 	
                                        }

                                    } 
                                    $(".tablaVendedoresSaldo").append(  
                                    '<tr >'+
                                       ' <td>'+contador2+'</td>'+
                                        '<td style="width:12em;">'+nombre+'</td>'+
                                        '<td>'+cod_alterno+'</td>'+
                                        '<td>'+cantidad+'</td>'+
                                        '<td>'+saldo+'</td>'+
                                        '<td>'+vendidos+'</td>'+
                                        '<td>'+
                                        '<a id="btnVendedorVer'+contador2+'" onclick="cargar('+contador2+');" class=" btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top"'+ 'data-delay="500" data-tooltip="Ver" data-id="'+idvendedor+'">'+
                                            '<i class="material-icons" style="color: #7986cb ">visibility</i>'+
                                        '</a>'+
    
                                        '</td>'+
                                    '</tr>'  
                                    );
                                    var text = document.createTextNode("Existen "+contador2+" registros");
                                    $("#registrosVendedores").empty() 
                                    document.getElementById("registrosVendedores").appendChild(text);  
                                }, 
                                error:function(){ 
                                        alert("error!!!!");
                                }
            });

                                      
    @endforeach 
    console.log(array);


    // for(x=0;x<arrayTickets.length; x++) { 

    // }
    

    function cargar(valor) {
        console.log(valor);
        idVendedor = $('#btnVendedorVer'+valor).attr("data-id");  
		 redirec =  "{{url('/tickets/Asignados/mostrarVendedor/')}}/"+idVendedor;   
		 var win = window.open(redirec, '_blank'); // Cambiar el foco al nuevo tab (punto opcional)
       	 win.focus();

	} 

    $('.btnSeleccionarVendedor').on('click',function  () {
        var dataId = $(this).attr("data-id");
		var dataNombre = $(this).attr("data-nombre");  
        // console.log(dataId,dataNombre);
         
        /* contador+=1;  */
        $.ajax({
                                url: "{{ url('/tickets/Asignados/Vendedor') }}",
                                /* async:false, */
                                type:"POST",
                                beforeSend: function (xhr) {
                                    var token = $('meta[name="csrf-token"]').attr('content');

                                    if (token) {
                                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                    }
                                },
                                
                                type:'POST', 
                                url:"{{ url('/tickets/Asignados/Vendedor') }}",
                                data:{
                                    idvendedor:dataId 
                                }, 
                                success:function(data){      
                                    /* console.log(data);   */
                                    var cod_alterno=data.alterno;
                                    var cantidad=data.cantidad;
                                    var nombre=data.nombre;
                                    var idvendedor=data.idvendedor;
                                    var arrayTickets=data.ARRAY;
                                    var vendidos=0;
                                    var saldo=0;
                                    contador+=1; 
                                    for (x=0;x<arrayTickets.length; x++) {  
                                        if(arrayTickets[x].name.substr(0,3)==cod_alterno){
                                            saldo+=1;
                                            // console.log(arrayTickets[x].name.substr(0,3),cod_alterno); 
                                        } 
                                    }
                                     vendidos =cantidad-saldo; 
                                    if(contador==1){
                                        trs=$(".tablaVendedoresSaldo tbody tr").length; //obtenermos el numero de tr en la tabla  
                                        for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
                                            $(".tablaVendedoresSaldo tbody tr:last").remove(); 	
                                        }

                                    } 
                                    $(".tablaVendedoresSaldo").append(  
                                    '<tr >'+
                                       ' <td>'+contador+'</td>'+
                                        '<td style="width:12em;" >'+nombre+'</td>'+
                                        '<td>'+cod_alterno+'</td>'+
                                        '<td>'+cantidad+'</td>'+
                                        '<td>'+saldo+'</td>'+
                                        '<td>'+vendidos+'</td>'+
                                        '<td>'+
                                        '<a id="btnVendedorVer'+contador+'" onclick="cargar('+contador+');" class=" btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top"'+ 'data-delay="500" data-tooltip="Ver" data-id="'+idvendedor+'">'+
                                            '<i class="material-icons" style="color: #7986cb ">visibility</i>'+
                                        '</a>'+
    
                                        '</td>'+
                                    '</tr>'  
                                    );
                                    var text = document.createTextNode("Existen "+contador+" registros");
                                    $("#registrosVendedores").empty() 
                                    document.getElementById("registrosVendedores").appendChild(text); 
                                    
                                    

                                    $('#modalAddVendedores').modal('close'); 
                                }, 
                                error:function(){ 
                                        alert("error!!!!");
                                }
            });
                               
         
    });

</script>