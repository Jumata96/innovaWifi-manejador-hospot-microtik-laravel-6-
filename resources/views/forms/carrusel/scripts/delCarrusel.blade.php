<script type="text/javascript">
	//----JPaiva-30-07-2018------------------ELIMINARs---------------------------
    @foreach ($carrusel as $val)
        $('#e{{$val->id}}').click(function(e){
          e.preventDefault();

          id = $(this).data('ideliminar');
          console.log(id);

          $.ajax({
                url: "{{ url('/carrusel/eliminar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/carrusel/eliminar') }}",
               data:{
                  id:id
               },

               success: function(data){
                
                $('#tr' + id ).remove();

                setTimeout(function() {
                  Materialize.toast('<span>Registro eliminado</span>', 1500);
                }, 100);  

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
        });    
          
    @endforeach

</script>