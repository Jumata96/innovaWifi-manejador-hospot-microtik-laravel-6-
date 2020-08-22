<script type="text/javascript">
  //----JPaiva-19-06-2019------------------------------------HABILITAR--------------------------------------------
    @foreach ($usuarios as $val)
        $('#h{{$val->codigo}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idcliente');

          $.ajax({
                url: "{{ url('/cliente/habilitar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/cliente/habilitar') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Cliente habilitado</span>'});
                }, 2000); 

                setTimeout("redireccionarPagina()",4000);
              }
                

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
        });    
          
    @endforeach

    function redireccionarPagina() {
      window.location = "{{ url('/hotspot/usuarios') }}";
    }

   
</script>