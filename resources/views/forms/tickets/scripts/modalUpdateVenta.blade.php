<script>
    $('.modalUpdate').on('click',function(){

        var dataId          = $(this).attr("data-id"); 
        var dataIdperfil    =$(this).attr("data-idperfil");
        var dataPerfilNombre  =$(this).attr("data-nombre"); 
        var dataPrecio      =$(this).attr("data-precio");
        var dataCantidad    =$(this).attr("data-cantidad");
        var dataCodigo      =$(this).attr("data-codigo"); 
        console.log(dataId,dataIdperfil,dataPerfilNombre,dataPrecio,dataCantidad,dataCodigo);  
        $('#modalUpdate').modal('open');
        $('#idTicket').val(dataId);
        $('#idPerfilTicket').val(dataIdperfil); 
        $('#perfilTicket').val(dataPerfilNombre);
        $('#cantidadTicket').val(dataCantidad);
        $('#precioTicket').val(dataPrecio);
        $('#codigoTicket').val(dataCodigo); 
    });
    $('#upd').on('click',function(g){
        var data = $('#myForm').serializeArray();
         glosa= $('#glosa').val();
         if(glosa!="") {
            console.log(data);
            $.ajax({
                url: "{{ url('/tickets/Venta/actualizar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                type:'POST',
                url:"{{ url('/tickets/Venta/actualizar') }}",
                data:data,

                    success:function(data){
                        if(data.conforme='registro'){
                             redirec =  "{{url('/tickets/registrarVenta')}}/";  
		                    setTimeout("location.href='"+redirec+"'", 0000); 

                        }
                        
                    },
                    error:function(){ 
                        alert("error!!!!");
                    }
                });  
            
         }
         else{
            $('#errorUpadate5').text("este campo es obligatorio."); 
         }

        


    });
    $('.ModalEliminar').on('click',function(){

    });

    


</script>