             
<div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          <a href="#addPPPoE" id="p_agregar" class="btn-floating waves-effect waves-light grey lighten-5 modal-trigger">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          
                          <a class="dropdown-button btn-floating right waves-effect waves-light grey lighten-5" href="#!" data-activates="dropdown2">
                            <i class="material-icons" style="color: #424242">vertical_align_bottom</i></a>            
                        </div>    

                        @include('forms.perfiles.addPPPoE')     
                        @include('forms.perfiles.updPPPoE')   
                        @include('forms.pruebas.scripts.modalInformacion')       
                              
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 
                      $bandera = false;

                      if (count($pppoe) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }
                    ?>
                  <br>
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($pppoe) : 0; ?> registros. <br><br>
                          <table id="tablePPPoE" class="responsive-table display tabla" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Router</th>
                                     <th>Desc. Perfil</th>
                                     <th>Precio</th>
                                     <th>Target</th>                         
                                     <th class="center">Estado</th>
                                     <th class="center">Acciones</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <tr>
                                     <th>#</th>
                                     <th>Router</th>
                                     <th>Desc. Perfil</th>
                                     <th>Precio</th>
                                     <th>Target</th>                         
                                     <th>Estado</th>
                                     <th>Acciones</th>
                                  </tr>
                                  </tr>
                                </tfoot>

                               <tbody>
                                <?php 
                                      foreach ($pppoe as $valor) {
                                      $i++;
                                   ?>
                                <tr id="ptr{{$valor->idperfil}}">
                                  
                                     <td><?php echo $i; ?></td>
                                     <td>
                                      @foreach($router as $rou) 
                                        @if($rou->idrouter == $valor->idrouter)
                                          {{$rou->alias}}
                                        @endif
                                      @endforeach    
                                     </td>
                                     <td><?php echo $valor->name ?></td>
                                     <td><?php echo $valor->precio ?></td>
                                     <td><?php echo $valor->rate_limit ?></td>
                                     <td class="center">
                                        @if($valor->estado == 0)
                                        <div class="chip center-align" style="width: 70%">
                                            <b>NO DISPONIBLE</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @else
                                        <div class="chip center-align teal accent-4 white-text" style="width: 70%">
                                          <b>ACTIVO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                     </td>
                                     <td class="center" style="width: 9rem">
                                       <a href="#updPPPoE" id="updPPPoE{{$valor->idperfil}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver" data-id="{{$valor->idperfil}}" data-idrouter="{{$valor->idrouter}}" data-name="{{$valor->name}}" data-vbajada="{{$valor->vbajada}}" data-precio="{{$valor->precio}}" data-vsubida="{{$valor->vsubida}}" data-glosa="{{$valor->glosa}}" data-idrouter="{{$valor->idrouter}}" data-estado="{{$valor->estado}}" data-dsc_perfil="{{$valor->dsc_perfil}}" data-perfil="{{$valor->perfil_pppoe}}" data-remote_address="{{$valor->remote_address}}" data-local_address="{{$valor->local_address}}">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>                                       
                                       <a href="#p_confirmacion{{$valor->idperfil}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i></a> 
                                       @if($valor->estado == 1)                                      
                                       <a href="#p_confirmacion2{{$valor->idperfil}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
                                        <i class="material-icons" style="color: #757575 ">clear</i></a>
                                       @else
                                       <a href="#p_confirmacion3{{$valor->idperfil}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
                                        <i class="material-icons" style="color: #2e7d32 ">check</i></a>
                                       @endif
                                     </td>
                                  </tr>
                                    @include('forms.perfiles.scripts.pppoe.alertaConfirmacion')
                                    @include('forms.perfiles.scripts.pppoe.alertaConfirmacion2')
                                    @include('forms.perfiles.scripts.pppoe.alertaConfirmacion3')
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div> <br>                   
                  </div>

                </div>


