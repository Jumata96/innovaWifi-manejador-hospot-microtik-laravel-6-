<script type="text/javascript">
  //---------JPaiva--03-01-2019---------VALIDAR INPUT-----------------------------------
        
  $('#nro_documento').mask('AAAAAAAAAAA');
  $('#cargo').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  $('#nombre').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  $('#apellidos').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  $('#telefono').mask('09999999999999999999');
  $('#usuario').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  //$('#email').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
  $('#password').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  $('#password_confirmation').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });


  //---------------------------------VALIDA ID QUE NO SE REPITA-----------------------------------------

  var focus = 0;

  $("#nro_documento").focusout(function() {

    var data = $(this).val();
    //console.log(data.length);

          $.ajax({
              url: "{{ url('/usuario/verificarID') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/usuario/verificarID') }}",
             data:{
              codigo:data
             },

             success:function(data){              
                if ( data[0] == "error") {
                  
                }
                if (data.errors == 'EXISTE') {

                  $('#nro_documento').val('');
                  $('#nro_documento').focus();

                
                  setTimeout(function() {
                    Materialize.toast('<span>El Nro. de Documento ingresado ya existe. Ingrese un dato distinto.</span>', 1500);
                  }, 100);  
                }  
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });
  

  //---------------------------------VALIDA ID USUARIO QUE NO SE REPITA-----------------------------------------

  var focus = 0;

  $("#usuario").focusout(function() {

    var data = $(this).val();

          $.ajax({
              url: "{{ url('/usuario/verificarUsuario') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/usuario/verificarUsuario') }}",
             data:{
              codigo:data
             },

             success:function(data){              
                if ( data[0] == "error") {
                  
                }
                if (data.errors == 'EXISTE') {

                  $('#usuario').val('');
                  $('#usuario').focus();

                  setTimeout(function() {
                    Materialize.toast('<span>El Usuario ingresado ya existe. Ingrese un usuario distinto.</span>', 1500);
                  }, 100);  
                }  
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });
    //--JMazuelos 21-08-2020-------------------muestra el div de zona en caso sea vendedor-----------------------------------------


  $(document).ready(function() { 
    parametroFacturacion=$("select[name=idtipo]").val(); // se obtiene el valor del select tipo usuario 
    

    if(parametroFacturacion=='VEN'){
      var el = document.getElementById('divZonas'); 
      el.style.display ='block'; 
      var elAlt = document.getElementById('divCodAlterno'); 
      elAlt.style.display ='block';  
    }else{
      var el = document.getElementById('divZonas'); // se obtiene el elemento
      el.style.display ='none';//se oculta el div  
    } 
    
  });

  function elegirTipoUsuario(sel){
    var variable = $('option:selected', sel).data("parametro4"); // se obtiene el  valor del del select 
    if(variable=='VEN'){  
      var el = document.getElementById('divZonas'); //se define la variable "el" igual a nuestro div
      el.style.display ='block'; 
      var elAlt = document.getElementById('divCodAlterno'); 
      elAlt.style.display ='block'; 
       
    }else{
      var el = document.getElementById('divZonas'); //se define la variable "el" igual a nuestro div
      el.style.display ='none'; 
      var elAlt = document.getElementById('divCodAlterno'); 
      elAlt.style.display ='none'; 

    } 
   // alert(variable);
 } 
</script>