<script type="text/javascript">
      //---JPaiva-11-12-2018----------------GUARDAR-----------------------------
    $('#add').click(function(e){
      e.preventDefault();

      var data = $('#myForm').serializeArray();
      console.log(data);


      $.ajax({
            url: "{{ url('/compras/guardar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/compras/guardar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.ruc != "undefined" )? $('#error1').text(data.ruc) : null;
                ( typeof data.razon_social != "undefined" )? $('#error2').text(data.razon_social) : null;
                ( typeof data.nombre != "undefined" )? $('#error3').text(data.nombre) : null;
                ( typeof data.apellidos != "undefined" )? $('#error4').text(data.apellidos) : null;
                ( typeof data.direccion != "undefined" )? $('#error5').text(data.direccion) : null;
                ( typeof data.telefono != "undefined" )? $('#error6').text(data.telefono) : null;
                ( typeof data.descripcion != "undefined" )? $('#error7').text(data.descripcion) : null;
                ( typeof data.descripcion != "undefined" )? $('#descripcion').focus() : null;
              } else {  
                var obj = $.parseJSON(data); 

               
                setTimeout("location.href='{{url('/compra-finalizada')}}'", 0000);
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

</script>