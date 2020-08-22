@extends('layouts2.app')
@section('titulo','Lista de conexiones')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>USUARIOS EN LINEA - HOTSPOT</h2>
                  </div>
                 
                  <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
                        <div class="col s12 m12">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/hotspot/conexiones') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
                            <i class="material-icons" style="color: #03a9f4">add</i>
                          </a>
                          <a style="margin-left: 6px"></a>                          
                                                    
                        </div>  
                        
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($collection) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($collection) : 0; ?> registros. <br><br>
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th class="center">Avatar</th>
                                     <th>Usuario</th>
                                     <th>Dirección IP</th>
                                     <th>Dirección MAC</th>
                                     <th>Tiempo</th>
                                     <th>Descarga</th>
                                     <th>Subida</th>
                                     <th>Acción</th>
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <th>#</th>
                                     <th>Avatar</th>
                                     <th>Usuario</th>
                                     <th>Dirección IP</th>
                                     <th>Dirección MAC</th>
                                     <th>Tiempo</th>
                                     <th>Descarga</th>
                                     <th>Subida</th>
                                     <th>Acción</th>
                                  </tr>
                                </tfoot>

                               <tbody>
                                <tr>
                                  <?php 
                                      for ($i=0; $i < count($collection); $i++) { 
                                      
                                        //dd($collection[strval(4)]['user']);                                      
                                   ?>
                                     <td><?php echo $i; ?></td>
                                     <td class="center">
                                       <img src="{{asset('images/usu-perfil.png')}}" alt="" class="circle responsive-img valign profile-image teal lighten-5" style="height: 50px; width: 50px">
                                     </td>
                                     <td><?php echo $collection[strval($i)]['user'] ?></td>
                                     <td><?php echo $collection[strval($i)]['address'] ?></td>
                                     <td><?php echo $collection[strval($i)]['mac-address'] ?></td>
                                     <td><?php echo $collection[strval($i)]['uptime'] ?></td>
                                     <td><?php echo $collection[strval($i)]['bytes-out'] ?></td>
                                     <td><?php echo $collection[strval($i)]['bytes-in'] ?></td>

                                     <td class="center" style="width: 9rem">
                                       <a href="{{ url('/empresa/mostrar') }}/" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i>
                                      </a>                                       
                                       <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desconectar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i>
                                      </a>
                                      @if(1 == 1)                                      
                                       <a href="#h_confirmacion2" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
                                        <i class="material-icons" style="color: #757575 ">clear</i></a>
                                       @else
                                       <a href="#h_confirmacion3" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
                                        <i class="material-icons" style="color: #2e7d32 ">check</i></a>
                                       @endif
                                     </td>
                                  </tr>

                                  @include('forms.conexiones.scripts.alertaConfirmacion')  
                                    
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

