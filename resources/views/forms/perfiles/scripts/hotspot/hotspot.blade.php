<script type="text/javascript">
	 //-------------------------------------------------------HOTSPOT-------------------------------------------------------------
     $('#h_idrouter').change(function(e){
      var val = $("select[name=h_idrouter]").val();

      $("#idperfil option[value=0]").attr("selected", true);
      $("#idperfil option[value=cero]").attr("selected",true);

      if ( val != '0') {
        $('#idperfil').removeAttr("disabled");

        $.ajax({
            url: "{{ url('/hotspot/perfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/hotspot/perfil') }}",
           data:{
              idrouter:$("select[name=h_idrouter]").val()
           },

           success:function(data){

              //var obj = $.parseJSON(data); 
              $('#h_perfil').empty();  
              $('#h_perfil').removeAttr('disabled');
              //$('#h_dsc_perfil').removeAttr('disabled');  

              $('#h_perfil').append("<option value='n'>Elija un perfil </option>");
              $('#h_perfil').append("<option value='0'>Crear perfil</option>"); 

              // $.each(data, function(i, item) {
              //     $('#h_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
              // });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

     $('#h_agregar').click(function(e){
      $('#h_name').val('');
      $('#h_precio').val('');
      $('#h_vsubida').val('');
      $('#h_vbajada').val('');
      $('#h_perfil').val('');
      $('#h_dsc_perfil').val('');
      $("#h_idrouter option[value='']").attr("selected",true);

      $('#h_error1').text('');
      $('#h_error2').text('');
      $('#h_error3').text('');
      $('#h_error6').text('');
      $('#h_error7').text('');
      $('#h_error4').text('');
     });

    


    $('#h_perfil').change(function(e){
      var val = $("select[name=h_perfil]").val();

      if (val == '0') {
        $('#h_dsc_perfil').removeAttr('disabled'); 
        $('#h_dsc_perfil').val(''); 
      }else{
        $('#h_dsc_perfil').attr('disabled',true); 
        $('#h_dsc_perfil').val(val); 
      }

       
    });

    $('#hu_perfil').change(function(e){
      console.log('dfghfn');
      var val = $("select[name=hu_perfil]").val();

      if (val == '0') {
        $('#hu_dsc_perfil').removeAttr('disabled'); 
        $('#hu_dsc_perfil').val(''); 
      }else{
        $('#hu_dsc_perfil').attr('disabled',true); 
        $('#hu_dsc_perfil').val(val); 
      }

       
    });

</script>