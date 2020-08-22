<script type="text/javascript">
//---------------JPaiva--25-03-2019-----------------------------------DHASHBOARD--------------------------------------------------------
	$('#idrouter').change(function(e){
      
        $('#interface').removeAttr("disabled");

        $.ajax({
            url: "{{ url('/getInterfaces') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/getInterfaces') }}",
           data:{
              idrouter:$("select[name=idrouter]").val()
           },

           success:function(data){
              datos = data;

              $('#interface').empty();  
              $('#interface').removeAttr('disabled');

              $('#interface').append("<option value='n'>Seleccionar interface</option>");      

              $.each(data, function(i, item) {
                  $('#interface').append("<option value='"+item.name+"'>"+item.name+"</option>");
              });

              $("#interface option[value=n]").attr('disabled', true);

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
      
    });

    $(document).ready(function(){
           $('#interface').removeAttr("disabled");

        $.ajax({
            url: "{{ url('/getInterfaces') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/getInterfaces') }}",
           data:{
              idrouter:$("select[name=idrouter]").val()
           },

           success:function(data){
              datos = data;
console.log(datos);
              $('#interface').empty();  
              $('#interface').removeAttr('disabled');

              $('#interface').append("<option value='n'>Seleccionar interface</option>");      

              $.each(data, function(i, item) {
                  if (item.name == '{{$interface}}') {
                    $('#interface').append("<option selected value='"+item.name+"'>"+item.name+"</option>");
                  }else{
                    $('#interface').append("<option value='"+item.name+"'>"+item.name+"</option>");  
                  }
                  
              });

              $("#interface option[value=n]").attr('disabled', true);

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
    });
</script>