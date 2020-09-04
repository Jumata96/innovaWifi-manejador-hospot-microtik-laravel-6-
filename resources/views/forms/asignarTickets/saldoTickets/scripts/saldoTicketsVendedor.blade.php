<script type="text/javascript">

contador=0;
 
/* function preloadFunc()
    { */
        var dataId=$('#idUsuario').val(); 
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
                                    var idvendedor=data.idvendedor;
                                    var arrayTickets=data.ARRAY;
                                    var perfiles=data.perfiles;
                                     
                                    console.log(data.perfiles); 
                                    for (x=0;x<arrayTickets.length; x++) {  
                                        if(arrayTickets[x].name.substr(0,3)==cod_alterno){
                                            var perfil=null;
                                            var nombre=null; 
                                            contador +=1;
                                            nombre=arrayTickets[x].name;
                                            perfil=arrayTickets[x].profile;
                                            if(contador==1){
                                                trs=$(".tablaVendedorSaldoVer tbody tr").length; //obtenermos el numero de tr en la tabla  
                                                for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
                                                    $(".tablaVendedorSaldoVer tbody tr:last").remove(); 	
                                                }

                                            }  
                                            for (y=0;y<perfiles.length; y++) { 
                                                if(perfiles[y].name==perfil){
                                                    console.log(perfiles[y]);
                                                    $(".tablaVendedorSaldoVer").append(
                                                        '<tr>'  +
                                                            '<td class="center" >'+contador+'</td>'+
                                                            '<td class="center" >'+perfiles[y].name+' </td>'+
                                                            '<td class="center" >'+nombre+'</td>'+
                                                            '<td class="center" >'+perfiles[y].precio+'</td>'+
                                                            '<td class="center" >'+perfiles[y].rate_limit+'</td>' +
													   ' </tr>'   
                                                    ); 
                                                } 
                                            } 
                                        } 
                                    }
                                    var text = document.createTextNode("Existen "+contador+" registros") 
                                     ;                                    
                                    document.getElementById("registros").appendChild(text); 


                                    if(contador==0){
                                                trs=$(".tablaVendedorSaldoVer tbody tr").length; //obtenermos el numero de tr en la tabla  
                                                for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
                                                    $(".tablaVendedorSaldoVer tbody tr:last").remove(); 	
                                                }
                                                $(".tablaVendedorSaldoVer").append(
                                                    '<tr>'+
                                                        '<td  colspan="5"  ><h4>No se encontró tickets pendientes en el Mikrotick</h4></td>'+
                                                          
													'</tr>'    
                                                );

                                    }
                                       
                                }, 
                                error:function(){ 
                                        alert("error!!!!");
                                }
            });
         
    /* }
    window.onpaint = preloadFunc(); */

</script>