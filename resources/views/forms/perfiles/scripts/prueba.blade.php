<script type="text/javascript">
	 //-------------------------------------------------------HOTSPOT-------------------------------------------------------------
     $('#h_idrouter').change(function(e){
      var val = $("select[name=h_idrouter]").val();

      $("#idperfil option[value=0]").attr("selected", true);
      $("#idperfil option[value=cero]").attr("selected",true);

      if ( val != '0') {
        $('#idperfil').removeAttr("disabled");

        $.ajax({
            url: "{{ url('/hotspot/perfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/hotspot/perfil') }}",
           data:{
              idrouter:$("select[name=h_idrouter]").val()
           },

           success:function(data){

              //var obj = $.parseJSON(data); 
              $('#h_perfil').empty();  
              $('#h_perfil').removeAttr('disabled');
              $('#h_dsc_perfil').removeAttr('disabled');  

              $('#h_perfil').append("<option value='n'>Elija un perfil</option>");
              $('#h_perfil').append("<option value='0'>Crear perfil</option>"); 

              $.each(data, function(i, item) {
                  $('#h_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

     //----------------------GRABAR HOTSPOT-----------------------------------
    $("#h_add").click(function(e){
        e.preventDefault();

        //var _token = $("input[name=_token]").val();
        var idrouter = $("select[name=h_idrouter]").val();
        var name = $("input[name=h_name]").val();
        var precio = $("input[name=h_precio]").val();
        var perfil = $("select[name=h_perfil]").val();
        var dsc_perfil = $("input[name=h_dsc_perfil]").val();
        var vsubida = $("input[name=h_vsubida]").val();
        var vbajada = $("input[name=h_vbajada]").val();
        var glosa = $("textarea[name=h_glosa]").val();

        $.ajax({
            url: "{{ url('/perfil/hotspot/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/perfil/hotspot/grabar') }}",
           data:{
              idrouter:idrouter, 
              precio:precio,
              name:name,
              perfil:perfil,
              dsc_perfil:dsc_perfil,
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

                $("#data-table-simple").append("<tr class='post"+ obj[0]['idrouter'] +"'>"+
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
                "</td>"+
                "</tr>");

                //alert(data.success);
                $('#cerrar').trigger('click');

                $('#h_name').val('');
                $('#h_precio').val('');
                $('#h_vsubida').val('');
                $('#h_vbajada').val('');
                $('#h_idrouter option[value=0]').attr("selected",true);

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