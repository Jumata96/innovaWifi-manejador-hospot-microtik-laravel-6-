<script type="text/javascript">
  //----JPaiva--03-03-2019---------------------------------GUARDAR-----------------------------------------------
  $(document).on('click','#add', function(){
  
    var data = $('#myForm').serializeArray();

          $.ajax({
              url: "{{ url('/empresa/grabar2') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/empresa/grabar2') }}",
             data:data,

             success:function(data){              
                if ( data[0] == "error") {
                ( typeof data.idempresa != "undefined" )? $('#error1').text(data.idempresa) : null;
                ( typeof data.razon_social != "undefined" )? $('#error2').text(data.razon_social) : null;
                ( typeof data.direccion != "undefined" )? $('#error3').text(data.direccion) : null;
                ( typeof data.RUC != "undefined" )? $('#error4').text(data.RUC) : null;
                
              } else {  
                
                setTimeout(function() {
                      M.toast({ html: '<span>Registro exitoso.</span>'});
                }, 2000); 
                 window.location="{{ url('/licencia/registrar') }}";
                //setTimeout("location.href = {{ url('/licencia/registrar') }}",3000); 
                
              }
                   
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });
</script>