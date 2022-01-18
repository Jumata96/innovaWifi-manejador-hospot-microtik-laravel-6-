<script type="text/javascript">
//---JPaiva-08-02-2019----------------IMPORTAR-----------------------------
  var val = null;

  $(document).on('click','#importHotspot', function(){
    //cont = parseInt($('#cont').val());
    
      var data = $('#formImportHotspot').serializeArray();
        // console.log(data);
        $.ajax({
            url: "{{ url('/guardarImportPerfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/guardarImportPerfil') }}",
           data:data,

           success:function(data){

             setTimeout(function() {
              Materialize.toast({ html: '<span>Importación de perfiles exitoso</span>'});
                }, 2000); 

            //  window.location="{{ url('/perfiles') }}";

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
    
  });      

  $('#i_idrouter').change(function(e){
      val = $("select[name=i_idrouter]").val();
  
        $.ajax({
            url: "{{ url('/importPerfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/importPerfil') }}",
           data:{
              idrouter:val,
              idtipo:'HST'
           },

           success:function(data){
            
            var valor = "";
            cont = parseInt($('#cont').val());

            for (var i = 0; i <= cont; i++) {
              $("#import" + i).remove();
            }
              
              $.each(data, function(i, item) {     
               
                
                @foreach($router as $rout)                   
                  if("{{$rout->idrouter}}" == val){      
                    valor = "{{$rout->alias}}";
                  }
                @endforeach   
                $("#tableImport").append("<tr class='' id='import"+ i +"'>"+
                  //"<form id='myForm"+i+"' accept-charset='UTF-8' enctype='multipart/form-data' class='grey lighten-5'>"+
                  "<input type='hidden' name='name"+i+"' value='"+item.name+"'>"+
                  "<input type='hidden' name='target"+i+"' value='"+item['rate-limit']+"'>"+                  
                  "<td><p class='center'>"+
                    "<input type='checkbox' class='filled-in' id='check"+i+"' name='check"+i+"'>"+
                    "<label for='check"+i+"'></label>"+
                  "</p>"+
                  "</td>"+                  
                  "<td>"+ valor +"</td>"+                                     
                  "<td>"+ item.name +"</td>"+
                  "<td>"+ item['rate-limit'] +"</td>"+
                  "<td class='center'>"+ 
                    "<input id='precio"+i+"' name='precio"+i+"' type='number' class='right-align input_numerico' style='margin: 0; height: 2rem; width: 80%'>"+
                  "</td>"+
                  "<td><p class='center'>"+
                    "<input type='checkbox' class='filled-in' id='principal"+i+"' name='principal"+i+"'>"+
                    "<label for='principal"+i+"'></label>"+
                  "</p>"+
                  "</td>"+  
                 // "</form>"+                 
                "</tr>");

                cont = i;
              });

              $('#cont').val(cont);
              $('#id_router').val(val);
              
           },
           error:function(){ 
              alert("error!!!!");
        }

        });
   
  });

  //-------------------SELECCIONAR TODO LOS CHECK------------------------
  $(document).on('click','#i_allCheck', function(){  
    cont = parseInt($('#cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", true );
    }

  });       

  //--------------------------QUITAR CHECK A TODOS-----------------------------
  $(document).on('click','#i_clearCheck', function(){  
    cont = parseInt($('#cont').val());

    for (var i = 0; i <= cont; i++) {
      $( "#check"+i ).prop( "checked", false );
    }
  });    

  //---------------------------LIMPIAR DATOS---------------------
  $('#iHotspot2').click(function(e){
    cont = parseInt($('#cont').val());

    $('i_idrouter').val('0');

    for (var i = 0; i <= cont; i++) {
      $("#import" + i).remove();
    }
  });

</script>
