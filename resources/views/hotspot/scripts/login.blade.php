<script type="text/javascript">
      //---JPaiva-11-12-2018----------------GUARDAR-----------------------------
    $('#ingresar').click(function(e){
      e.preventDefault();

      @foreach($usuario as $val)
        idcliente = '{{$val->codigo}}';
      @endforeach
      

      $.ajax({
            url: "{{ url('/hotspot/validar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/hotspot/validar') }}",
           data:{
              idcliente:idcliente,
              ip:'{{$ip}}',
              mac:'{{$mac}}'
           },

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.ruc != "undefined" )? $('#error1').text(data.ruc) : null;
                ( typeof data.razon_social != "undefined" )? $('#error2').text(data.razon_social) : null;
                
              }else if(data == 'BLOQUEADO'){  

                setTimeout(function() {
                  Materialize.toast('<span>Usted alcanzo el límite de ingreso permitido por día.</span>', 4500);
                }, 100);  

              }else if(data == 'ACCEDER'){  
                

                @foreach($usuario as $val)
                  $('#username').val('{{$val->email}}');
                  $('#password').val('{{$val->contrasena}}');
                @endforeach

                $('#acceder').trigger('click');
                               
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

      
    });

    function carga(){
      
      contador =0;
      valor = 0;

      @foreach($parametros as $parametro)
        @if($parametro->parametro == 'ADD_TEMPORIZADOR')
          valor = parseInt('{{$parametro->valor_long}}')
        @endif
      @endforeach

      setInterval(function(){
          if(contador < valor){
            $('#ingresar').text(valor);
          }else if(contador == valor){
            $('#ingresar').text('Ingreso Gratuito');
            $('#ingresar').removeAttr("disabled");
          }

          
          valor--;

        }
        ,1000);
    }

    window.addEventListener("load", function(){

      carga();
    });


</script>