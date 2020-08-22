<script type="text/javascript">
  $("#compAdd").click(function(e){

    var fecha_vencimiento = null;
    var fecha_corte = null;
    var fecha_inicio = null;
    var fecha_fin = null;
    var importe = null;
    var perfil = null;
    var vsubida = null;
    var vbajada = null;
    
    @foreach($notificaciones as $val)
      @if($val->aviso >0)                
        fecha_vencimiento = '{{ date_format(date_create($val->fecha_pago),'d/m/Y') }}';   
        fecha_corte = '{{ date_format(date_create($val->fecha_corte),'d/m/Y') }}';  
        fecha_inicio = '{{ date_format(date_create($val->fecha_inicio),'d/m/Y') }}';  
        fecha_fin = '{{ date_format(date_create($val->fecha_fin),'d/m/Y') }}';  

        $('#fecha_vencimiento').val(fecha_vencimiento);
        $('#fecha_emision').val(fecha_corte);
      @endif
    @endforeach   
   
    @foreach($servicio as $val)
      importe = '{{ $val->precio }}'; 

      @foreach ($perfiles as $valor)
        @if($valor->idperfil == $val->perfil_internet)
          perfil = '{{$valor->name}}';
          vsubida = '{{$valor->vsubida}}';
          vbajada = '{{$valor->vbajada}}';
        @endif
      @endforeach

      $('#precio_unitario').val(importe);
      $('#descripcion').css('height','130px');
      $('#descripcion').text('Servicio de Internet Banda ancha \n Periodo: desde '+fecha_inicio +' hasta '+fecha_fin+' \n Fecha de corte: '+fecha_corte+' \n Plan de Internet: '+perfil+' \n Descarga: '+vbajada+' \n Subida: '+ vsubida);
    @endforeach

    $('#subtotal').val(importe);
    $('#descuento').val('0');
    $('#subtotal_neto').val(importe);
    $('#impuesto').val('0');
    $('#total').val(importe);    

  });

</script>