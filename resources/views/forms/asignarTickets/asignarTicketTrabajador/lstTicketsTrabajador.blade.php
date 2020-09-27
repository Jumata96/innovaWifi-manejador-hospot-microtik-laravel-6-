
@extends('layouts2.app')
@section('titulo','Asignar tickets a vendedor ')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l10 offset-l1">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>ASIGNAR TICKETS A VENDEDOR</h2>
                  </div>
                  <form  id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="add" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons blue-text text-darken-2">check</i></a>
                          <a style="margin-left: 6px"></a>
                          
                          <a class=" btn-floating waves-effect waves-light grey btn  lighten-5  modal-trigger tooltipped" href="#AsignarTickets"  data-position="top" data-tooltip="AGREGAR TICKETS" >
                            <i class="material-icons " style="color: #03a9f4">add</i>
                        </a>   
                          
                          <a href="{{url('/tickets/Asignar')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>            
                        </div> 
                        @include('forms.asignarTickets.asignarTicketTrabajador.addTicketsTrabajadorModal') 

                             
                        
                  </div>
                  
                                    
                  
                  <div class="row cuerpo"><br><br>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <div class="col col s12 m12 l12   ">
                        @foreach ($tickets_asignados as $tickets)
                        @foreach ($vendedor as $vend)
                        @foreach ($zonas as $zona)
                        <input id="idVendedor" maxlength="4" value="{{$vend->id}}"  type="hidden"   readonly="readonly" >

                              
                          
                            <div class="card white"> 
                                    <div class="card-content">
                                        <span class="card-title">Datos Generales</span> 
                                        <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">assignment</i>
                                            <input id="puntoVenta" maxlength="4" value="{{$zona->nombre}}" name="puntoVenta" type="text" data-error=".errorTxt4" readonly="readonly" >
                                            <label for="puntoVenta">Punto de Venta </label>
                                            <div class="errorTxt1" id="error1" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                          </div> 
                                          <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">assignment</i>
                                            <input id="vendedor" name="vendedor" type="text" value="{{ $vend->nombre }} {{ $vend->apellidos }}" style="text-align: center" data-error=".error2"  readonly="readonly" >
                                            <label for="vendedor"> Vendedor</label>
                                            <div class="errorTxt1" id="error2" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                        </div>
                                    </div> 
                                    
                            </div>
                            <div class="card white">
                                <div class="card-content">
                                    <div class="row cuerpo">
                                        <?php 
             
                                          $bandera = false;
             
                                          if (count($tickets_asignados_Det) > 0) {
                                             # code...
                                             $bandera = true;
                                             $i = 0;
                                          }
             
                                        ?>
             
                                     <br>
                                     <div class="row">
                                        <div class="col s12 m12 l12">
                                          
                                             <div class="card-content">
                                                Existen <?php echo ($bandera)? count($tickets_asignados_Det) : 0; ?> registros. <br><br>
                                                <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                                                      <thead>
                                                          <tr>
                                                              <th>#</th> 
                                                              <th>Perfil</th>
                                                              <th>Código Alterno</th>
                                                              <th>Precio</th>
                                                              <th>Cantidad</th>
                                                              <th>Vendidos</th>
                                                              <th>Saldo</th>

                                                              
                                                               
                                                          </tr>
                                                      </thead>
                                                      <?php
                                                             if($bandera){                                                           
                                                        ?>
                                                      <tfoot>
                                                          <tr>
                                                              <th>#</th> 
                                                              <th>Perfil</th>
                                                              <th>Código Alterno</th>
                                                              <th>Precio</th>
                                                              <th>Cantidad</th>
                                                              <th>Vendidos</th>
                                                              <th>Saldo</th>

                                                               
                                                          </tr>
                                                        </tfoot>
             
                                                      <tbody>
                                                        <tr>
                                                          <?php 
                                                                foreach ($tickets_asignados_Det as $datos) {
                                                                $i++;
                                                                $e=0;
                                                                 
                                                            ?>
                                                              <td><?php echo $i; ?></td>
                                                                <td>
                                                                @foreach ($perfiles as $perfil)
                                                                  @if ($perfil->idperfil ==$datos->idperfil)
                                                                  {{$perfil->name}}
                                                                  @endif  
                                                                @endforeach
                                                                </td>  
                                                                <td> {{$datos->codigo_alterno}} </td>
                                                                <td>{{$datos->precio}}</td> 
                                                                <td> {{ $datos->cantidad}}</td>  
                                                                <td>
                                                                  <?php  $total=0 ?>
                                                                  @foreach ($tickets_Venta as $venta)
                                                                    @if ($datos->item==$venta->id_tickets_asign)
                                                                      <?php  $total +=$venta->cantidad ?> 
                                                                    @endif   
                                                                  @endforeach
                                                                  {{$total}}
                                                                 
                                                                </td>
                                                                <td>
                                                                  {{ $datos->cantidad-$total}}
                                                                </td>

                                                              
                                                          </tr>  
            
                                                          <?php }} ?>
                                                      </tbody>
                                                  </table>
                                                </div>
                                        
                                     </div>
             
                                     </div>

                                </div>
                            </div>
                        @endforeach
                        @endforeach
                        @endforeach
                    </div>
                    
                   
                  </div>
                  </form>
              </div>
  </div>
</div>
<br><br><br>
@endsection

@section('script')
@include('forms.asignarTickets.asignarTicketTrabajador.scripts.addTicketsTrabajadorModal')
 
  
@endsection
