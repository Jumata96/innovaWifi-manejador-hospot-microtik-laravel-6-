@extends('layouts2.app')
@section('titulo','Lista Tickets')

@section('main-content')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>LISTA DE TICKETS</h2>
                  </div>
                  <div class="card-header sub-header">
                         
                        @include('forms.scripts.modalInformacion')         
                  </div>
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($ticketsVendidosTicket) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($ticketsVendidosTicket) : 0; ?> registros. <br><br>
                          <table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Descripción</th>
                                    <th>Perfil</th>
                                    <th>Codigo Venta</th>
                                    <th>Cantidad</th> 
                                    <th>Fecha creación</th>
                                    <th>Estado</th> 
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <th>#</th>
                                     <th>Descripción</th>
                                     <th>Perfil</th>
                                     <th>Codigo Venta</th>
                                     <th>Cantidad</th> 
                                     <th>Fecha creación</th>
                                     <th>Estado</th> 
                                  </tr>
                                </tfoot>
                                <?php 
                                  foreach ($ticketsVendidosTicket as $datos) {
                                    $i++;
                                ?>
                               <tbody>
                                <tr  >                                  
                                     <td><?php echo $i; ?></td>
                                     <td> {{$datos->detalle}}</td>
                                     <td> 
                                        @foreach ($perfiles as $item)
                                          @if ($item->idperfil==$datos->idperfil)
                                            {{$item->name}}
                                              
                                          @endif
                                            
                                        @endforeach
                                    </td>
                                     <td> {{$datos->ticket}} </td>
                                     <td> {{$datos->cantidad}} </td>
                                     <td> {{$datos->fecha_creacion}} </td>

                                     <td style="width: 12rem">
                                        
                                        <div id="estado2" class="chip center-align teal accent-4 white-text" style="width: 70%">
                                          <b>VENDIDO</b>
                                          <i class="material-icons"></i>
                                        </div> 
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
</div>

@endsection 

