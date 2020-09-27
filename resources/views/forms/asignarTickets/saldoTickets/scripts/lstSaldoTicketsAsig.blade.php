<script>
        //-------------------SELECCIONAR TODO LOS CHECK------------------------
          $(document).on('click','#i_allCheck', function(){  
            cont = parseInt($('#cont').val());
            console.log(cont);

            for (var i = 0; i <= cont; i++) {
              $( "#check"+i ).prop( "checked", true );
            }

          });       

          //--------------------------QUITAR CHECK A TODOS-----------------------------
          $(document).on('click','#i_clearCheck', function(){  
            cont = parseInt($('#cont').val());

            for (var i = 0; i <= cont; i++) {
              $( "#check"+i ).prop( "checked", false );
            }
          }); 
           //--------------------------redirecciona al detall de cada vendedor-----------------------------
            function cargar(valor,item) {
                  
              redirec =  "{{url('/tickets/Asignados/mostrarVendedor/')}}/"+valor+"/"+item;   
              var win = window.open(redirec, '_blank'); // Cambiar el foco al nuevo tab (punto opcional)
                  win.focus();

            }
             //--------------------------realiza el fultro----------- 
          $(document).on('click','#select', function(){  
                cont = parseInt($('#cont').val())+1;
                datos=[];
                contadorFiltro=0;  
                  trs=$(".tablaVendedoresSaldo tbody tr").length; //obtenermos el numero de tr en la tabla  
                    for (var i = 0; i < trs; i++) { //elimnamos los tr de la tabla  (limpiar)
                    $(".tablaVendedoresSaldo tbody tr:last").remove(); 	
                  }  
                for(var i = 1; i <= cont; i++){  
                    var ckec= $( "#check"+i ).prop("checked");  
                    if(ckec){
                      contadorFiltro++; 
                        dataId= $('#checkValue'+i).val(); 
                        // console.log(dataId); 
                        var jArray= <?php echo json_encode($arrayDatos ); ?>;
                        // console.log(jArray);
                        for (x=0;x<jArray.length; x++) {
                          if(jArray[x].id ==dataId ){
                            console.log(jArray[x]);
                            $(".tablaVendedoresSaldo").append(  
                                        '<tr >'+
                                          ' <td>'+jArray[x].cont+'</td>'+
                                            '<td style="width:12em;" >'+jArray[x].nombre+'</td>'+
                                            '<td>'+jArray[x].cod_alterno+'</td>'+
                                            '<td>'+jArray[x].PerfilAsignado+'</td>'+
                                            '<td>'+jArray[x].asignados+'</td>'+
                                            '<td>'+jArray[x].saldo+'</td>'+
                                            '<td>'+jArray[x].diferencia+'</td>'+
                                            '<td>'+
                                            '<a   onclick="cargar('+jArray[x].id+','+jArray[x].item+');" class=" btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top"'+ 'data-delay="500" data-tooltip="Ver">'+
                                                '<i class="material-icons" style="color: #7986cb ">visibility</i>'+
                                            '</a>'+ 
        
                                            '</td>'+
                                        '</tr>'  
                            ); 
                          } 
                        } 
                    }  
                }
                if(contadorFiltro==0){
                  $(".tablaVendedoresSaldo").append(  
                                        '<tr >'+
                                          '<td colspan="7" class="center" > <h4>No se seleccionaron vendedores </h4></td>'+
                                        '</tr>'  
                  );          
                } 
                $('#modalAddVendedores').modal('close'); 
                
                for (var i = 0; i <= cont; i++) {
                $( "#check"+i ).prop( "checked", false );
                }
                
          });
          
    
  </script>