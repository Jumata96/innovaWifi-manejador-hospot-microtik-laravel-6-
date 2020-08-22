<script type="text/javascript">
	//---------JPaiva--25-06-2018------------------------------------------GRUPO-------------------------------------------------------------
     $('#idgrupo').change(function(e){

      var val = $("select[name=idgrupo]").val();

      if ( val != '') {

        $.ajax({
            url: "{{ url('/getMarca') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/getMarca') }}",
           data:{
              idgrupo:val
           },

           	success:function(data){
	              //var obj = $.parseJSON(data); 
	            $('#idmarca').empty();  
	            $('#idmarca').removeAttr('disabled');
	             //$('#h_dsc_perfil').removeAttr('disabled');  
	            $('#idmarca').append("<option value='n'>Elija una marca</option>");

	            $.each(data, function(i, item) {
	               $('#idmarca').append("<option value='"+item.idmarca+"'>"+item.descripcion+"</option>");
	            });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

     $('#idmarca').change(function(e){

      var val = $("select[name=idmarca]").val();
console.log(val);
      if ( val != '') {

        $.ajax({
            url: "{{ url('/getModelo') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/getModelo') }}",
           data:{
              idmarca:val
           },

           	success:function(data){
	              //var obj = $.parseJSON(data); 
	            $('#idmodelo').empty();  
	            $('#idmodelo').removeAttr('disabled');
	             //$('#h_dsc_perfil').removeAttr('disabled');  
	            $('#idmodelo').append("<option value='n'>Elija un modelo</option>");

	            $.each(data, function(i, item) {
	               $('#idmodelo').append("<option value='"+item.idmodelo+"'>"+item.descripcion+"</option>");
	            });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

</script>