@extends('layouts2.app')
@section('titulo','Registro de Servicio')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>REGISTRAR SERVICIO</h2>
                  </div>
                  <form class="formValidate right-alert">
                    <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <button id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i></button>
                          <a style="margin-left: 6px"></a>   
                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario">
                            <i class="material-icons ">info</i></a>
                          <a href="{{url('/empresa')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons " style="color: #424242">keyboard_tab</i></a>            
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col s12 m12 l12">
                          <div class="card white">
                                            <div class="card-content">
                                                <div class="row">
                                                  <div class="col s12 m6 l6">
                                                    <label for="idrouter">Router Mikrotik</label>
                                                    <select class="browser-default" id="idrouter" name="idrouter" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Elija un router</option>
                                                      <option value="0">Todos</option>
                                                      @foreach ($router as $valor)
                                                      <option value="{{ $valor->idrouter }}">{{ $valor->alias }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>

                                                  <div class="input-field col s12 s12 m6 l6 right-align">
                                                    <div class="chip center-align" style="width: 70%">
                                                      <b>Estado:</b> No Disponible
                                                      <i class="material-icons mdi-navigation-close"></i>
                                                    </div>
                                                  </div> 
                                                </div>                     
                                            </div>
                                        </div>                                       
                      </div>  

                      <div class="col s12 m12 l6">
                          <div class="card white">
                                            <div class="card-content">                                               
                                              <span class="card-title">Datos Generales</span>

                                              <div class="row">                                                  
                                                  <div class="col s12 m6 l6">                                                    
                                                    <label for="idtipo">Tipo de Acceso</label>
                                                    <select class="browser-default" id="idtipo" name="idtipo" data-error=".errorTxt1" disabled> 
                                                      <option value="0" disabled="" selected="">Elija opción</option>
                                                      @foreach ($tipo as $valor)
                                                      <option value="{{ $valor->dsc_corta }}">{{ $valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" id="error2" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>
                                                  <div class="col s12 m6 l6">
                                                    <label for="idperfil">Perfil de Internet</label>
                                                    <select class="browser-default" id="idperfil" name="idperfil" data-error=".errorTxt1" disabled> 
                                                      <option value="cero" disabled="" selected="">Seleccione un perfil</option>
                                                    </select>
                                                    <div class="errorTxt1" id="error3" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>      
                                                </div>           
                                              <div class="row"> 
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">insert_invitation</i>
                                                  <input id="dia_pago" name="dia_pago" type="text" maxlength="2">
                                                  <label for="dia_pago">Día de Pago</label>
                                                  <div class="errorTxt1" id="error4" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">attach_money</i>
                                                  <input id="precio" name="precio" type="text" placeholder="" maxlength="9">
                                                  <label for="precio">Precio del Plan</label>
                                                  <div class="errorTxt1" id="error5" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                </div>
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">account_circle</i>
                                                  <input id="usuario_cliente" name="usuario_cliente" type="text">
                                                  <label for="usuario_cliente">Usuario</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">vpn_key</i>
                                                  <input id="contrasena_cliente" name="contrasena_cliente" type="text">
                                                  <label for="contrasena_cliente">Contraseña</label>
                                                </div>         
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">place</i>
                                                  <input id="direccion" name="direccion" type="text">
                                                  <label for="direccion">Dirección</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">my_location</i>
                                                  <input id="Coordenadas" name="coordenadas" type="text">
                                                  <label for="coordenadas">Coordenadas</label>
                                                </div>     
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">settings_ethernet</i>
                                                  <input id="ip" name="ip" type="text">
                                                  <label for="ip">Dirección IP</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">blur_linear</i>
                                                  <input id="mac" name="mac" type="text">
                                                  <label for="mac">MAC</label>
                                                </div>                        
                                              </div>     
                                            </div>
                    </div>
                  </div>

                  <div class="col s12 m12 l6">
                <div class="card white">
                                            <div class="card-content">
                                              <span class="card-title">Datos técnicos</span>

                                              <div class="row">
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">insert_invitation</i>
                                                  <input id="fecha_instalacion" name="fecha_instalacion" type="text" placeholder="dd/mm/AAAA">
                                                  <label for="fecha_instalacion">Fecha de Instalación</label>
                                                </div>  
                                                
                                                 <div class="col s12 m6 l6">
                                                    <label for="emisor_conectado">Equipo Emisor</label>
                                                    <select class="browser-default" id="emisor_conectado" name="emisor_conectado" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Seleccione un equipo</option>
                                                      @foreach ($eqemisor as $valor)
                                                      <option value="{{ $valor->idequipo }}">{{ $valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1" style="color: red; font-size: 12px; font-style: italic;"></div>
                                                  </div>                               
                                              </div>           
                                              
                                                <div class="col s12 m6 l6">
                                                    <label for="equipo_receptor">Equipo Receptor</label>
                                                    <select class="browser-default" id="equipo_receptor" name="equipo_receptor" data-error=".errorTxt1" > 
                                                      <option value="" disabled="" selected="">Equipo Cliente Receptor</option>
                                                      @foreach ($eqreceptor as $valor)
                                                      <option value="{{ $valor->idequipo }}">{{ $valor->descripcion }}</option>
                                                      @endforeach
                                                    </select>
                                                    <div class="errorTxt1"></div>
                                                  </div>            

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">settings_ethernet</i>
                                                  <input id="ip_receptor" name="ip_receptor" type="text" placeholder="">
                                                  <label for="ip_receptor">IP equipo receptor</label>
                                                </div>     
                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">portrait</i>
                                                  <input id="usuario_receptor" name="usuario_receptor" type="text" placeholder="">
                                                  <label for="usuario_receptor">Usuario Equipo Receptor</label>
                                                </div>

                                                <div class="input-field col s12 s12 m6 l6">
                                                  <i class="material-icons prefix">vpn_key</i>
                                                  <input id="contrasena_receptor" name="contrasena_receptor" type="text" placeholder="">
                                                  <label for="contrasena_receptor">Contraseña Equipo Receptor</label>
                                                </div>       
                                                <div class="input-field col s12 m6 l6">
                                                  <i class="material-icons prefix">mode_edit</i>
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
</div>
<br><br><br>
@endsection

@section('script')
  
  <script type="text/javascript">
    $('#fecha_instalacion').formatter({
          'pattern': '@{{99}}/@{{99}}/@{{9999}}',
        });

    $('#dia_pago').formatter({
      'pattern' : '@{{99}}'
    });

 
    $('#ip').mask('099.099.099.099');
    $('#mac').mask('AA:AA:AA:AA:AA:AA');
    $('#ip_receptor').mask('099.099.099.099');
    $('#usuario_cliente').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');
    $('#usuario_receptor').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');
    $('#precio').mask('###0.00', {reverse: true});

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

    $('#idperfil').change(function(e){
      val = $('#idperfil').val();
        console.log(val);

      @foreach($perfiles as $perfil)
        if (val == "{{$perfil->idperfil}}"){
          $('#precio').val('{{$perfil->precio}}');
        }
      @endforeach
    });

    $('#equipo_receptor').change(function(e){
      val = $('#equipo_receptor').val();

      @foreach($eqreceptor as $val)
        if (val == {{$val->idequipo}}){
          $('#usuario_receptor').val('{{$val->usuario}}');
          $('#contrasena_receptor').val('{{$val->contrasena}}');
          $('#ip_receptor').val('{{$val->ip}}');
        }
      @endforeach
    });


    //----------------------AGREGAR-----------------------------------
    $("#add").click(function(e){
        e.preventDefault();

        //var _token = $("input[name=_token]").val();
        var idrouter = $("select[name=idrouter]").val();
        var estado = $("input[name=estado]").val();
        var tipo_acceso = $("select[name=idtipo]").val();
        var perfil_internet = $("select[name=idperfil]").val();
        var usuario_cliente = $("input[name=usuario_cliente]").val();
        var contrasena_cliente = $("input[name=contrasena_cliente]").val();
        var direccion = $("input[name=direccion]").val();
        var coordenadas = $("input[name=coordenadas]").val();
        var ip = $("input[name=ip]").val();
        var mac = $("input[name=mac]").val();
        var fecha_instalacion = $("input[name=fecha_instalacion]").val();
        var dia_pago = $("input[name=dia_pago]").val();
        var precio = $("input[name=precio]").val();
        var emisor_conectado = $("select[name=emisor_conectado]").val();
        var equipo_receptor = $("select[name=equipo_receptor]").val();
        var ip_receptor = $("input[name=ip_receptor]").val();
        var usuario_receptor = $("input[name=usuario_receptor]").val();
        var contrasena_receptor = $("input[name=contrasena_receptor]").val();
        var glosa = $("text[name=glosa]").val();


        $.ajax({
            url: "{{ url('/servicio/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/servicio/grabar') }}",
           data:{
              idrouter:idrouter, 
              estado:estado,
              tipo_acceso:tipo_acceso,
              perfil_internet:perfil_internet,
              usuario_cliente:usuario_cliente,
              contrasena_cliente:contrasena_cliente,
              direccion:direccion,
              coordenadas:coordenadas,
              ip:ip,
              mac:mac,
              fecha_instalacion:fecha_instalacion,
              dia_pago:dia_pago,
              precio:precio,
              emisor_conectado:emisor_conectado,
              equipo_receptor:equipo_receptor,
              ip_receptor:ip_receptor,
              usuario_receptor:usuario_receptor,
              contrasena_receptor:contrasena_receptor,
              glosa:glosa,
              idcliente:{{$idcliente}}
           },

           success:function(data){
              console.log('entro0000');
              console.log(data);
              
              if ( data[0] == "error") {
                console.log(data.idtipo);
                ( typeof data.idrouter != "undefined" )? $('#error1').text(data.idrouter) : null;
                ( typeof data.tipo_acceso != "undefined" )? $('#error2').text(data.tipo_acceso) : null;
                ( typeof data.perfil_internet != "undefined" )? $('#error3').text(data.perfil_internet) : null;
                ( typeof data.dia_pago != "undefined" )? $('#error4').text(data.dia_pago) : null;
                ( typeof data.precio != "undefined" )? $('#error5').text(data.precio) : null;
              } else {   

                var obj = $.parseJSON(data);

                window.location="{{ url('/cliente') }}/{{$idcliente}}"; 
               

                //alert(data.success);

              }

              
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });


     });

    //--------JPaiva--22-06-2018--------------------------------------LISTAR PERFILES---------------------------------------------------------
     $('#idtipo').change(function(e){
      var val = $("select[name=idtipo]").val();




      $("#idtipo option[value=0]").attr("selected", true);

      if ( val != '0') {
        $.ajax({
            url: "{{ url('/servicio/perfil') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/servicio/perfil') }}",
           data:{
              idtipo:val
           },

           success:function(data){
            console.log(data);
              //var obj = $.parseJSON(data); 
              $('#idperfil').empty();  
              $('#idperfil').removeAttr('disabled');
              //$('#h_dsc_perfil').removeAttr('disabled');  

              $('#idperfil').append("<option value='0' disabled selected>Seleccione perfil</option>"); 

              $.each(data, function(i, item) {
                  $('#idperfil').append("<option value='"+item.idperfil+"'>"+item.name+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });
           
      };
    });

    $('#idrouter').change(function(e){
      val = $('select[name=idrouter]').val();
      console.log(val);
      $.ajax({
            url: "{{ url('/get-TipoAcceso') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/getTipoAcceso') }}",
           data:{
              idrouter:val
           },

           success:function(data){
            console.log(data);
              $('#idtipo').empty();  
              $('#idtipo').removeAttr('disabled');

              $('#idtipo').append("<option value='0' disabled selected>Elija una opción</option>"); 

              $.each(data, function(i, item) {
                  $('#idtipo').append("<option value='"+item.dsc_corta+"'>"+item.descripcion+"</option>");
              });

           },
           error:function(){ 
              alert("error!!!!");
        }

        });


    });
   
  </script>
@endsection
