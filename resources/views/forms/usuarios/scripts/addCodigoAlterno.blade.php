<script>
      //------JMAZUELOS--26-09-2020-------------GRABAR CODIGO ALTERNO-----------------------------------
    
    $("#addNewCodAltm").click(function(e){
      let uduarioId =$('#id').val();
      let codigoAlterno =$('#codigoAlternoNuevo').val();
      console.log(codigoAlterno);

      if(codigoAlterno !="" ){
        console.log('ingreso');

        $.ajax({
            url: "{{ url('/usuario/Store/codigoAlterno') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/usuario/Store/codigoAlterno') }}",
           data:{
             codigoalterno:codigoAlterno,
             vendedorId:uduarioId
           },

           success:function(data){

              $('#codigoAlterno').append("<option value='"+data.codigo+"'>"+data.descripcion+"</option>"); 
              $('#codigoAlterno4').text("");
              $('#modalAddCodAlt').modal('close');
                setTimeout(function() {
                    Materialize.toast('<span style="color:#e65100"><b></b>NUEVO CÓDIGO ALTERNO.</i></span>', 500);
                  }, 000);
            

           },

           error:function(){ 
              alert("error!!!!");
        }
        });  
      }
      else{
        $('#codigoAlterno4').text("ingrese el codigo"); 
      }
    });
  </script>