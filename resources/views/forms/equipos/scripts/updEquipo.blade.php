<script type="text/javascript">
   //------------JPaiva--25-06-2018------------------------------ACTUALIZAR EQUIPO----------------------------------------------------
    $("#updEquipo").click(function(e){
        e.preventDefault();
        console.log($("input[name=idequipo]").val());
        $.ajax({
            url: "{{ url('/equipos/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/equipos/actualizar') }}",
           data:{
              idequipo:$("input[name=idequipo]").val(), 
              idgrupo:$("select[name=idgrupo]").val(), 
              idmarca:$("select[name=idmarca]").val(), 
              idmodelo:$("select[name=idmodelo]").val(), 
              descripcion:$("input[name=descripcion]").val(), 
              serie_equipo:$("input[name=serie_equipo]").val(), 
              iddocumento:$("select[name=iddocumento]").val(), 
              numero_serie:$("input[name=numero_serie]").val(),              
              fecha_ingreso:$("input[name=fecha_ingreso]").val(), 
              precio:$("input[name=precio]").val(), 
              idmodo:$("select[name=idmodo]").val(),
              SSID:$("input[name=SSID]").val(), 
              ip:$("input[name=ip]").val(), 
              mac:$("input[name=mac]").val(), 
              usuario:$("input[name=usuario]").val(), 
              contrasena:$("input[name=contrasena]").val(),  
              glosa:$("textarea[name=h_glosa]").val()
           },

           success:function(data){
            console.log(data[0]);
              $('#error1').text('');
                $('#error2').text('');
                $('#error3').text('');
                $('#error4').text('');
                $('#error5').text('');
                              
              if ( data[0] == "error") {
                ( typeof data.idgrupo != "undefined" )? $('#error1').text(data.idgrupo) : null;
                ( typeof data.idmarca != "undefined" )? $('#error2').text(data.idmarca) : null;
                ( typeof data.idmodelo != "undefined" )? $('#error3').text(data.idmodelo) : null;
                ( typeof data.descripcion != "undefined" )? $('#error4').text(data.descripcion) : null;
                ( typeof data.fecha_ingreso != "undefined" )? $('#error5').text(data.fecha_ingreso) : null;
              } else {   

                var url = "{{ url('/equipos') }}";
                $(location).attr('href',url);
              }             
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });


</script>