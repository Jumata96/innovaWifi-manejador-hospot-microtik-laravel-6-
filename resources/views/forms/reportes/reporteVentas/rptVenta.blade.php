@extends('layouts2.app')
@section('titulo','Reporte de pagos') 
@section('main-content')
<div style="margin-top: 8px"></div>
<div class="row"> 



<form id="frmReport" action="{{url('/tickets/reporte-venta-Filtro')}}" method="POST" >
  
  <div class="col s12 m12 l12 " >
                <?php 
                      $bandera = false; 
                      if (count($Ventas) > 0) {
                        $bandera = true; 
                        $i = 0;
                      }
                ?> 
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                   @include('forms.reportes.reporteVentas.modalFiltroVendedor')
                   @include('forms.reportes.reporteVentas.modalInformacion') 
                    <input type="hidden" id="contadorVendedores" name="contadorVendedores" value="0">
                <div class="card">
                  <div  class="card-header" id="context-menu-target">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2 style="padding-left:30px"><b>REPORTE DE VENTAS |</b> <i style="color: #3f51b5">Existen <?php echo ($bandera)? count($Ventas) : 0; ?> registros.</i></h2> 
                      
                  </div> 
                  
                  
                  <div class="card-header sub-header">
                        <div class="col s12 m12 herramienta">
                          <button type="submit" id="filtrarVendedores" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Buscar"> 
                              <i class="material-icons" style="color: #03a9f4">search</i></button> 

                              <a   href="#modalInformacion" rel="modal:open"   class="btn-floating waves-effect waves-light grey lighten-5 tooltipped"  data-tooltip="informacion de colores"> 
                            <i class="material-icons" style="color: #03a9f4">info_outline</i></a>  
                        </div>
                        <div style="position: relative; height:65px; z-index: 0;">
													<div class="fixed-action-btn horizontal direction-top direction-left" style="position: absolute; display: inline-block; right:5px;">
														<a   class="btn-floating  light-blue darken-1" data-position="top"  >
														<i class="material-icons prefix" >format_list_bulleted</i></a>
														</a>
														<ul>
														<li>
                              <a id="exportReport" data-tooltip="Descargar Excel"  onclick="tableToExcel('data-table-simple', 'Reporte de venta')"  class="btn-floating gradient-45deg-green-teal  tooltipped center" >
                                <img  width="40px" src="{{asset('TipoArchivo/excel2.ico')}}" >
                              </a> 

                              <a id="exportReportPdf"  class="btn-floating red tooltipped center"  data-tooltip="Descargar PDF"> 
                            <i class="material-icons">picture_as_pdf</i></a>  
														</li>
													
														</ul>
													</div>
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
                                  <div>
                            

                                  </div>

                                </div>
                                </div>
                    </div> 
                    </div> 
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content" style="overflow-x:scroll">
                          
                          <table id="data-table-simple" class="responsive-table centered Highlight  tablaFiltro" cellspacing="10" style="white-space: nowrap;">
                               <thead>

                                @foreach($parametros as $Param)
                                    @if($Param->parametro == 'ADD_CABECERA' and $Param->valor == 'SI')
                                    <input type="hidden" id="Cabecera_color" name="Cabecera_color" value="SI">
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
                                    <input type="hidden" id="Cabecera_color" name="Cabecera_color" value="NO">
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
                                     <td style="background-color:#64b5f6;" class=" usuarioTabla">  {{ $datos['Vendedor'] }} </td>
                                     <td style="background-color:#64b5f6;" class=" Cod_Alterno">{{ $datos['Cod_Alterno'] }}</td>
                                     <td style="background-color:#64b5f6;" class="  zonaTabla">{{ $datos['Punto_de_Venta']}}</td>                                     
                                     <td style="background-color:#64b5f6;" class=" Ticket"> {{ $datos['Ticket'] }} </td> 
                                     <td style="background-color:#64b5f6;" class=" perfilTabla"> {{ $datos['Plan'] }}</td>
                                     <td style="background-color:#64b5f6;" class=" precioTabla">{{ $datos['Precio'] }} </td>  
                                   @else
                                     <td  class="usuarioTabla">  {{ $datos['Vendedor'] }} </td>
                                     <td class="Cod_Alterno">{{ $datos['Cod_Alterno'] }}</td>
                                     <td class=" zonaTabla">{{ $datos['Punto_de_Venta']}}</td>                                     
                                     <td class="Ticket"> {{ $datos['Ticket'] }} </td> 
                                     <td class="perfilTabla"> {{ $datos['Plan'] }}</td>
                                     <td class="precioTabla">{{ $datos['Precio'] }} </td>  
                                   @endif

                                   
                                     <td  style="background-color:#e6ee9c ;" class="Total_Asignados"> {{ $datos['Total_Asignados'] }} </td> 
                                     <td style="background-color:#e6ee9c ;" class="Total_AsignadosMonto"> {{ $datos['Total_AsignadosMonto'] }} </td>
                                     <td style="background-color:#dce775 ;" class="Saldo_Total "> {{ $datos['Saldo_Total'] }} </td> 
                                     <td style="background-color:#dce775;" class="Saldo_TotalMonto "> {{ $datos['Saldo_TotalMonto'] }}</td>
                                     <td style="background-color:#ffcc80;" class="Total_Vendidos"> {{ $datos['Total_Vendidos'] }}</td> 
                                     <td style="background-color:#ffcc80;" class="Total_VendidosMonto">   {{ $datos['Total_VendidosMonto'] }} </td> 
                                     <td style="background-color:#c5e1a5 ;" class=" cantidadTabla ">{{ $datos['Cantidad_Venta'] }}</td>
                                     <td style="background-color:#c5e1a5 ;" class=" subtotalTabla "> {{ $datos['Subtotal'] }} </td> 
                                     <td  class=" fechaTabla">{{ date("Y-m-d", strtotime($datos['Fecha_de_venta']))}} </td>
                                      
                                     
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
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

  <script>
    $('.fullscreenNavClass').on('click',function(){
      console.log('ingreso'); 
        var doc = window.document;
    var docEl = doc.documentElement;

    var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
    var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

    if(!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
      requestFullScreen.call(docEl);
    }
    else {
      cancelFullScreen.call(doc);
    }
    }); 
  </script> 
   

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/ax5ui/ax5ui-menu/master/dist/ax5menu.css" />

<script type="text/javascript" src="https://cdn.rawgit.com/ax5ui/ax5core/master/dist/ax5core.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/ax5ui/ax5ui-menu/master/dist/ax5menu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

 

 <script src="https://unpkg.com/vue-simple-context-menu/dist/vue-simple-context-menu.min.js"></script>
 
<link rel="stylesheet" type="text/css" href="https://unpkg.com/vue-simple-context-menu/dist/vue-simple-context-menu.css"> 
 <script type="text/javascript">



    var menu;
    var menus =[];
    var menusele =[]; 
    menus.push( 
        {  check: {type: 'checkbox', name: 'Vendedor', value: '0', checked: false},  label: "Vendedor"  },
        {  check: {type: 'checkbox', name: 'Cod_Alterno', value: '0', checked: false},  label: "Cod Alterno"  },
        {  check: {type: 'checkbox', name: 'Punto_de_Venta', value: '0', checked: false},  label: "Punto de Venta"  },
        {  check: {type: 'checkbox', name: 'Ticket', value: '0', checked: false},  label: "Paquete"  },
        {  check: {type: 'checkbox', name: 'Plan', value: '0', checked: false},  label: "Plan"  },
        {  check: {type: 'checkbox', name: 'Precio', value: '0', checked: false},  label: "Precio"  },
        {  check: {type: 'checkbox', name: 'Total_AsignadosMonto', value: '0', checked: false},  label: "Total Asignados Monto"  },
        {  check: {type: 'checkbox', name: 'Saldo_TotalMonto', value: '0', checked: false},  label: "Saldo Total Monto"  },
        {  check: {type: 'checkbox', name: 'Total_VendidosMonto', value: '0', checked: false},  label: "Total Vendidos Monto"  },
        {  check: {type: 'checkbox', name: 'Total_Asignados', value: '0', checked: false},  label: "Total Asignados"  },
        {  check: {type: 'checkbox', name: 'Saldo_Total', value: '0', checked: false},  label: "Saldo Total"  },
        {  check: {type: 'checkbox', name: 'Total_Vendidos', value: '0', checked: false},  label: "Total Vendidos"  },
        {  check: {type: 'checkbox', name: 'Cantidad_Venta', value: '0', checked: false},  label: "Cantidad Venta"  },
        {  check: {type: 'checkbox', name: 'Subtotal', value: '0', checked: false},  label: "Subtotal"  },
        {  check: {type: 'checkbox', name: 'Fecha_de_venta', value: '0', checked: false},  label: "Fecha_de_venta"  }  
    );

    $(document.body).ready(function () {
        menu = new ax5.ui.menu({
            position: "fixed",  
              onClick: function () {  
                console.log(this);
                menusele.push(this);
            },  
            items: [
                {
                    label: "CONFIGURAR",
                    items: [
                          {   label: "COLUMNAS TABLA",
                              items:menus
                          },{ label: "COLUMNAS PDF",
                              items: menus
                          }  
                      ]
                } 
            ]
        }); 
        $("#context-menu-target").bind("contextmenu", function (e) {
            menu.popup(e); 
            
            
        });
    }); 
</script>

  
@endsection 
