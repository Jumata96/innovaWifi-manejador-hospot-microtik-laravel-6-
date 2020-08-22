<div id="mntTipoAcceso" class="modal modal-fixed-footer" style="height: 100%;">
              <div class="modal-content" style="padding: 0px; overflow-y: disabled; height: 300%; background-color: #f9f9f9">
                                  
                                  <div class="row cabecera" style="margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 3">                 
                                    <div class="col s12 m12 l12">
                                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                                      <h4 class="header2" style="margin: 10px 0px;"><b>Registrar Tipo de Acceso</b></h4>  
                                    </div>
                                  </div>
                                  
                                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-top: 40px; margin-left: 0rem; margin-right: 0rem; position: fixed; width: 100%; z-index: 2">
                                        <div class="col s12 m12 herramienta">                         
                                          <button id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar"><i class="mdi-navigation-check" style="color: #2E7D32"></i></button>
                                          <a style="margin-left: 6px"></a>   
                                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario"><i class="mdi-action-info"></i></a>
                                          <a href="#" id="cerrar" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped modal-close" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar"><i class="mdi-hardware-keyboard-tab" style="color: #424242"></i></a>  
                                          <button class="modal-close" hidden="true" ></button>        
                                        </div>  

                                        @include('forms.scripts.modalInformacion')              
                                        
                                  </div>
                                                    
                                  <form style="margin-top: 40px">
                                  <div class="row cuerpo" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-top:55px; z-index: 1">      

                                      <div class="row">                                        
                                        <div class="card white">
                                            <div class="card-content" style="padding-top: 4px">
                                              <span class="card-title">Datos Generales</span>
                                                <div class="row">
                                                  <div class="input-field col s12 m6 l6">
                                                    <i class="mdi-toggle-radio-button-off prefix active"></i>
                                                    <input id="idtipo" name="idtipo" type="text" maxlength="3" minlength="1">
                                                    <label for="idtipo">Cod. Tipo de Accesoo</label>
                                                    <div id="error1" style="color: red; font-size: 12px; font-style: italic; padding-left: 45px"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
                                                    <div class="chip center-align" style="width: 70%">
                                                      <b>Estado:</b> No Disponible
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>  
                                                <div class="row">
                                                  <div class="input-field col s12 s12 m6 l6">
                                                    <i class="mdi-editor-mode-edit prefix active"></i>
                                                    <input id="descripcion" name="descripcion" type="text">
                                                    <label for="descripcion">Descripción</label>
                                                    <div id="error2" style="color: red; font-size: 12px; font-style: italic; padding-left: 45px"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6">
                                                    <i class="mdi-editor-format-strikethrough prefix active"></i>
                                                    <input id="dsc_corta" name="dsc_corta" type="text" maxlength="3" minlength="1">
                                                    <label for="dsc_corta">Desc. Corta</label>
                                                  </div>
                                                </div>    
                                                <div class="row">
                                                  <div class="input-field col s12 m6 l6">
                                                  <i class="mdi-content-sort prefix"></i>
                                                  <textarea id="glosa" name="glosa" class="materialize-textarea" lenght="200" maxlength="200" style="height: 80px;"></textarea>
                                                  <label for="glosa" class="">Comentario</label>
                                                </div>     
                                                </div>                       
                                            </div>
                                        </div>                                        
                                      </div>                              
                                    </div> 
                                  </form>

              </div>
              
            </div>

@section('script')
<script type="text/javascript">

    $('#cerrar').click(function(e) {
      console.log("pruebaaa");
      $('#cerrar2').trigger('click');
    });

    $('#upd-mostrar').click(function(e){
      $('#u_error2').text('');
    });

    $('#add-mostrar').click(function(e){
      $("input[name=idtipo]").val('');
      $("input[name=descripcion]").val('');
      $("input[name=dsc_corta]").val('');
      $("textarea[name=glosa]").val('');
      $('#error1').text('');
      $('#error2').text('');
    });

    @foreach ($tipo as $val)
      $(document).on('click','#upd{{$val->idtipo}}', function(){
        $("#u_idtipo").val($(this).data('id'));
        $("#u_descripcion").val($(this).data('descripcion'));
        $("#u_dsc_corta").val($(this).data('dsc'));
        $("#u_glosa").text($(this).data('glosa'));

        val = $(this).data('estado');
        console.log(val);

        if($(this).data('estado') == 1){
          $('#u_estado').hide();
          $('#u_estado2').show();
          console.log('ingresoo');
        }else{
          $('#u_estado2').hide();
          $('#u_estado').show();
        }
      });      
    @endforeach

    //---JPaiva-04-06-2018----------------ACTUALIZAR-----------------------------
    $('#update').click(function(e){
      e.preventDefault();
      console.log("entroo..");

      $.ajax({
            url: "{{ url('/tipo/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/tipo/actualizar') }}",
           data:{
              idtipo:$("input[name=u_idtipo]").val(), 
              descripcion:$("input[name=u_descripcion]").val(),
              dsc_corta:$("input[name=u_dsc_corta]").val(),
              glosa:$("textarea[name=u_glosa]").val()
           },

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.descripcion != "undefined" )? $('#u_error2').text(data.descripcion) : null;
              } else {  
                var obj = $.parseJSON(data); 

                $('#tr'+obj[0]['idtipo']).replaceWith(
                "<td>"+ obj[0]['idtipo'] +"</td>"+
                "<td>"+ obj[0]['idtipo'] +"</td>"+
                "<td>"+ obj[0]['descripcion'] +"</td>"+
                "<td>"+ obj[0]['estado'] +"</td>"+
                "<td>"+ obj[0]['fecha_creacion'] +"</td>"+
                "<td class='center'>"+
                  "<a href='#updTipoAcceso' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger actualizar' data-position='top' data-delay='500' data-tooltip='Ver/Actualizar'><i class='mdi-action-visibility' style='color: #7986cb' data-id='"+ obj[0]['idtipo'] +"' data-descripcion='"+ obj[0]['descripcion'] +"' data-dsc='"+ obj[0]['dsc_corta'] +"' data-glosa='"+ obj[0]['glosa'] +"' id='upd"+ obj[0]['idtipo'] +"'></i></a> "+

                  " <a href='#confirmacion"+ obj[0]['idtipo'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-remove' style='color: #dd2c00'></i></a>"+
                "</td>"
                );
                //alert(data.success);

                //$('#updTipoAcceso').hide();
                $('#u_cerrar').trigger('click');

                setTimeout(function() {
                  Materialize.toast('<span>Registro actualizado</span>', 1500);
                }, 100);  
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
        });


    });    
    

    //---JPaiva-04-06-2018--------------GRABAR----------------------------
    $("#add").click(function(e){
        e.preventDefault();         

        $.ajax({
            url: "{{ url('/tipo/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/tipo/grabar') }}",
           data:{
              idtipo:$("input[name=idtipo]").val(), 
              descripcion:$("input[name=descripcion]").val(),
              dsc_corta:$("input[name=dsc_corta]").val(),
              glosa:$("textarea[name=glosa]").val()
           },

           success:function(data){
              //console.log(data.idtipo);
              //var obj = $.parseJSON(data);
              console.log(data);

              if ( data[0] == "error") {
                ( typeof data.idtipo != "undefined" )? $('#error1').text(data.idtipo) : null;
                ( typeof data.descripcion != "undefined" )? $('#error2').text(data.descripcion) : null;
              } else {              
                //console.log(Object.values(data));
                var obj = $.parseJSON(data);

                $("#data-table-simple").append("<tr id='tr"+ obj[0]['idtipo'] +"'>"+
                "<td>"+ obj[0]['idtipo'] +"</td>"+
                "<td>"+ obj[0]['idtipo'] +"</td>"+
                "<td>"+ obj[0]['descripcion'] +"</td>"+
                "<td>"+ obj[0]['estado'] +"</td>"+
                "<td>"+ obj[0]['fecha_creacion'] +"</td>"+
                "<td class='center'>"+
                  "<a href='#updTipoAcceso' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger actualizar' data-position='top' data-delay='500' data-tooltip='Ver/Actualizar'><i class='mdi-action-visibility' style='color: #7986cb' data-id='"+ obj[0]['idtipo'] +"' data-descripcion='"+ obj[0]['descripcion'] +"' data-dsc='"+ obj[0]['dsc_corta'] +"' data-glosa='"+ obj[0]['glosa'] +"' id='upd"+ obj[0]['idtipo'] +"'></i></a>"+

                  " <a href='#confirmacion"+ obj[0]['idtipo'] +"' class='btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger' data-position='top' data-delay='500' data-tooltip='Eliminar'><i class='mdi-content-remove' style='color: #dd2c00'></i></a>"+
                "</td>"+
                "</tr>");

                //alert(data.success);
                $("input[name=idtipo]").val('');
                $("input[name=descripcion]").val('');
                $("input[name=dsc_corta]").val('');
                $("textarea[name=glosa]").val('');

                //$('#mntTipoAcceso').hide();
                $('#cerrar').trigger('click');

                setTimeout(function() {
                  Materialize.toast('<span>Registro exitoso</span>', 1500);
                }, 100); 

                $('#updTipoAcceso').hide();
            }
           },

           error:function(){ 
              alert("error!!!!");
        }
        });  
    });

    //----JPaiva-04-06-2018------------------Eliminar---------------------------
    @foreach ($tipo as $val)
        $('#e{{$val->idtipo}}').click(function(e){
          e.preventDefault();

          id = $(this).data('ideliminar');

          $.ajax({
                url: "{{ url('/tipo/eliminar') }}",
                type:"POST",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf-token"]').attr('content');

                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
               type:'POST',
               url:"{{ url('/tipo/eliminar') }}",
               data:{
                  idtipo:$(this).data('ideliminar')
               },

               success: function(data){
                
                $('#tr' + id ).remove();

                setTimeout(function() {
                  Materialize.toast('<span>Registro eliminado</span>', 1500);
                }, 100);  

               },
               error:function(){ 
                  alert("error!!!!");
            }
            });
        });    
          
    @endforeach
</script>
@endsection