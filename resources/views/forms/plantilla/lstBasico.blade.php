@extends('forms.router.router')
@section('content-router')
  
@include('API.router')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card-panel-2">
                  <div class="row cabecera" style="margin-left: -0.85rem; margin-right: -0.85rem">                 
                    <div class="col s12 m12 l12">
                      <i class="mdi-av-my-library-books left" style="font-size: 27px"></i>
                      <h4 class="header2" style="margin: 10px 0px;"><b>Registrar Router Mikrotik</b></h4>  
                    </div>
                  </div>
                  <div class="row grey lighten-3" style="height: 52px; padding-top: 7px; margin-left: -0.78rem; margin-right: -0.78rem">
                        <div class="col s12 m12 herramienta">
                          <a class="btn-floating waves-effect waves-light grey lighten-5" href="{{ url('/nuevo-router') }}"><i class="mdi-content-add" style="color: #03a9f4"></i></a>
                          <a class="btn-floating waves-effect waves-light grey lighten-5"><i class="mdi-navigation-check" style="color: #2E7D32"></i></a>
                          <a class="btn-floating waves-effect waves-light  grey lighten-5"><i class="mdi-image-edit" style="color: #0277bd"></i></a>
                          <a class="btn-floating waves-effect waves-light grey lighten-5"><i class="mdi-content-remove" style="color: #dd2c00"></i></a>
                          <a style="margin-left: 6px"></a>   
                          <a class="btn-floating waves-effect waves-light light-blue lighten-1"><i class="mdi-action-info"></i></a>
                          <a class="dropdown-button btn-floating right waves-effect waves-light grey lighten-5" href="#!" data-activates="dropdown2"><i class="mdi-editor-vertical-align-bottom" style="color: #424242"></i></a>            
                        </div>           
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 

                      if (count($router) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($router) : 0; ?> registros. <br><br>
                          <table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Alias</th>
                                     <th>Ip</th>
                                     <th>Ususario</th>
                                     <th>Estado</th>
                                     <th>Fecha Creación</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <th>#</th>
                                     <th>Alias</th>
                                     <th>Ip</th>
                                     <th>Ususario</th>
                                     <th>Estado</th>
                                     <th>Fecha Creación</th>
                                  </tr>
                                </tfoot>

                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($router as $valor) {
                                      $i++;
                                   ?>
                                     <td><?php echo $i; ?></td>
                                     <td><?php echo $valor->alias ?></td>
                                     <td><?php echo $valor->ip ?></td>
                                     <td><?php echo $valor->usuario ?></td>
                                     <td>
                                        @if($valor->activo == 0)
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
                                     <td><?php echo $valor->fecha_creacion ?></td>
                                  </tr>
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