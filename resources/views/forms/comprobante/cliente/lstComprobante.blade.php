  @if(count($notificaciones) > 0)
<div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">                          
                          <a href="#addComprobante" id="compAdd" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top"  data-delay="500" data-tooltip="Crear comprobante">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          
                          <a style="margin-left: 6px"></a>   
                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario">
                            <i class="material-icons">info</i></a>
                          <a class="dropdown-button btn-floating right waves-effect waves-light grey lighten-5" href="#!" data-activates="dropdown2">
                            <i class="material-icons" style="color: #424242">vertical_align_bottom</i></a>            
                        </div>    
  
                        @include('forms.comprobante.cliente.addComprobante')        
                        @include('forms.pruebas.scripts.modalInformacion')        
                  </div>
                                    
<div class="row">
                    <?php 
                      $bandera = false;

                      if (count($comprobantes) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }
                    ?>
                  <br>
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($comprobantes) : 0; ?> registros. <br><br>
                          <table id="lstComprobante" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Documento</th>
                                     <th>F. Emisión</th>
                                     <th>F. Vencimiento</th>                      
                                     <th>SubTotal</th>
                                     <th>Impuesto</th>
                                     <th>Total</th>
                                     <th>Estado</th>
                                     <th>Fecha Pago</th>
                                     <th>Forma Pago</th>
                                     <th>Acciones</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <th>#</th>
                                     <th>Documento</th>
                                     <th>F. Emisión</th>
                                     <th>F. Vencimiento</th>                         
                                     <th>SubTotal</th>
                                     <th>Impuesto</th>
                                     <th>Total</th>
                                     <th width="150">Estado</th>
                                     <th>Fecha Pago</th>
                                     <th>Forma Pago</th>
                                     <th>Acciones</th>
                                  </tr>
                                </tfoot>

                               <tbody>
                                <?php 
                                      foreach ($comprobantes as $valor) {
                                      $i++;
                                ?>
                                <tr id="fac{{$valor->codigo}}">                                  
                                     <td><?php echo $i; ?></td>
                                     <td>{{$valor->iddocumento.' '.$valor->serie.' '.$valor->numero}}</td>
                                     <td>{{$valor->fecha_emision}}</td>
                                     <td>{{$valor->fecha_vencimiento}}</td>
                                     <td>{{$valor->subtotal}}</td>
                                     <td>{{$valor->impuesto}}</td>
                                     <td>{{$valor->total}}</td>
                                     <td>
                                       <div class="chip center-align red lighten-1 white-text" style="width: 70%">
                                          <b>NO PAGADO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                     </td>
                                     <td>-</td>
                                     <td>{{$valor->idforma_pago}}</td>
                                     <td class="center" style="width: 9rem">
                                       <a href="{{ url('/servicio/mostrar') }}/{{$valor->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>                                       
                                       <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i></a>
                                       @if($valor->idestado == 1)                                      
                                       <a href="#h_confirmacion2{{$valor->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
                                        <i class="material-icons" style="color: #757575 ">clear</i></a>
                                       @else
                                       <a href="#h_confirmacion3{{$valor->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
                                        <i class="material-icons" style="color: #2e7d32 ">check</i></a>
                                       @endif
                                     </td>
                                  </tr>
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div> <br>                   
                  </div>
              
</div> 
@else
  <h5 class="center-align" style="padding-top: 20px; padding-bottom: 20px">No Existe registro de servicio</h5>    
@endif
