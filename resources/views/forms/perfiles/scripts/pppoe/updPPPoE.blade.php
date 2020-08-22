<script type="text/javascript">
      //---JPaiva-04-06-2018----------------ACTUALIZAR-----------------------------
    $('#pu_update').click(function(e){
      e.preventDefault();

      $.ajax({
            url: "{{ url('/perfil/pppoe/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/perfil/pppoe/actualizar') }}",
           data:{
              idperfil:$("input[name=pu_idperfil]").val(), 
              idrouter:$("select[name=pu_idrouter]").val(), 
              name:$("input[name=pu_name]").val(),
              precio:$("input[name=pu_precio]").val(),
              perfil:$("select[name=pu_perfil]").val(),
              dsc_perfil:$("input[name=pu_dsc_perfil]").val(),
              remote_address:$("select[name=pu_remote_address]").val(),
              local_address:$("input[name=pu_local_address]").val(),
              vbajada:$("input[name=pu_vbajada]").val(),
              vsubida:$("input[name=pu_vsubida]").val(),
              glosa:$("textarea[name=pu_glosa]").val()
           },

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#pu_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                $('#ptr'+obj[0]['idperfil']).replaceWith(
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
                  "<a href='{{ url('/perfil/hotspot/mostrar') }}/"+ obj[0]['idperfil'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped' data-position='top' data-delay='500' data-tooltip='Ver'><i class='mdi-action-visibility' style='color: #7986cb'></i></a>"+                                     
                  " <a href='#confirmacion"+ obj[0]['idservicio'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-remove' style='color: #dd2c00'></i></a>"+
                "</td>"
                );
                //alert(data.success);

                //$('#updTipoAcceso').hide();
                $('#hu_cerrar').trigger('click');

                setTimeout(function() {
                  Materialize.toast('<span>Registro actualizado</span>', 1500);
                }, 100);  
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
        });


    });    
    

    @foreach ($pppoe as $val)
      $(document).on('click','#updPPPoE{{$val->idperfil}}', function(){
        $("#pu_name").val($(this).data('name'));
        $("#pu_precio").val($(this).data('precio'));
        $("#pu_dsc_perfil").val($(this).data('dsc_perfil'));
        $("#pu_vbajada").val($(this).data('vbajada'));
        $("#pu_vsubida").val($(this).data('vsubida'));
        $("#pu_glosa").text($(this).data('glosa'));
        $("#pu_idperfil").val($(this).data('id'));
        $("#pu_remote_address").val($(this).data('pu_remote_address'));
        $("#pu_local_address").val($(this).data('pu_local_address'));

        var idrouter = $(this).data('idrouter');
        var perfil = $(this).data('perfil');
        var dsc = $(this).data('dsc_perfil');

        $("#pu_idrouter option[value="+idrouter+"]").attr("selected",true);

        if($(this).data('estado') == 1){
          $('#pu_estado').hide();
          $('#pu_estado2').show();
        }else{
          $('#pu_estado2').hide();
          $('#pu_estado').show();
        }

        $.ajax({
            url: "{{ url('/perfil/pppoe') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/perfil/pppoe') }}",
           data:{
              idrouter:idrouter
           },

           success:function(data){

              //var obj = $.parseJSON(data); 
              $('#pu_perfil').empty();  
              $('#pu_perfil').removeAttr('disabled');
              //$('#hu_dsc_perfil').removeAttr('disabled');  

              $('#pu_perfil').append("<option disabled value=''>Elija un perfil</option>");
              $('#pu_perfil').append("<option value='0'>Crear perfil</option>"); 

              $.each(data, function(i, item) {
                  
                  if (perfil == item.name || dsc == item.name) {
                    $('#pu_perfil').append("<option selected value='"+item.name+"'>"+item.name+"</option>");
                  }else{
                    $('#pu_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
                  }
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });

        $.ajax({
            url: "{{ url('/ip/pool') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/ip/pool') }}",
           data:{
              idrouter:$("select[name=pu_idrouter]").val()
           },

           success:function(data){

              //var obj = $.parseJSON(data); 
              $('#pu_remote_address').empty();  
              $('#pu_remote_address').removeAttr('disabled');
              //$('#hu_dsc_perfil').removeAttr('disabled');  

              $('#pu_remote_address').append("<option disabled value=''>Elija un pool de ip</option>");
              
              $.each(data, function(i, item) {
                  
                  if (perfil == item.name || dsc == item.name) {
                    $('#pu_perfil').append("<option selected value='"+item.name+"'>"+item.name+"</option>");
                  }else{
                    $('#pu_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
                  }
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });

      });      
    @endforeach



     $('#pu_idrouter').change(function(e){
      var val = $("select[name=pu_idrouter]").val();

      if ( val != '0') {
        $('#pu_perfil').removeAttr("disabled");

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
           url:"{{ url('/perfil/pppoe') }}",
           data:{
              idrouter:$("select[name=pu_idrouter]").val()
           },

           success:function(data){

              //var obj = $.parseJSON(data); 
              $('#pu_perfil').empty();  
              $('#pu_perfil').removeAttr('disabled');
              $('#pu_dsc_perfil').removeAttr('disabled');  

              $('#pu_perfil').append("<option value='n'>Elija un perfil</option>");
              $('#pu_perfil').append("<option value='0'>Crear perfil</option>"); 

              $.each(data, function(i, item) {
                  $('#pu_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });


</script>