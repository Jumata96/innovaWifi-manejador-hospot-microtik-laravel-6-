<script type="text/javascript">
	 //-------------------------------------------------------PERFIL PPPoE-------------------------------------------------------------
     $('#p_idrouter').change(function(e){
      var val = $("select[name=p_idrouter]").val();

      $("#p_perfil option[value=0]").attr("selected", true);
      $("#p_perfil option[value=cero]").attr("selected",true);

      if ( val != '0') {
        $('#p_perfil').removeAttr("disabled");

        $.ajax({
            url: "{{ url('/perfil/pppoe') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/perfil/pppoe') }}",
           data:{
              idrouter:$("select[name=p_idrouter]").val()
           },

           success:function(data){

              //var obj = $.parseJSON(data); 
              $('#p_perfil').empty();  
              $('#p_perfil').removeAttr('disabled');
              //$('#h_dsc_perfil').removeAttr('disabled');  

              $('#p_perfil').append("<option value='n'>Elija un perfil</option>");
              $('#p_perfil').append("<option value='0'>Crear perfil</option>"); 

              $.each(data, function(i, item) {
                  $('#p_perfil').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

     $('#p_agregar').click(function(e){
      $('#p_name').val('');
                $('#p_precio').val('');
                $('#p_vsubida').val('');
                $('#p_vbajada').val('');
                $('#p_idrouter option[value=e]').attr('selected',true);
                $('#p_perfil option[value=sn]').attr('selected',true);
                $('#p_dsc_perfil').val('');

    $('#p_error1').text('');
                $('#p_error2').text('');
                $('#p_error3').text('');
                $('#p_error6').text('');
                $('#p_error7').text('');
                $('#p_error4').text('');
     });

    


    $('#p_perfil').change(function(e){
      var val = $("select[name=p_perfil]").val();
      console.log('webrsadfvsdb');

      if (val == '0') {
        $('#p_remote_address').removeAttr('disabled'); 
        $('#p_remote_address').val(''); 
        $('#p_local_address').removeAttr('disabled'); 
        $('#p_local_address').val(''); 
        $('#p_dsc_perfil').removeAttr('disabled'); 
        $('#p_dsc_perfil').val(''); 

        $.ajax({
            url: "{{ url('/ip/pool') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/ip/pool') }}",
           data:{
              idrouter:$("select[name=p_idrouter]").val()
           },

           success:function(data){

              //var obj = $.parseJSON(data); 
              $('#p_remote_address').empty();  
              $('#p_remote_address').removeAttr('disabled');
              //$('#h_dsc_perfil').removeAttr('disabled');  

              $('#p_remote_address').append("<option value='0'>Elija un perfil</option>");

              $.each(data, function(i, item) {
                  $('#p_remote_address').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
      }else{
        $('#p_remote_address').empty();  
        $('#p_remote_address').attr('disabled',true); 
        $('#p_local_address').attr('disabled',true); 
        $('#p_dsc_perfil').attr('disabled',true); 
      }
       
    });

    $('#pu_perfil').change(function(e){
      console.log('dfghfn');
      var val = $("select[name=pu_perfil]").val();

      if (val == '0') {
        $('#pu_dsc_perfil').removeAttr('disabled'); 
        $('#pu_dsc_perfil').val(''); 
      }else{
        $('#pu_dsc_perfil').attr('disabled',true); 
        $('#pu_dsc_perfil').val(val); 
      }

       
    });

</script>