<script type="text/javascript">
   //----------------------GRABAR HOTSPOT-----------------------------------
    $("#h_add").click(function(e){
        e.preventDefault();

        //var _token = $("input[name=_token]").val();
        var idrouter = $("select[name=h_idrouter]").val();
        var name = $("input[name=h_name]").val();
        var precio = $("input[name=h_precio]").val();
        var perfil = $("select[name=h_perfil]").val();
        // var dsc_perfil = $("input[name=h_dsc_perfil]").val();
        var vsubida = $("input[name=h_vsubida]").val();
        var vbajada = $("input[name=h_vbajada]").val();
        var glosa = $("textarea[name=h_glosa]").val();
        var color = $("input[name=color]").val(); 
        var minutos = $("input[name=h_minutos]").val();
        var horas = $("input[name=h_horas]").val();
        var dias = $("input[name=h_dias]").val(); 
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
              color:color,
              minutos:minutos,
              horas:horas,
              dias:dias, 

              // dsc_perfil:dsc_perfil,
              vsubida:vsubida,
              vbajada:vbajada,
              glosa:glosa 

           },

           success:function(data){

              $('#h_error1').text('');
                $('#h_error2').text('');
                $('#h_error3').text('');
                $('#h_error6').text('');
                $('#h_error7').text('');
                $('#h_error4').text('');
              
              if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#h_error1').text(data.idrouter) : null;
                ( typeof data.name != "undefined" )? $('#h_error2').text(data.name) : null;
                ( typeof data.precio != "undefined" )? $('#h_error3').text(data.precio) : null;
                ( typeof data.vsubida != "undefined" )? $('#h_error6').text(data.vsubida) : null;
                ( typeof data.vbajada != "undefined" )? $('#h_error7').text(data.vbajada) : null;
                ( typeof data.perfil != "undefined" )? $('#h_error4').text(data.perfil) : null;
                ( typeof data.color != "undefined" )? $('#h_error50').text(data.color) : null;

                
              } else {   

                var obj = $.parseJSON(data);
                // console.log('retorno valor'); 
                // $('#h_cerrar').trigger('click'); 
                setTimeout(function() {
                  Materialize.toast('<span>Registro exitoso</span>', 1500);
                }, 100); 

                window.location.href ="perfiles";

              }             
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });


</script>