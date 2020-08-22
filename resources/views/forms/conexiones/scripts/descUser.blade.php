<script type="text/javascript">
	//----JPaiva-11-12-2018------------------ELIMINAR---------------------------
    @foreach ($clientes as $val)
        $('#e{{$val->id}}').click(function(e){
          e.preventDefault();

          id = $(this).data('ideliminar');
          console.log(id);

          $.ajax({
                url: "{{ url('/cliente/eliminar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/cliente/eliminar') }}",
               data:{
                  id:id
               },

               success: function(data){

                  setTimeout(function() {
                  Materialize.toast('<span>Registro eliminado</span>', 1500);
                }, 100);  
                
                  window.location="{{url('/clientes')}}";

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
        });    
          
    @endforeach

</script>