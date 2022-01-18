<script type="text/javascript">
      //---JPaiva-04-06-2018----------------ACTUALIZAR-----------------------------
    $('#hu_update').click(function(e){
      e.preventDefault();

      $.ajax({
            url: "{{ url('/perfil/hotspot/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/perfil/hotspot/actualizar') }}",
           data:{
              idperfil:$("input[name=hu_idperfil]").val(), 
              idrouter:$("select[name=hu_idrouter]").val(), 
              name:$("input[name=hu_name]").val(),
              precio:$("input[name=hu_precio]").val(),
              perfil:$("select[name=hu_perfil]").val(),
              dsc_perfil:$("input[name=hu_dsc_perfil]").val(),
              vbajada:$("input[name=hu_vbajada]").val(),
              vsubida:$("input[name=hu_vsubida]").val(),
              color:$("input[name=color_upd]").val(),
              minutos : $("input[name=h_minutos_upd]").val(),
              horas : $("input[name=h_horas_upd]").val(),
              dias : $("input[name=h_dias_upd]").val(),
              eliminacion:$("select[name=hu_eliminacion]").val(), 

              glosa:$("textarea[name=hu_glosa]").val()
           },

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
                ( typeof data.color != "undefined" )? $('#h_error55').text(data.color) : null;
              } else {  
                var obj = $.parseJSON(data); 

                // $('#htr'+obj[0]['idperfil']).replaceWith(
                // "<td>"+ obj[0]['idperfil'] +"</td>"+
                // "<td>"+ obj[0]['idrouter'] +"</td>"+
                // "<td>"+ obj[0]['name'] +"</td>"+
                // "<td>"+ obj[0]['precio'] +"</td>"+
                // "<td>"+ obj[0]['target'] +"</td>"+
                // "<td>"+
                //     "<div id='u_estado2' class='chip center-align teal accent-4 white-text' style='width: 70%'>"+
                //       "<b>ACTIVO</b>"+
                //       "<i class='material-icons'></i>"+
                //     "</div>"+
                // "</td>"+
                // "<td class='center'>"+
                //   "<a href='{{ url('/perfil/hotspot/mostrar') }}/"+ obj[0]['idperfil'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped' data-position='top' data-delay='500' data-tooltip='Ver'><i class='mdi-action-visibility' style='color: #7986cb'></i></a>"+                                     
                //   " <a href='#confirmacion"+ obj[0]['idservicio'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-remove' style='color: #dd2c00'></i></a>"+
                // "</td>"
                // );
                //alert(data.success);

                //$('#updTipoAcceso').hide();
                $('#hu_cerrar').trigger('click');

                setTimeout(function() {
                  Materialize.toast('<span>Registro actualizado</span>', 1500);
                }, 100);  

                // window.location.href ="perfiles"; 
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
        });


    });    
    

    @foreach ($hotspot as $val)
      $(document).on('click','#updHotspot{{$val->idperfil}}', function(){
        $("#hu_name").val($(this).data('name'));
        $("#hu_precio").val($(this).data('precio'));
        $("#hu_dsc_perfil").val($(this).data('dsc_perfil'));
        $("#color_upd").val($(this).data('color'));
        $("#hu_vbajada").val($(this).data('vbajada'));
        $("#hu_vsubida").val($(this).data('vsubida'));
        $("#hu_glosa").text($(this).data('glosa'));
        $("#hu_idperfil").val($(this).data('id'));
        $("#h_dias_upd").val($(this).data('dias'));
        $("#h_horas_upd").val($(this).data('horas'));
        $("#h_minutos_upd").val($(this).data('minutos')); 
        console.log($(this).data(),'datos selec 123');

        var idrouter = $(this).data('idrouter');
        var perfil = $(this).data('perfil');
        var id = $(this).data('id');
        var dsc = $(this).data('dsc_perfil');


        
        const $select = $("#hu_eliminacion"); 

        if($(this).data('autoeliminado') == 1){ 
          $select.append($("<option>", {
                  value: "SI",
                  selected:"",
                  text: "SI"
                }));
          $select.append($("<option>", {
                  value: "NO", 
                  text: "NO"
                })); 

        }else{
          $select.append($("<option>", {
                  value: "SI", 
                  text: "SI"
                }));
          $select.append($("<option>", {
                  value: "NO",
                  selected:"",
                  text: "NO"
                })); 

        }

 
        $("#hu_idrouter option[value="+idrouter+"]").attr("selected",true);

        if($(this).data('estado') == 1){
          $('#hu_estado').hide();
          $('#hu_estado2').show();
        }else{
          $('#hu_estado2').hide();
          $('#hu_estado').show();
        }
              $('#hu_perfil').empty();  
              $('#hu_perfil').removeAttr('disabled');
              $('#hu_dsc_perfil').removeAttr('disabled');   
                $('#hu_perfil').append("<option value='"+id+"'>"+dsc+"</option>"); 
        	var el = document.getElementById('iconColor_upd'); 
		      el.style.color = '#'+$(this).data('color');    

      });      
    @endforeach



    //  $('#hu_idrouter').change(function(e){
    //   var val = $("select[name=hu_idrouter]").val();

    //   if ( val != '0') {
    //     $('#hu_perfil').removeAttr("disabled");

    //     $.ajax({
    //         url: "{{ url('/hotspot/perfil') }}",
    //         type:"POST",
    //         beforeSend: function (xhr) {
    //             var token = $('meta[name="csrf-token"]').attr('content');

    //             if (token) {
    //                   return xhr.setRequestHeader('X-CSRF-TOKEN', token);
    //             }
    //         },
    //        type:'POST',
    //        url:"{{ url('/hotspot/perfil') }}",
    //        data:{
    //           idrouter:$("select[name=hu_idrouter]").val()
    //        },

    //        success:function(data){

    //           //var obj = $.parseJSON(data); 
    //           $('#hu_perfil').empty();  
    //           $('#hu_perfil').removeAttr('disabled');
    //           $('#hu_dsc_perfil').removeAttr('disabled');  

    //           $('#hu_perfil').append("<option value='n'>Elija un perfil</option>");
    //           $('#hu_perfil').append("<option value='0'>Crear perfil</option>"); 

    //           $.each(data, function(i, item) {
    //               $('#hu_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
    //           });

    //        },
    //        error:function(){ 
    //           alert("error!!!!");
    //     }

    //     });
           
    //   };
    // });


</script>