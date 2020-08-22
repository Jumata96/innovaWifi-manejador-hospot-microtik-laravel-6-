<script type="text/javascript">
	//-----JPaiva--13-07-2018-------------GRABAR-----------------------------------
    $("#addComp").click(function(e){
        e.preventDefault();

        var idcliente = null;

       @foreach($clientes as $datos)
          idcliente = '{{$datos->idcliente}}';
       @endforeach
       
        $.ajax({
            url: "{{ url('/comprobante/cliente/guardar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/comprobante/cliente/guardar') }}",
           data:{
              fecha_emision:$("input[name=fecha_emision]").val(), 
              fecha_vencimiento:$("input[name=fecha_vencimiento]").val(), 
              descripcion:$("textarea[name=descripcion]").val(), 
              precio_unitario:$("input[name=precio_unitario]").val(), 
              subtotal:$("input[name=subtotal]").val(), 
              descuento:$("input[name=descuento]").val(), 
              subtotal_neto:$("input[name=subtotal_neto]").val(), 
              impuesto:$("input[name=impuesto]").val(), 
              total:$("input[name=total]").val(), 
              idcliente:idcliente
           },

           success:function(data){
              console.log(data);

              if ( data[0] == "error") {
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.name != "undefined" )? $('#error2').text(data.name) : null;
                ( typeof data.precio != "undefined" )? $('#error3').text(data.precio) : null;
                ( typeof data.vsubida != "undefined" )? $('#error4').text(data.vsubida) : null;
                ( typeof data.vbajada != "undefined" )? $('#error5').text(data.vbajada) : null;
              } else {   

                var obj = $.parseJSON(data);
                
                $("#lstComprobante").append("<tr class='fac"+ obj[0]['codigo'] +"'>"+
                "<td>"+ "#" +"</td>"+
                "<td>"+ obj[0]['iddocumento']  +" "+ obj[0]['serie'] + "-" + obj[0]['numero'] +"</td>"+
                "<td>"+ obj[0]['fecha_emision'] +"</td>"+
                "<td>"+ obj[0]['fecha_vencimiento'] +"</td>"+
                "<td>"+ obj[0]['subtotal'] +"</td>"+
                "<td>"+ obj[0]['impuesto'] +"</td>"+
                "<td>"+ obj[0]['total'] +"</td>"+
                "<td>"+ obj[0]['idestado'] +"</td>"+
                "<td></td>"+
                "<td>"+ obj[0]['idforma_pago'] +"</td>"+
                "<td class='center'>"+
                  "<a href='{{ url('/perfil/mostrar') }}/"+ obj[0]['codigo'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped' data-position='top' data-delay='500' data-tooltip='Ver'><i class='mdi-action-visibility' style='color: #7986cb'></i></a>"+                                     
                  " <a href='#confirmacion"+ obj[0]['codigo'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-remove' style='color: #dd2c00'></i></a>"+
                "</td>"+
                "</tr>");
              
                 $('#cerrarC').trigger('click');

                setTimeout(function() {
                  Materialize.toast('<span>Registro exitoso</span>', 1500);
                }, 100); 


              }
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });
  });

    
</script>