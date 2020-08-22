<div class="row cuerpo">
<br>

@if(count($notificaciones) > 0)
@foreach($notificaciones as $val)
  
  <div class="col s12 m7 l5 offset-l3 offset-m2">
    <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>TIPOS DE ACIONES</h2>
                  </div>
                
                <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i></a>
                          <a style="margin-left: 6px"></a>                          
                          <a class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" href="#informacion" data-position="top" data-delay="500" data-tooltip="Ver Información del Formulario">
                            <i class="material-icons">info</i></a>
                          <a href="{{url('/router')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #546e7a">keyboard_tab</i></a>
                        </div> 
                        @include('forms.scripts.modalInformacion')   
                  </div>
                  
                  <form method="POST" enctype="multipart/form-data" class="grey lighten-5">
                    <div class="row cuerpo-2">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">       
                    <input type="hidden" name="codigo" value="{{ $val->codigo }}">  
                    @foreach($servicio as $serv)
                      <input type="hidden" name="dia_pago" value="{{ $serv->dia_pago }}">                      
                    @endforeach                    
                                          
                      <div class="card white">
                          <div class="card-content" style="padding-top: 0px">
                            <div class="row" style="padding-top: 10px">
                              <div class="col s6 m5 l5">
                                <p style="padding-top: 15px" class="right-align">
                                  <i class="material-icons">credit_card</i>  
                                  Iniciar Aviso</p>
                              </div>

                              <div class="col s12 m7 l7">
                                <select class="browser-default" id="aviso" name="aviso"> 
                                  @if($val->aviso == 0)
                                    <option value="0" selected="">Desabilitado</option>
                                  @else
                                    <option value="0">Desabilitado</option>
                                  @endif
                                  @if($val->aviso == 1)
                                    <option value="1" selected="">1 día antes</option>
                                  @else
                                    <option value="1">1 día antes</option>
                                  @endif                                 
                                  
                                  @for($i=2;$i<7;$i++)
                                    @if($val->aviso == $i)
                                      <option value="{{$i}}" selected="">{{$i}} días antes</option>
                                    @else
                                      <option value="{{$i}}">{{$i}} días antes</option>
                                    @endif
                                  @endfor
                                </select>
                                <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>
                            </div>
                          </div>                                                                   
                      </div>
                      <div class="card white">
                          <div class="card-content" style="padding-top: 0px">
                            <div class="row" style="padding-top: 10px">
                              <div class="col s6 m5 l5">
                                <p class="right-align" style="padding-top: 15px">
                                  <i class="material-icons">credit_card</i>  
                                  Aplicar Corte</p>
                              </div>

                              <div class="col s12 m7 l7">
                                <select class="browser-default" id="corte" name="corte"> 
                                  @if($val->corte == 0)
                                    <option value="0" selected="">Desabilitado</option>
                                  @else
                                    <option value="0">Desabilitado</option>
                                  @endif
                                  @if($val->corte == 1)
                                    <option value="1" selected="">1 día antes</option>
                                  @else
                                    <option value="1">1 día despues</option>
                                  @endif                                 
                                  
                                  @for($i=2;$i<7;$i++)
                                    @if($val->corte == $i)
                                      <option value="{{$i}}" selected="">{{$i}} días despues</option>
                                    @else
                                      <option value="{{$i}}">{{$i}} días despues</option>
                                    @endif
                                  @endfor
                                </select>
                                <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>
                            </div>
                          </div>                                                                   
                      </div>
                      <div class="card white">
                          <div class="card-content" style="padding-top: 0px">
                            <div class="row" style="padding-top: 10px">
                              <div class="col s6 m5 l5">
                                <p style="padding-top: 15px" class="right-align">
                                  <i class="material-icons">credit_card</i>  
                                  Frecuencia de corte</p>
                              </div>

                              <div class="col s12 m7 l7">
                                <select class="browser-default" id="frecuencia" name="frecuencia"> 
                                  @if($val->frecuencia == 0)
                                    <option value="0" selected="">Desabilitado</option>
                                  @else
                                    <option value="0">Desabilitado</option>
                                  @endif
                                  @if($val->frecuencia == 1)
                                    <option value="1" selected="">mensual</option>
                                  @else
                                    <option value="1">mensual</option>
                                  @endif                                 
                                  
                                  @for($i=2;$i<7;$i++)
                                    @if($val->frecuencia == $i)
                                      <option value="{{$i}}" selected="">{{$i}} meses</option>
                                    @else
                                      <option value="{{$i}}">{{$i}} meses</option>
                                    @endif
                                  @endfor
                                </select>
                                <div class="errorTxt1" id="h_error1" style="color: red; font-size: 12px; font-style: italic;"></div>
                              </div>
                            </div>
                          </div>                                                                   
                      </div>
                    </div>   
                  </form> 
    </div>
  </div> 
@endforeach
@else
  <h5 class="center-align">No Existe registro de servicio</h5>    
@endif
</div>


@section('script')
  
  @include('forms.comprobante.cliente.scripts.comprobante')
  @include('forms.comprobante.cliente.scripts.addComprobante')

 <script type="text/javascript">
  //---JPaiva--12-07-2018---------------VARIOS DATATABLE--------------------
    $(document).ready(function() {
    $('table.display').DataTable();
  } );
  </script>

<script type="text/javascript">
    //---JPaiva-04-06-2018----------------ACTUALIZAR-----------------------------
    $('#update').click(function(e){
      e.preventDefault();   
      console.log($("input[name=dia_pago]").val());  

      $.ajax({
            url: "{{ url('/notificaciones/actualizar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/notificaciones/actualizar') }}",
           data:{
              codigo:$("input[name=codigo]").val(), 
              aviso:$("select[name=aviso]").val(),
              corte:$("select[name=corte]").val(),
              frecuencia:$("select[name=frecuencia]").val(),
              dia_pago:$("input[name=dia_pago]").val()
           },

           success:function(data){
             
              setTimeout(function() {
                  Materialize.toast('<span>Registro actualizado</span>', 1500);
                }, 100);  

           },
           error:function(){ 
              alert("error!!!!");
        }
        });


    });    

   
</script>
@endsection



<br><br>