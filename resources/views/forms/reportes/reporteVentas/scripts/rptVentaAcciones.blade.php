<script>
      var seleccionZona=null;   
        $(document).on('focus', '#autocompletarZonas', function () { //autompletado de zonas llena el array en el elemento 
            var jArray= <?php echo json_encode($arrayZonas ); ?>; 
            seleccionZona="";   
            $(this).autocomplete({
                //source take a list of data
                source:jArray,
                minLength: 1,
                select: function (event, ui) {    
                    seleccionZona=ui.item.id ;
                    return true;
                },   
            }); 
        }); 
        //validacion del modal que se abre 
         $("#idLocalNames").on('click',function() {   
              var trs=$("#tablaFiltroVendedores tbody tr").length; //obtenermos el numero de tr en la tabla  
              if(trs==0){ 
                    $("#tablaFiltroVendedores").append(  
                      '<tr > ' +
                        '<td colspan="3" class="center" >'+
                          ' <h5 style="color: red;">Seleccionar punto de venta</h5>'+
                        '</td>' +
                      '</tr>'               
                    );
              }
              $("#modalAddVendedores").modal({
                escapeClose: false,
                clickClose: false,
                showClose: false
              }); 
         });
         //obtenemos el dato de la zona y preparamos los modals 
        $("#autocompletarZonas").focusout(function() {  
            $('#PuntoVentaFiltrado').val(seleccionZona);  
            $('#idLocalNames').prop('readonly', false);
             var usersArray= <?php echo json_encode($arrayFiltro ); ?>; 
             var contador=0;
             arrayFiltrado=[];   
             var trFiltro=$("#tablaFiltroVendedores tbody tr").length;//limpiamos la tabla de algun filtro anterior
               if(trFiltro>0){ 
                 for (var i = 0; i < trFiltro; i++) {
                    $("#tablaFiltroVendedores tbody tr:last").remove(); 
                  }  
               } 
             
             for (x=0;x<usersArray.length; x++) { 
               if(usersArray[x].idZona==seleccionZona){ 
                  arrayFiltrado.push(usersArray[x]); 
                }
                
             } 

             
             for (z=0;z<arrayFiltrado.length; z++) {//pintamos la tabla con los usuarios filtrados 
               contador+=1;
               $("#tablaFiltroVendedores").append(  
                  '<tr> ' +
                      '<td style="width: 5%;" >'+contador+'</td>'+
                      '<td style="width: 10%;">'+
                       ' <p class="center"> ' +
                          '<input  id="check'+contador+'"  type="checkbox"  class="filled-in" name="check'+contador+'"/>'+
                          '<label  for="check'+contador+'">'+
                          '</label>'+
                          '</p>' +

                      '</td>'+
                      '<input type="hidden" name="checkValue'+contador+'" id="checkValue'+contador+'" value="'+arrayFiltrado[z].id+'">'+
                      '<td style="width: 60%;">'+arrayFiltrado[z].value+'</td>'+
                    '</tr>'                          
               ); 
             }  

             $('#contadorChecks').val(contador);
        }); 
        //obtenemos los vendedores seleccionados del modal 
         $('#select').on('click',function( ){ 
           var contadordeChechs= $('#contadorChecks').val(); 
           var totalVendedores=0 
           if(contadordeChechs!=0){ 
             for(var i = 1; i <= contadordeChechs; i++){  
                    var ckec= $( "#check"+i ).prop("checked");  
                    if(ckec){
                      dataId= $('#checkValue'+i).val(); 
                      console.log(dataId); 
                        $('<input/>').attr({type:'hidden',value:dataId ,name:'vendedor'+i}).appendTo('#frmReport');
                        totalVendedores+=1; 
                    }
             }
             $('#contadorVendedores').val(contadordeChechs); 
           }

         }); 
         //verificamos el estado de los checks y activamos y desactivamos todos (modal) 
         $(document).on('click','#checkFiltro', function(){  
           var ckec= $( "#checkFiltro" ).prop("checked");
           cont = parseInt($('#contadorChecks').val()); 
            if(ckec){//si se da clic en el ck se pone a true y si es true todos deben ser true 
              for (var i = 0; i <= cont; i++) {
                $( "#check"+i ).prop( "checked", true );
                }
                 $( "#checkFiltro").prop( "checked", true );   
            } 
            else{
              for (var i = 0; i <= cont; i++) {
                $( "#check"+i ).prop( "checked", false );
                }
                 $( "#checkFiltro").prop( "checked", false );  
             }
        });  

</script>