<script type="text/javascript">
   //----------------------GRABAR PERFIL PPPoE-----------------------------------
    $("#p_add").click(function(e){
        e.preventDefault();
        $('#p_error1').text('');
        $('#p_error2').text('');
        $('#p_error3').text('');
        $('#p_error4').text('');
        $('#p_error6').text('');
        $('#p_error7').text('');        

        //var _token = $("input[name=_token]").val();
        var idrouter = $("select[name=p_idrouter]").val();
        var name = $("input[name=p_name]").val();
        var precio = $("input[name=p_precio]").val();
        var perfil = $("select[name=p_perfil]").val();
        var dsc_perfil = $("input[name=p_dsc_perfil]").val();
        var remote_address = $("select[name=p_remote_address]").val();
        var local_address = $("input[name=p_local_address]").val();
        var vsubida = $("input[name=p_vsubida]").val();
        var vbajada = $("input[name=p_vbajada]").val();
        var glosa = $("textarea[name=p_glosa]").val();

        $.ajax({
            url: "{{ url('/perfil/pppoe/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/perfil/pppoe/grabar') }}",
           data:{
              idrouter:idrouter, 
              precio:precio,
              name:name,
              perfil:perfil,
              dsc_perfil:dsc_perfil,
              remote_address:remote_address,
              local_address:local_address,
              vsubida:vsubida,
              vbajada:vbajada,
              glosa:glosa
           },

           success:function(data){

              $('#p_error1').text('');
              $('#p_error2').text('');
              $('#p_error3').text('');
              $('#p_error6').text('');
              $('#p_error7').text('');
              $('#p_error4').text('');
              
              if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#p_error1').text(data.idrouter) : null;
                ( typeof data.name != "undefined" )? $('#p_error2').text(data.name) : null;
                ( typeof data.precio != "undefined" )? $('#p_error3').text(data.precio) : null;
                ( typeof data.vsubida != "undefined" )? $('#p_error6').text(data.vsubida) : null;
                ( typeof data.vbajada != "undefined" )? $('#p_error7').text(data.vbajada) : null;
                ( typeof data.perfil != "undefined" )? $('#p_error4').text(data.vbajada) : null;
              } else {   

                var obj = $.parseJSON(data);

                $("#tablePPPoE").append("<tr class='post"+ obj[0]['idrouter'] +"'>"+
                "<td>"+ obj[0]['idperfil'] +"</td>"+
                "<td>"+ obj[0]['idrouter'] +"</td>"+
                "<td>"+ obj[0]['name'] +"</td>"+
                "<td>"+ obj[0]['precio'] +"</td>"+
                "<td>"+ obj[0]['rate_limit'] +"</td>"+
                "<td class='center'>"+
                    "<div id='p_estado2' class='chip center-align teal accent-4 white-text' style='width: 70%'>"+
                      "<b>ACTIVO</b>"+
                      "<i class='material-icons'></i>"+
                    "</div>"+
                "</td>"+
                "<td class='center'>"+
                  "<a href='{{ url('/perfil/mostrar') }}/"+ obj[0]['idperfil'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped' data-position='top' data-delay='500' data-tooltip='Ver'><i class='mdi-action-visibility' style='color: #7986cb'></i></a>"+                                     
                  " <a href='#confirmacion"+ obj[0]['idservicio'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-remove' style='color: #dd2c00'></i></a>"+
                  " <a href='#p_confirmacion2"+ obj[0]['idperfil'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Desabilitar'><i class='mdi-content-clear' style='color: #757575 '></i></a>"+
                "</td>"+
                "</tr>");

                             

                $('#p_cerrar').trigger('click');

                setTimeout(function() {
                  Materialize.toast('<span>Registro exitoso</span>', 1500);
                }, 100); 
              }             
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });


</script>