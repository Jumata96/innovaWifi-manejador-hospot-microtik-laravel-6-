<script type="text/javascript">
	$('#idtipo').change(function(e){
      var val = $('#idtipo').val();

      $("#idperfil option[value=0]").attr("selected", true);
      $("#idperfil option[value=cero]").attr("selected",true);

      if ( val != '0') {
        $('#idperfil').removeAttr("disabled");
      }else{
        $('#idperfil').attr("disabled");        
      };
      
    });

    @foreach ($queues as $val)
      $(document).on('click','#upd{{$val->idperfil}}', function(){
        $("#u_name").val($(this).data('name'));
        $("#u_precio").val($(this).data('precio'));
        $("#u_vbajada").val($(this).data('vbajada'));
        $("#u_vsubida").val($(this).data('vsubida'));
        $("#u_glosa").text($(this).data('glosa'));
        $("#u_idperfil").val($(this).data('id'));

        var idrouter = $(this).data('idrouter');

        $("#u_idrouter option[value="+idrouter+"]").attr("selected",true);

        if($(this).data('estado') == 1){
          $('#u_estado').hide();
          $('#u_estado2').show();
        }else{
          $('#u_estado2').hide();
          $('#u_estado').show();
        }

      });      
    @endforeach

</script>