@extends('layouts2.app')
@section('titulo','Reporte de pagos') 
@section('main-content')
<div style="margin-top: 8px"></div>
<div class="row"> 

<form id="frmReport" action="{{url('/tickets/reporte-venta-Filtro')}}" method="POST" >
  
  <div class="col s12 m12 l12">
                <?php 
                      $bandera = false;

                      if (count($Ventas) > 0) {
                        $bandera = true; 
                        $i = 0;
                      }
                ?>
                  
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                   @include('forms.reportes.reporteVentas.modalFiltroVendedor')
                    <input type="hidden" id="contadorVendedores" name="contadorVendedores" value="0">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2><b>REPORTE DE VENTAS |</b> <i style="color: #3f51b5">Existen <?php echo ($bandera)? count($Ventas) : 0; ?> registros.</i></h2>
                  </div> 
                  
                  <div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                        <button type="submit" id="filtrarVendedores" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Buscar"> 
                            <i class="material-icons" style="color: #03a9f4">search</i></button> 


                          <a id="exportReportPdf"  class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Descargar PDF">
                            <i class="material-icons" style="color: black">vertical_align_bottom</i></a>
                            

                          <a id="exportReport" onclick="tableToExcel('data-table-simple', 'Reporte de venta')"  class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Descargar excel">
                            <i class="material-icons" style="color: black">vertical_align_bottom</i></a>
                        </div>   
                  </div>               
                  <div class="row cuerpo">  
                  <div class="row">
                    <div class="col s12">
                      <br>
                      
                        <div class="row">  
                          <div class="input-field col l6" >  

                                  <input type="text" id="autocompletarZonas" class="form-control" onfocus="this.value = '';" placeholder="Buscar Punto de Venta">  
                                  <input type="hidden" id="PuntoVentaFiltrado" name="PuntoVentaFiltrado" >
                                </div> 
                                <div class="input-field col l6" id="divVendedor"  > 
                                        <input type="text" id="idLocalNames" href="#modalAddVendedores" rel="modal:open"  readonly="readonly" class="form-control modal-trigger " onfocus="this.value = '';" placeholder="Buscar al Vendedor">  
                                  <input type="hidden" id="trabajadorFiltrado" name="trabajadorFiltrado" >
                                </div> 
                                
                                <div class="input-field col s12 m6 l3  ">
                                    <i class="material-icons  prefix">event</i>
                                  <input class="datepicker picker1" id="from"   name="from" type="text" required>
                                    <label for="from">Fecha inicio</label>
                                    <div id="error10" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div>
                                </div> 
                                <div class="input-field col s12 m6 l3"> 
                                      <i class="material-icons  prefix">event</i>
                                      <input  id="to"  class="datepicker picker2"   name="to" type="text" required>
                                      <label for="to">Fecha fin</label>
                                      <div id="error20" style="padding-left: 3rem; color: red; font-size: 12px; font-style: italic;"></div> 
                                </div> 
                              {{--   <div class="input-field col s12 m6 l2 offset-l1">
                                  <div class="switch center"> 
                                      <label>
                                        on
                                        <input type="checkbox">
                                        <span class="lever"></span>
                                        off
                                      </label>  
                                    </div>
                                  
                                </div> 
                                <div class="input-field col s12 m6 l3"> 
                                   <blockquote style="margin: 0px;width: 20em;"> 
                                    <div>
                                   Al activar se pintara  la cabecera de la tabla, la cual se vera reflejada al momento de la exportación de los reportes.  
                                    </div> 
                                  </blockquote>  
                                </div>  --}}
                                
                      
                    </div>
                       
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content" style="overflow-x:scroll">
                          
                          <table id="data-table-simple" class="responsive-table centered Highlight  tablaFiltro" cellspacing="10" style="white-space: nowrap;">
                               <thead>

                                @foreach($parametros as $Param)
                                    @if($Param->parametro == 'ADD_CABECERA' and $Param->valor == 'SI')
                                     <tr style="background-color: steelblue;color: white">
                                      <th>#</th>
                                      <th>Vendedor</th>
                                      <th>Cod.Alterno</th>
                                      <th >Punto de Venta</th>
                                      <th>Paquete</th> 
                                      <th>Plan</th> 
                                      <th>Precio</th> 
                                      <th>Total Asignados </th>
                                        <th>Total Asignados Monto</th>
                                      <th>Saldo Total</th>
                                      <th>Saldo Total Monto</th>
                                      <th >Total Vendidos</th> 
                                      <th >Total Vendidos Monto</th> 
                                      <th >Cantidad Venta</th> 
                                      <th>Subtotal</th>
                                      <th >Fecha de venta</th>
                                      <th  >Estado</th> 
                                  </tr>
                                      
                                    @elseif($Param->parametro == 'ADD_CABECERA' and $Param->valor == 'NO')
                                     <tr>
                                     <th >#</th>
                                     <th>Vendedor</th>
                                     <th>Cod.Alterno</th>
                                     <th >Punto de Venta</th>
                                     <th>Paquete</th> 
                                     <th>Plan</th> 
                                     <th>Precio</th> 
                                     <th>Total Asignados </th>
                                      <th>Total Asignados Monto</th>
                                     <th>Saldo Total</th>
                                     <th>Saldo Total Monto</th>
                                     <th >Total Vendidos</th> 
                                     <th >Total Vendidos Monto</th> 
                                     <th >Cantidad Venta</th> 
                                     <th>Subtotal</th>
                                     <th >Fecha de venta</th>
                                     <th  >Estado</th> 
                                  </tr>

                                    @endif
                                    
                                @endforeach
                                 
                               </thead>
                               <?php
                                    if($bandera){                                                           
                                ?> 
                               <tbody>
                                <tr>
                                  <?php 
                                      foreach ($ArrayDatosFiltrados as $datos) {
                                      $i++;
                                   ?>
                                    <td class="idTabla">{{$i}}</td>

                                   @if ($datos['estadoTicket']==0)
                                     <td style="background-color:#FC4D67;" class=" usuarioTabla">  {{ $datos['Vendedor'] }} </td>
                                     <td style="background-color:#FC4D67;" class=" Cod_Alterno">{{ $datos['Cod_Alterno'] }}</td>
                                     <td style="background-color:#FC4D67;" class="  zonaTabla">{{ $datos['Punto_de_Venta']}}</td>                                     
                                     <td style="background-color:#FC4D67;" class=" Ticket"> {{ $datos['Ticket'] }} </td> 
                                     <td style="background-color:#FC4D67;" class=" perfilTabla"> {{ $datos['Plan'] }}</td>
                                     <td style="background-color:#FC4D67;" class=" precioTabla">{{ $datos['Precio'] }} </td>  
                                   @else
                                     <td  class="usuarioTabla">  {{ $datos['Vendedor'] }} </td>
                                     <td class="Cod_Alterno">{{ $datos['Cod_Alterno'] }}</td>
                                     <td class=" zonaTabla">{{ $datos['Punto_de_Venta']}}</td>                                     
                                     <td class="Ticket"> {{ $datos['Ticket'] }} </td> 
                                     <td class="perfilTabla"> {{ $datos['Plan'] }}</td>
                                     <td class="precioTabla">{{ $datos['Precio'] }} </td>  
                                   @endif

                                   
                                     <td class="Total_Asignados lime lighten-3"> {{ $datos['Total_Asignados'] }} </td> 
                                     <td class="Total_AsignadosMonto lime lighten-3"> {{ $datos['Total_AsignadosMonto'] }} </td>
                                     <td class="Saldo_Total lime lighten-2"> {{ $datos['Saldo_Total'] }} </td> 
                                     <td class="Saldo_TotalMonto lime lighten-2"> {{ $datos['Saldo_TotalMonto'] }}</td>
                                     <td class="Total_Vendidos lime lighten-3"> {{ $datos['Total_Vendidos'] }}</td> 
                                     <td class="Total_VendidosMonto lime lighten-3">   {{ $datos['Total_VendidosMonto'] }} </td> 
                                     <td class=" cantidadTabla  light-blue lighten-3">{{ $datos['Cantidad_Venta'] }}</td>
                                     <td class=" subtotalTabla  light-blue lighten-3 "> {{ $datos['Subtotal'] }} </td> 
                                     <td class=" fechaTabla">{{ date("Y-m-d", strtotime($datos['Fecha_de_venta']))}} </td>
                                      
                                     
                                    <td class="center estadoTable">
                                      @if($datos['Estado'] == '0')
                                        <span  value="ANULADO" class="badge grey darken-2 white-text text-accent-5">ANULADO</span>
                                      @elseIF($datos['Estado'] == '1')
                                        <span value="VENDIDO" class="badge green lighten-5 green-text text-accent-4">VENDIDO</span>                                        
                                      @endif
                                    </td> 
                                  </tr>
                                    
                                  <?php }} ?>
                               </tbody>
                               
                               <tfoot>
                                  <tr> 
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th class="center">{{-- TOTAL ASIGNADO: --}}</th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th class="center  light-blue lighten-5">TOTAL:</th>
                                     <th id="total"class="total  light-blue lighten-5" >{{number_format($total,2)}}</th>
                                     
                                     <th></th>
                                     <th></th>
                                     <th class="center hide"></th>
                                  </tr>
                                </tfoot>
                            </table>
                          </div>
                    
                  </div>

                  </div>
                </div>
              </div>
            </div>
</form>
</div>

<br><br>

@endsection
@section('script') 
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>  
  @include('forms.reportes.reporteVentas.scripts.datepicker')

  @include('forms.reportes.reporteVentas.scripts.exportarEcxel')
  @include('forms.reportes.reporteVentas.scripts.exportarPdf')  
  @include('forms.reportes.reporteVentas.scripts.rptVentaAcciones')  
@endsection 
