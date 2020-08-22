<script type="text/javascript">
	 //----JPaiva-14-06-2018------------------HABILITAR---------------------------
    @foreach ($queues as $val)
        $('#a{{$val->idperfil}}').click(function(e){
          e.preventDefault();

          id = $(this).data('idperfil');

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

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                $('#tr'+obj[0]['idperfil']).replaceWith(
                "<td>"+ obj[0]['idperfil'] +"</td>"+
                "<td>"+ obj[0]['idrouter'] +"</td>"+
                "<td>"+ obj[0]['name'] +"</td>"+
                "<td>"+ obj[0]['precio'] +"</td>"+
                "<td>"+ obj[0]['target'] +"</td>"+
                "<td class='center'>"+
                    "<div id='u_estado2' class='chip center-align teal accent-4 white-text' style='width: 70%'>"+
                      "<b>ACTIVO</b>"+
                      "<i class='material-icons'></i>"+
                    "</div>"+
                "</td>"+
                "<td class='center'>"+
                  "<a href='#updQueues' id='upd"+obj[0]['idperfil']+"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped' data-position='top' data-delay='500' data-tooltip='Ver'><i class='mdi-action-visibility' style='color: #7986cb'></i></a>"+                                     
                  " <a href='#confirmacion"+ obj[0]['idperfil'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-remove' style='color: #dd2c00'></i></a>"+

                  " <a href='#confirmacion2"+ obj[0]['idperfil'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-clear' style='color: #757575'></i></a>"+
                "</td>"
                );}
                
                
                setTimeout(function() {
                  Materialize.toast('<span>Registro habilitado</span>', 1500);
                }, 100);  

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
        });    
          
    @endforeach


</script>