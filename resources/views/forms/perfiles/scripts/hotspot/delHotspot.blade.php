<script type="text/javascript">
	//----JPaiva-15-06-2018------------------ELIMINARs---------------------------
    @foreach ($hotspot as $val)
        $('#he{{$val->idperfil}}').click(function(e){
          e.preventDefault();

          id = $(this).data('ideliminar');

          $.ajax({
                url: "{{ url('/perfil/eliminar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/perfil/eliminar') }}",
               data:{
                  idperfil:id
               },

               success: function(data){
                
                $('#htr' + id ).remove();

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