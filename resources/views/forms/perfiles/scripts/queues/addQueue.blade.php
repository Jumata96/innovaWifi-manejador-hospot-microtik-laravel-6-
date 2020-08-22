<script type="text/javascript">
	//----------------------GRABAR-----------------------------------
    $("#add").click(function(e){
        e.preventDefault();

        //var _token = $("input[name=_token]").val();
        var idrouter = $("select[name=idrouter]").val();
        var name = $("input[name=name]").val();
        var precio = $("input[name=precio]").val();
        var vsubida = $("input[name=vsubida]").val();
        var vbajada = $("input[name=vbajada]").val();
        var glosa = $("textarea[name=glosa]").val();

        $.ajax({
            url: "{{ url('/perfil/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/perfil/grabar') }}",
           data:{
              idrouter:idrouter, 
              precio:precio,
              name:name,
              vsubida:vsubida,
              vbajada:vbajada,
              glosa:glosa
           },

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.name != "undefined" )? $('#error2').text(data.name) : null;
                ( typeof data.precio != "undefined" )? $('#error3').text(data.precio) : null;
                ( typeof data.vsubida != "undefined" )? $('#error4').text(data.vsubida) : null;
                ( typeof data.vbajada != "undefined" )? $('#error5').text(data.vbajada) : null;
              } else {   

                var obj = $.parseJSON(data);

                $("#tableQueues").append("<tr class='post"+ obj[0]['idrouter'] +"'>"+
                "<td>"+ obj[0]['idperfil'] +"</td>"+
                "<td>"+ obj[0]['idrouter'] +"</td>"+
                "<td>"+ obj[0]['name'] +"</td>"+
                "<td>"+ obj[0]['precio'] +"</td>"+
                "<td>"+ obj[0]['target'] +"</td>"+
                "<td>"+
                    "<div id='u_estado2' class='chip center-align teal accent-4 white-text' style='width: 70%'>"+
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

                //alert(data.success);
                $('#cerrar').trigger('click');

                $('#name').val('');
                $('#precio').val('');
                $('#vsubida').val('');
                $('#vbajada').val('');
                $('#idrouter option[value=0]').attr("selected",true);

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