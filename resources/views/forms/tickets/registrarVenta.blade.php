@extends('layouts2.app')
@section('titulo','Registro de ventas')

@section('main-content')
<br>
<div class="row">
    <div class="col s12 m12 l12">
      <div class="col s12 m6 l4">
        <div class="card light-blue lighten-2 gradient-shadow min-height-100 white-text">
              <div class="padding-4">
                <div class="col s7 m8">
                  <i class="material-icons background-round mt-6">note</i>
                  <p>Asignados</p>
                </div>
                <div class="col s5 m4 right-align">
                <h4 class="mb-0" style="color: white">{{$asignado}}</h4>
                <p class="no-margin">Tickets</p>
                  <p></p>
                </div>
              </div>
          </div>
      </div>
      <div class="col s12 m6 l4">
        <div class="card green lighten-2 gradient-shadow min-height-100 white-text">
              <div class="padding-4">
                <div class="col s7 m8">
                  <i class="material-icons background-round mt-5">assignment_turned_in</i>
                  <p>Asignados</p>
                </div>
                <div class="col s5 m4 right-align">
                  <h4 class="mb-0" style="color: white">{{count($tickets_asignados)}}</h4>
                  <p class="no-margin">Perfiles</p>
                  <p></p>
                </div>
              </div>
          </div>
      </div>
      <div class="col s12 m6 l4">
        <div class="card red lighten-2 gradient-shadow min-height-100 white-text">
              <div class="padding-4">
                <div class="col s7 m8">
                  <i class="material-icons background-round mt-5">assignment
                  </i>
                  <p >Saldo</p>
                </div>
                <div class="col s5 m4 right-align">
                  <h4 class="mb-0" style="color: white"> 
                    {{$vendidos}}
                </h4> 
                  <p class="no-margin">Tickets</p>
                  <p></p>
                </div>
              </div>
          </div>
      </div> 
    </div>
    <div class="col s12 m12 l4">
    <div class="card white">
        <div class="card-content">
            <span class="card-title">Registrar Ventas</span>

            {{-- <div class="row"> --}}
              <div class="col s12 m6 l12"   >
                <div>
                  <label for="tipoTicket">Tipo de tickets</label>                 
                  <select class="browser-default" id="tipoTicket" name="tipoTicket" required>
                    <option value="" disabled selected="">Seleccione</option> 
                    @foreach($tickets_asignados as $val)
                    @foreach ($perfiles as $per)
                    @if ($per->idperfil==$val->idperfil)
                    <option value="{{$val->idperfil_det}}"> {{$per->name}}</option>
                    @endif 
                    @endforeach 
                    @endforeach
                  </select> 
                <div class="errorTxt1" id="errorModal1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                </div>
            {{-- </div> --}}
                <div class="input-field col s12 m6 l12">
                  {{-- <i class="material-icons prefix">cantidad</i> --}}
                  <input id="total" name="total" style="text-align: center;" type="number"  readonly="readonly" >
                  <label for="total">Disponibles</label>
                  <div class="errorTxt1" id="errorModal5" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div> 
                </div> 
                <div class="input-field col s12 m6 l12">
                    {{-- <i class="material-icons prefix">cantidad</i> --}}
                    <input id="cantidad" style="text-align: center;" name="cantidad" type="number"  readonly="readonly" >
                    <label for="cantidad">cantidad</label>
                    <div class="errorTxt1" id="errorModal2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>

                </div> 
                <div class=" input-field col s12">                    
                    <input id="precio"  style="text-align: center;" name="precio" type="number" value="" data-error=".errorTxt2"   >  
                    <label for="precio">Precio</label> 
                    <div class="errorTxt1" id="errorModal4" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>                                                                                            
                </div>
                <input id="idTicketAsignadoDet" name="idTicketAsignadoDet" type="hidden" value=""  > 
                <input id="idPerfil" name="idPerfil" type="hidden" value=""  >  
                <div class=" input-field col s12">                    
                    <input id="codigo" name="codigo" style="text-align: center;" type="text" value="" data-error=".errorTxt2" maxlength="100" style="font-size: 30px;color:#4db6ac" placeholder="" >  
                    <label for="codigo">Codigo</label> 
                    <div class="errorTxt1" id="errorModal3" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>                                                                                            
                </div> <br> 
                <div class="col s12">
                  <a id="add" class="btn waves-effect waves-light gradient-45deg-indigo-purple col s12" style="height: 44px; letter-spacing: .5px; padding-top: 0.3rem">
                      <b>REGISTRAR VENTA</b>
                      <i class="mdi-content-send right"></i>
                  </a><br><br><br>

                </div>
            </div>

        </div>
        </div>
        @include('forms.tickets.modalConfirmar')   
    </div>

    <div class="col s12 m12 l8">
    <div class="card white">
    <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($tickets) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>
    <div class="card-content">
                          Existen <?php echo ($bandera)? count($tickets) : 0; ?> registros. <br><br>
                          <table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display centered" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Código</th>
                                     <th>Perfil</th>
                                     <th>Precio</th>
                                     <th  >Cantidad</th>
                                     <th>Fecha Registro</th>
                                     <th>Estado</th>
                                     <th>Acción</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               

                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($tickets as $datos) {
                                      $i++;
                                   ?>
                                     <td>{{ $i }}</td>
                                     <td>{{ $datos->ticket }}</td>
                                     <td>
                                     @foreach ($perfiles as $item)
                                     @if ($item->idperfil== $datos->idperfil)
                                     {{ $item->name }}
                                     @php
                                          $nombre="";
                                         $nombre = $item->name ;
                                          
                                     @endphp
                                     @endif
                                     
                                         
                                     @endforeach
                                     </td>
                                     <td>{{ $datos->precio }}</td>
                                     <td >{{$datos->cantidad}}</td>

                                     <td>{{ $datos->fecha_creacion }}</td>
                                     <td>
                                        @if($datos->estado == 0)
                                        <div id="u_estado" class="chip center-align" style="width: 70%">
                                            <b>NO DISPONIBLE</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @else
                                        <div id="u_estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                          <b>ACTIVO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                     </td>
                                     <td class="center" style="width: 9rem">
                                       <a href="#" class="modalUpdate btn-floating waves-effect waves-light grey lighten-5 tooltipped" 
                                        data-Id="{{$datos->codigo}}" 
                                        data-idperfil="{{$datos->idperfil}}"
                                        data-nombre="{{$nombre}}"  
                                        data-precio="{{ $datos->precio }}"
                                        data-cantidad="{{$datos->cantidad}}"
                                        data-codigo="{{ $datos->ticket }}"

                                        
                                        data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i>
                                      </a>                                     
                                     <a href="#confirmacion{{$i}}" class="ModalEliminar btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-IdEliminar="{{$datos->codigo}}"  data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i>
                                      </a> 
                                     </td>
                                  </tr>
											            @include('forms.tickets.scripts.alertaConfirmacion')

                                   
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div>
                    
                  </div>
         
    </div>
    </div>
    </div> 
</div>

@endsection

@section('script')
  @include('forms.tickets.scripts.modalUpdateVentaForm') 
  @include('forms.tickets.scripts.registrarVenta')
  @include('forms.tickets.scripts.modalUpdateVenta') 

  
@endsection

