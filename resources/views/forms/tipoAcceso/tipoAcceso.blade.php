@extends('layouts.app')

@section('htmlheader_title')
  Tipos de acceso
@endsection

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card-panel-2">
                  <div class="row cabecera" style="margin-left: -0.85rem; margin-right: -0.85rem">                 
                    <div class="col s12 m12 l12">
                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                      <h4 class="header2" style="margin: 10px 0px;"><b>Tipos de Acceso</b></h4>  
                    </div>
                  </div>
                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-left: -0.78rem; margin-right: -0.78rem">
                        <div class="col s12 m12 herramienta">
                          <a href="#mntTipoAcceso" class="btn-floating waves-effect waves-light grey lighten-5 modal-trigger" id="add-mostrar"><i class="mdi-content-add" style="color: #03a9f4"></i></a>
                          <a style="margin-left: 6px"></a>                          
                          <a class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" href="#modalInformacion" data-position="top" data-delay="500" data-tooltip="Ver Información del Formulario"><i class="mdi-action-info"></i></a>                                   
                        </div>  
                        @include('forms.tipoAcceso.mntTipoAcceso')   
                        @include('forms.tipoAcceso.updTipoAcceso') 
                        @include('forms.scripts.modalInformacion')         
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($tipo) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($tipo) : 0; ?> registros. <br><br>
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Código</th>
                                     <th>Descripción</th>
                                     <th>Estado</th>
                                     <th>Fecha Creación</th>
                                     <th>Acción</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <th>#</th>
                                     <th>Código</th>
                                     <th>Descripción</th>
                                     <th>Estado</th>
                                     <th>Fecha Creación</th>
                                     <th>Acción</th>
                                  </tr>
                                </tfoot>

                               <tbody>                                
                                  <?php 
                                      foreach ($tipo as $datos) {
                                      $i++;
                                   ?>
                                  <tr id="tr{{$datos->idtipo}}" class="{{$datos->idtipo}}">
                                     <td><?php echo $i; ?></td>
                                     <td><?php echo $datos->idtipo ?></td>
                                     <td><?php echo $datos->descripcion ?></td>
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
                                     <td><?php echo $datos->fecha_creacion ?></td>
                                     <td class="center">
                                       <a href="#updTipoAcceso" id="upd-mostrar" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger actualizar" data-position="top" data-delay="500" data-tooltip="Ver/Actualizar"><i class="mdi-action-visibility" style="color: #7986cb" data-id="{{$datos->idtipo}}" data-descripcion="{{$datos->descripcion}}" data-dsc="{{$datos->dsc_corta}}" data-glosa="{{$datos->glosa}}" data-estado="{{$datos->estado}}" id="upd{{$datos->idtipo}}"></i></a>                                       
                                       <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar"><i class="mdi-content-remove" style="color: #dd2c00"></i></a>
                                     </td>
                                  </tr>
                                    @include('forms.tipoAcceso.scripts.alertaConfirmacion')
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

@include('forms.scripts.toast')
