<script type="text/javascript">
    //------JPaiva--11-10-2018-------------GRABAR-----------------------------------
    
    $("#add").click(function(e){
        e.preventDefault();

        var data = $('#myForm').serializeArray();

        $.ajax({
            url: "{{ url('/usuario/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/usuario/grabar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.nro_documento != "undefined" )? $('#error1').text(data.nro_documento) : null;
                ( typeof data.nombre != "undefined" )? $('#error3').text(data.nombre) : null;
                ( typeof data.apellidos != "undefined" )? $('#error4').text(data.apellidos) : null;
                ( typeof data.usuario != "undefined" )? $('#error5').text(data.usuario) : null;
                ( typeof data.email != "undefined" )? $('#error6').text(data.email) : null;
                ( typeof data.password != "undefined" )? $('#error7').text(data.password) : null;
                ( typeof data.idtipo != "undefined" )? $('#error8').text(data.idtipo) : null;
                ( typeof data.idempresa != "undefined" )? $('#error9').text(data.idempresa) : null; 
                ( typeof data.zonas != "undefined" )? $('#error10').text(data.zonas) : null;


                
              } else {   

                //alert(data.success);
                window.location="{{ url('/usuarios') }}";
                setTimeout(function() {
                  Materialize.toast('<span style="color:#e65100"><b>Usuario</b> registrado.</i></span>', 500);
                }, 100);

              }
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });


  function elegirTipoUsuario(sel){
    var variable = $('option:selected', sel).data("parametro4"); // se obtiene el  valor del del select 
    if(variable=='VEN'){  
      var el = document.getElementById('divZona'); //se define la variable "el" igual a nuestro div
      el.style.display ='block'; 
      var elAlt = document.getElementById('divCodAlterno'); 
      elAlt.style.display ='block'; 
       
    }else{
      var el = document.getElementById('divZona'); //se define la variable "el" igual a nuestro div
      el.style.display ='none'; 
      var elAlt = document.getElementById('divCodAlterno'); 
      elAlt.style.display ='none'; 

    } 
   // alert(variable);
 } 

    
</script>

