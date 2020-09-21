<script>
    $('.btnEliminarZona').on('click',function(){
        // console.log('ingreso');
        var id = $(this).attr("data-id");
        console.log(id);
        $.ajax({
		url: "{{ url('/zonas/validarEliminacion') }}",
		type:"POST",
		beforeSend: function (xhr) {
			 var token = $('meta[name="csrf-token"]').attr('content');

			 if (token) {
					 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			 }
		},
	  type:'POST',
	  url:"{{ url('/zonas/validarEliminacion') }}",
	  data:{
          id:id
      },
          
          success:function(data){
		  
		  if (data.registros==0) {
              $('#confirmacionEliminar').modal('open');  
               $('#eliminarzona').on('click',function(){  
                  window.location="{{ url('/zonas/eliminar') }}/"+id; 
              })
		  }else {   
              $('#confirmacionFallida').modal('open'); 
		  }
		  
	  },

	  error:function(){ 
		  alert("error!!!!");
  }
  });  



    })




</script>