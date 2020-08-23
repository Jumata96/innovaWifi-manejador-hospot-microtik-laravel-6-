<script type="text/javascript">
  //---------JPaiva--03-01-2019---------VALIDAR INPUT-----------------------------------
        
  $('#idempresa').mask('AAA');
  $('#razon_social').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9ñÑ\s]/}
    }
  });
  $('#RUC').mask('AAAAAAAAAAAAAAAAAAAA');
  @foreach($parametros as $val)
    if('{{$val->parametro}}' == 'NRO_DOC_ALFANUM'){
      if('{{$val->valor}}' == 'SI'){
        $('#DNI1').mask('AAAAAAAAAAAAAAAAAAAA', {'translation': {
            A: {pattern: /[A-Za-z0-9--]/}
          }
        });
      }else{
        $('#DNI1').mask('09999999999999999999)');
      }
    }
  @endforeach
    
  $('#referencia').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9\s]/}
    }
  });
  $('#telefono').mask('999999999999999999999', {'translation': {
      '9': {pattern: /[(--)0-9\s]/}
    }
  });
  $('#representante1').mask('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', {'translation': {
      A: {pattern: /[A-Za-z0-9ñÑ\s]/}
    }
  });
  

  //---------------------------------VALIDA ID QUE NO SE REPITA-----------------------------------------

  var focus = 0;

  $("#idempresa").focusout(function() {
    focus++;
    console.log(focus);

    var data = $(this).val();

          $.ajax({
              url: "{{ url('/empresa/verificarID') }}",
              type:"POST",
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf-token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
             type:'POST',
             url:"{{ url('/empresa/verificarID') }}",
             data:{
              codigo:data
             },

             success:function(data){              
                if ( data[0] == "error") {
                  
                }
                if (data.errors == 'EXISTE') {

                  $('#idempresa').val('');
                  $('#idempresa').focus();

                  setTimeout(function() {
                    M.toast({ html: '<span>El código de Empresa ingresado ya existe. Ingrese un código distinto.</span>'});
                  }, 2000); 
                }  
             },

             error:function(){ 
                alert("error!!!!");
          }
          });
        
  });
  
</script>