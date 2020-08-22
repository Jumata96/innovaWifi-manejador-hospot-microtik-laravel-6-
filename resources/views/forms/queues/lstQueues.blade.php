<br>
<?php 

                      $bandera = false;

                      if (count($queues) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>
<div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($queues) : 0; ?> registros. <br><br>
                          <table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Router</th>
                                     <th>Nombre</th>
                                     <th>Velocidad max. subida</th>
                                     <th>Velocidad max. bajada</th>
                                     <th>Estado</th>
                                     <th>Acción</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <th>#</th>
                                     <th>Router</th>
                                     <th>Nombre</th>
                                     <th>Velocidad max. subida</th>
                                     <th>Velocidad max. bajada</th>
                                     <th>Estado</th>
                                     <th>Acción</th>
                                  </tr>
                                </tfoot>

                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($queues as $queue) {
                                      $i++;
                                   ?>
                                     <td>{{$i}}</td>
                                     <td>{{$queue->idrouter}}</td>
                                     <td>{{$queue->nombre}}</td>
                                     <td>{{$queue->vsubida}}</td>
                                     <td>{{$queue->vbajada}}</td>
                                     <td>{{$queue->estado}}</td>
                                     <td class="center">
                                       <a href="{{ url('/queues/mostrar') }}/{{$queue->idqueues}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver"><i class="mdi-action-visibility" style="color: #7986cb "></i></a>                                       
                                       <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar"><i class="mdi-content-remove" style="color: #dd2c00"></i></a>
                                     </td>
                                  </tr>
                                    @include('forms.queues.scripts.alertaConfirmacion')
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div>
                    <br><br><br>
                  </div>

                  </div>
                </div>