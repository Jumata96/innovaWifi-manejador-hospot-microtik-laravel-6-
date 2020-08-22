<script type="text/javascript">
  //----JPaiva-14-06-2018------------------DESABILITAR---------------------------
    @foreach ($usuarios as $val)
        $('#d{{$val->id}}').click(function(e){
          e.preventDefault();

          id = $(this).data('iddesabilitar');

          $.ajax({
                url: "{{ url('/usuario/desabilitar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/usuario/desabilitar') }}",
               data:{
                  id:id
               },

               success: function(data){

              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                $('#tr'+obj[0]['id']).replaceWith(
                "<td>"+ obj[0]['id'] +"</td>"+
                "<td>"+ obj[0]['nombre'] +"</td>"+
                "<td>"+ obj[0]['usuario'] +"</td>"+
                "<td>"+ obj[0]['email'] +"</td>"+
                "<td>"+ obj[0]['created_at'] +"</td>"+
                "<td class='center' style='width: 9rem'>"+
                    "<div id='estado' class='chip center-align' style='width: 70%'>"+
                      "<b>NO DISPONIBLE</b>"+
                      "<i class='material-icons'></i>"+
                    "</div>"+
                "</td>"+
                "<td class='center'>"+
                  "<a href='#updQueues' id='upd"+obj[0]['id']+"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped' data-position='top' data-delay='500' data-tooltip='Ver'><i class='material-icons' style='color: #7986cb'>visibility</i></a>"+                                     
                  " <a href='#confirmacion"+ obj[0]['id'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='material-icons' style='color: #dd2c00'>remove</i></a>"+
                  " <a href='#confirmacion3"+ obj[0]['id'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Habilitar'><i class='material-icons' style='color: #2e7d32'>check</i></a>"+
                "</td>"
                );}
                
                
                setTimeout(function() {
                  Materialize.toast('<span>Usuario desabilidado</span>', 1500);
                }, 100);  

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
        });    
          
    @endforeach

   
</script>