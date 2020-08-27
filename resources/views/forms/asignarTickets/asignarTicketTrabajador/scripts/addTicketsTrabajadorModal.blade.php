<script type="text/javascript">

$('#tipoTicket').on('click',function () { 
    console.log('tipo selec');

    var el = document.getElementById('cantidad'); //se define la variable "el" igual a nuestro div
        el.readOnly =false; 

});

 $("#cantidad").focusout(function() {

    //var data = $(this).val();
    idTicketPerfil=$('#tipoTicket').val();
    cantidad = $('#cantidad').val();

    console.log('ingreso a cantidad');
    if(cantidad!=""){ 
        $.ajax({
            url: "{{ url('/tickets/TiporPerfil/contador') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
            type:'POST',
            url:"{{ url('/tickets/TiporPerfil/contador') }}",
            data:{
                idTicketPerfil:idTicketPerfil,
                cantidad:cantidad
            },

            success:function(data){              
                 
                ticketsAsignados=data.ticketsAsignados;
                ticketsTotal=data.ticketsTotal; 
                ticketsAsignar=data.cantidad; 
                if (ticketsAsignados >= ticketsTotal) {
                    $('#errorModal2').text(" Todos los tickets disponibles fueron asignados"); 
                    
                }else{ 
                    disponibles=ticketsTotal-ticketsAsignados;
                    if(ticketsAsignar >disponibles){
                        $('#cantidad').val("");
                        $('#errorModal2').text(" El tipo de ticket solo tiene  disponibles"+disponibles); 

                    }else{
                        $('#errorModal2').text(""); 

                    }  
                }
                

                

            },

            error:function(){ 
                alert("error!!!!");
        }
        }); 
    }
    
}); 

$('#Asignar').on('click',function () { 
    cantidad = $('#cantidad').val();
    idTicketPerfil=$('#tipoTicket').val();
    idVendedor=$('#idVendedor').val();

    
    console.log(cantidad);
    if(cantidad==""){
        console.log('ingreso');
       // console.log(cantidad,idTicketPerfil);
        $('#errorModal2').text("El campo cantidad es obligatorio."); 
    } 
    else if(idTicketPerfil==null){ 
        $('#errorModal2').text("");
        $('#errorModal1').text("El campo tipo perfil es obligatorio."); 
    }
    else{


        $.ajax({
		url: "{{ url('/tickets/Asignados/grabarTrabajador') }}",
		type:"POST",
		beforeSend: function (xhr) {
			 var token = $('meta[name="csrf-token"]').attr('content');

			 if (token) {
					 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			 }
		},
	  type:'POST',
	  url:"{{ url('/tickets/Asignados/grabarTrabajador') }}",
	  data:{
        cantidad:cantidad,
        idTicketPerfil:idTicketPerfil,
        idVendedor:idVendedor
      },

        success:function(data){ 
            $('#errorModal2').text(""); 
            $('#errorModal1').text(""); 
            $('#cantidad').text(""); 
            $('#tipoTicket').text(""); 

            redirec =  "{{url('tickets/Asignados/AsignarTrabajador/')}}/"+data.idvendedor+"/"+data.idTicket;  
		    setTimeout("location.href='"+redirec+"'", 0000); 
 
            
        },

        error:function(){ 
                alert("error!!!!");
        }
    }); 

          
    }
    
    
});



</script>