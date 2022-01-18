<script type="text/javascript">
	 //----JPaiva-14-06-2018------------------HABILITAR---------------------------
    @foreach ($hotspot as $val)
        $('#ha{{$val->idperfil}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idperfil');
          console.log(id);

          $.ajax({
                url: "{{ url('/perfil/habilitar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/perfil/habilitar') }}",
               data:{
                  idperfil:id
               },

               success: function(data){
                 console.log(data,'');

                    if ( data[0] == "error") {
                      ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
                    } else {   
                      window.location.href ="perfiles"; 
                      
                      setTimeout(function() {
                        Materialize.toast('<span>Registro habilitado</span>', 1500);
                      }, 100);  
                    }
                    //  };
                    //  error:function(){ 
                    //     alert("error!!!!");
            },
            error:function(){ 
                       alert("error!!!!");
                    }

            });
        });    
          
    @endforeach


</script>