@extends('layouts2.app')
@section('titulo','Lista de Equipos')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>LISTA DE EQUIPOS</h2>
                  </div>
                  <div class="row card-header sub-header">
                        <div class="col s12 m12">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/equipos/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
                            <i class="material-icons" style="color: #03a9f4">add</i></a>
                          <a style="margin-left: 6px"></a>                          
                          <a class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" href="#informacion" data-position="top" data-delay="500" data-tooltip="Ver Información del Formulario">
                            <i class="material-icons">info</i></a>                                   
                        </div>  
                        @include('forms.scripts.modalInformacion')         
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($equipos) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($equipos) : 0; ?> registros. <br><br>
                          <table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th>Marca</th>
                                     <th>Modelo</th>
                                     <th>Descripción</th>
                                     <th>Modo</th>
                                     <th>IP</th>
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
                                     <th>Marca</th>
                                     <th>Modelo</th>
                                     <th>Descripción</th>
                                     <th>Modo</th>
                                     <th>IP</th>
                                     <th>Estado</th>
                                     <th>Acción</th>
                                  </tr>
                                </tfoot>

                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($equipos as $datos) {
                                      $i++;
                                   ?>
                                     <td><?php echo $i; ?></td>
                                     <td>
                                       @foreach($marca as $val)
                                        @if($val->idmarca == $datos->idmarca)
                                          {{$val->descripcion}}
                                        @endif
                                       @endforeach
                                     </td>
                                     <td>
                                       @foreach($modelo as $val)
                                        @if($val->idmodelo == $datos->idmodelo)
                                          {{$val->descripcion}}
                                        @endif
                                       @endforeach
                                     </td>
                                     <td><?php echo $datos->descripcion ?></td>
                                     <td>
                                       @foreach($modo as $val)
                                        @if($val->idmodo == $datos->idmodo)
                                          {{$val->descripcion}}
                                        @endif
                                       @endforeach
                                     </td>
                                     <td><?php echo $datos->ip ?></td>
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
                                       <a href="{{ url('/equipos/mostrar') }}/{{$datos->idequipo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i></a>                                       
                                       <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i></a>
                                       @if($datos->estado == 1)                                      
                                       <a href="#h_confirmacion2{{$datos->idequipo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
                                        <i class="material-icons" style="color: #757575 ">clear</i></a>
                                       @else
                                       <a href="#h_confirmacion3{{$datos->idequipo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
                                        <i class="material-icons" style="color: #2e7d32 ">check</i></a>
                                       @endif
                                     </td>
                                  </tr>
                                    @include('forms.equipos.scripts.alertaConfirmacion')
                                  <?php }} ?>
                               </tbody>
                            </table>
                          </div>
                    
                  </div>

                  </div>
                </div>
              </div>
          </div>
</div>

@endsection
@include('forms.scripts.toast')
