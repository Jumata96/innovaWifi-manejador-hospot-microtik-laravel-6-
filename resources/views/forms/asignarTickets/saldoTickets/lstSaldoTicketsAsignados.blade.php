@extends('layouts2.app')
@section('titulo','Lista Tickets')

@section('main-content')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>LISTA DE TICKETS VENDIDOS</h2>
                  </div>
                  <div class="card-header sub-header">
                        <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('zonas/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Seleccionar Vendedor">
                          <i class="material-icons" style="color: #03a9f4">add</i>
                        </a>
                        <a style="margin-left: 6px"></a>  
                       
                        @include('forms.scripts.modalInformacion')         
                  </div>
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($ARRAY) > 0) {
                        # code...
                        $bandera = true;
                        $i = 0;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($ARRAY) : 0; ?> registros. <br><br>
                          <table id={{ ($bandera)? "data-table-simple" : "" }} class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                    <th>#</th> 
                                  </tr>
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?>
                               <tfoot>
                                  <tr>
                                     <th>#</th> 
                                  </tr>
                                </tfoot>
                                <?php 
                                  foreach ($ARRAY as $datos) {
                                    $i++;
                                ?>
                               <tbody>
                                <tr  >                                  
                                     <td><?php echo $i; ?></td> 
                                      
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

