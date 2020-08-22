<script type="text/javascript">
      //---JPaiva-28-10-2018----------------ACEPTAR-----------------------------
    $('#addParametros').click(function(e){
      e.preventDefault();

      var data = $('#myForm2').serializeArray();
console.log(data);
      $.ajax({
            url: "{{ url('/addParametrosLogout') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/addParametrosLogout') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                //( typeof data.facturacion != "undefined" )? $('#error1').text(data.facturacion) : null;
              } else {  
                //var obj = $.parseJSON(data); 

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