<script type="text/javascript">
    //---JPaiva-19-08-2020----------------Validar PIN-----------------------------
  
  $('#add').click(function(e){
    e.preventDefault();
    
    var data = $('#pin').val();
    
    $.ajax({
            url: "{{ url('/tickets/validar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/tickets/validar') }}",
           data:{pin: data},

           success:function(data){
                if ( data == "TICKET_EXISTE") {
                    setTimeout(function() {
                        Materialize.toast('<span style="color:#e65100">El<b> CÓDIGO</b> ingresado ya fue registrado.</i></span>', 5500);
                    }, 100); 
                }else if ( data[0] == "error") {
                    setTimeout(function() {
                        Materialize.toast('<span style="color:#eeff41">El<b> CÓDIGO</b> ingresado no existe en el <i><b>Mikrotik</b></i></span>', 5500);
                    }, 100); 
                } else {  
                    var obj = $.parseJSON(data); 

                    $('#codigo').val(obj["nombre"]);
                    $('#idperfil').val(obj["idperfil"]);
                    
                    $('#codigo2').text("CÓDIGO: " + obj["nombre"]);
                    $('#plan').text("PERFIL INTERNET: " + obj["name"]);
                    $('#precio').text("COSTO DEL PLAN: " + obj["precio"]);

                    $('#confirmar').modal('open'); 
                
                    //var obj = $.parseJSON(data);                
                    //setTimeout("location.href='{{url('/router')}}'", 0000);
                }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

    $('#registrar').click(function(e){
    e.preventDefault();
    
    var codigo = $('#codigo').val();
    var idperfil = $('#idperfil').val();
    
    $.ajax({
            url: "{{ url('/tickets/store') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/tickets/store') }}",
           data:{
               codigo: codigo,
               idperfil: idperfil
               },

           success:function(data){
              
                if ( data == "TICKET_EXISTE") {
                    setTimeout(function() {
                        Materialize.toast('<span style="color:#e65100">El<b> CÓDIGO</b> ingresado ya fue registrado.</i></span>', 5500);
                    }, 100); 
                }else if ( data[0] == "error") {
                    setTimeout(function() {
                        Materialize.toast('<span style="color:#eeff41">El<b> CÓDIGO</b> ingresado no existe en el <i><b>Mikrotik</b></i></span>', 5500);
                    }, 100); 
                } else {  
                    
                    console.log(data);
                    Materialize.toast('<span style="color:#1de9b6">El registro fue exitoso.</i></span>', 5500);
                    
                    $('#confirmar').modal('close'); 
                
                    setTimeout("location.href='{{url('/tickets/registrar')}}'", 2000);
                }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });   

</script>