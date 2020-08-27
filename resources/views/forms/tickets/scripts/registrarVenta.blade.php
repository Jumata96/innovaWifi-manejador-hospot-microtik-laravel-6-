<script type="text/javascript">

    $('#tipoTicket').on('click',function () {  
    
        var el = document.getElementById('cantidad'); //se define la variable "el" igual a nuestro div
            el.readOnly =false; 
           let variable= idTicketPerfil=$('#tipoTicket').val();
           if(variable!=null){

            idTicketPerfil=$('#tipoTicket').val();
            cantidad =0;//se utiliza para ejecutar el ajax no realiza ninguna operacion 
    
             
               $.ajax({
                url: "{{ url('/tickets/contarVentaPerfilAsignado') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
    
                    if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                type:'POST',
                url:"{{ url('/tickets/contarVentaPerfilAsignado') }}",
                data:{
                    idTicketPerfil:idTicketPerfil,
                    cantidad:cantidad
                },
    
                success:function(data){              
                    $('#total').val(data.ticketsDisponibles);  
                },
    
                error:function(){ 
                    alert("error!!!!");
            }
            }); 
           }
    
    });
    
     $("#cantidad").focusout(function() {
    
        //var data = $(this).val();
        idTicketPerfil=$('#tipoTicket').val();
        cantidad = $('#cantidad').val();
    
        console.log('ingreso a cantidad');
        if(cantidad!=""){ 
            $.ajax({
                url: "{{ url('/tickets/contarVentaPerfilAsignado') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');
    
                    if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                type:'POST',
                url:"{{ url('/tickets/contarVentaPerfilAsignado') }}",
                data:{
                    idTicketPerfil:idTicketPerfil,
                    cantidad:cantidad
                },
    
                success:function(data){              
                     
                    ticketsAsignados=data.ticketsAsignados;
                    ticketsDisponibles=data.ticketsDisponibles; 
                    ticketsVender=data.ticketsCantidad;  
                    ticketsItem=data.item;  
                    ticketsPrecio=data.precio;  
                    idPerfil=data.idperfil



                    if (ticketsDisponibles == 0) {
                        $('#errorModal2').text(" Todos los tickets disponibles fueron vendidos"); 
                        
                    }else{ 
                         
                        if(ticketsVender >ticketsDisponibles){
                            $('#cantidad').val("");
                            $('#errorModal2').text(" El tipo de ticket solo tiene  disponibles"+ticketsDisponibles); 
    
                        }else if(ticketsVender <=0 ){
                            $('#cantidad').val("");
                            $('#errorModal2').text(" Este  campo requiere almenos 1 "); 
    
                        } else{
                            $('#errorModal2').text(""); 
                            $('#idTicketAsignadoDet').val(ticketsItem); 
                            $('#precio').val(ticketsPrecio); 
                            $('#idPerfil').val(idPerfil);

                            
                            
    
                        }  
                    }
                    
    
                    
    
                },
    
                error:function(){ 
                    alert("error!!!!");
            }
            }); 
        }
        
    }); 
    
    $('#add').on('click',function () { 
        cantidad = $('#cantidad').val();
        idTicketPerfil=$('#tipoTicket').val(); 
        codigo=$('#codigo').val(); 
        idTicketAsignadoDet=$('#idTicketAsignadoDet').val();
        idPerfil=$('#idPerfil').val();
        precio=$('#precio').val();

        

    
        
        console.log(cantidad);
        if(cantidad==""){
            console.log('ingreso'); 
            $('#errorModal2').text("El campo cantidad es obligatorio."); 
        } 
        else if(idTicketPerfil==null){ 
            $('#errorModal2').text("");
            $('#errorModal1').text("El campo tipo perfil es obligatorio."); 
        }else if(codigo==""){ 
            $('#errorModal2').text("");
            $('#errorModal1').text("Este  campo  es obligatorio."); 
        }
        else{
    
    
            $.ajax({
            url: "{{ url('/tickets/registrarVenta/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                 var token = $('meta[name="csrf-token"]').attr('content');
    
                 if (token) {
                         return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                 }
            },
          type:'POST',
          url:"{{ url('/tickets/registrarVenta/grabar') }}",
          data:{ 
            idTicketPerfil:idTicketPerfil, 
            cantidad:cantidad,
            codigo:codigo,
            idTicketAsignadoDet:idTicketAsignadoDet,
            precio:precio,
            idPerfil:idPerfil 

     

          },
    
            success:function(data){ 
                redirec =  "{{url('/tickets/registrarVenta')}}/";  
		    setTimeout("location.href='"+redirec+"'", 0000); 
     
                
            },
    
            error:function(){ 
                    alert("error!!!!");
            }
        }); 
    
              
        }
        
        
    });
    
    
    
    </script>