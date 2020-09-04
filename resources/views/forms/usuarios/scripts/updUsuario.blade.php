<script type="text/javascript">
    //------JPaiva--11-10-2018-------------GRABAR-----------------------------------
    
    $("#upd").click(function(e){
        e.preventDefault();

        var data = $('#myForm').serializeArray();

        $.ajax({
            url: "{{ url('/usuario/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/usuario/actualizar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.nro_documento != "undefined" )? $('#error1').text(data.nro_documento) : null;
                ( typeof data.nombre != "undefined" )? $('#error3').text(data.nombre) : null;
                ( typeof data.apellidos != "undefined" )? $('#error4').text(data.apellidos) : null;
                ( typeof data.usuario != "undefined" )? $('#error5').text(data.usuario) : null;
                ( typeof data.email != "undefined" )? $('#error6').text(data.email) : null;
                ( typeof data.zonas != "undefined" )? $('#error22').text(data.zonas) : null; 
              } else {   

                //alert(data.success);
                window.location="{{ url('/usuarios') }}";

              }
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });

    
</script>

