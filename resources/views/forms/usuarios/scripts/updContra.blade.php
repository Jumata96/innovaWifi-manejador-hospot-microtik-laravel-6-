<script type="text/javascript">
	//------JPaiva--11-12-2018-------------GRABAR-----------------------------------
    
    $("#add").click(function(e){
        e.preventDefault();

        //var _token = $("input[name=_token]").val();
        var data = $('#myForm2').serializeArray();
        console.log('entro');
        console.log(data);


        $.ajax({
            url: "{{ url('/usuario/updContra') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/usuario/updContra') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "BAD_CONTRA") {
                $('#error1').text("La contraseña es incorrecta") ;
              }else if ( data[0] == "BAD_CONTRA2") {
                $('#error2').text("La nueva contraseña no coincide")
              }else if ( data[0] == "error") {
                ( typeof data.contra != "undefined" )? $('#error1').text("Este campo es obligatorio") : null;
                ( typeof data.contra2 != "undefined" )? $('#error2').text("Este campo es obligatorio") : null;
                ( typeof data.contra3 != "undefined" )? $('#error3').text("Este campo es obligatorio") : null;
              } else {   

                //var obj = $.parseJSON(data);

               

                //alert(data.success);
                $('#cerrar').trigger('click');


                setTimeout(function() {
                  Materialize.toast('<span>Actualización exitosa</span>', 1500);
                }, 100); 


              }

              
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });

    
</script>

