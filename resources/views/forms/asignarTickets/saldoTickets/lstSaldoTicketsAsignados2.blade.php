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
                  {{-- <div class="card-header sub-header">
                        <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" href="#modalAddVendedores" data-position="top" data-delay="500" data-tooltip="Seleccionar Vendedor">
                          <i class="material-icons" style="color: #03a9f4">add</i>
                        </a>
                        <a style="margin-left: 6px"></a>  
                       
                        @include('forms.scripts.modalInformacion')         
                  </div>  --}}
                  <div class="card-header sub-header">
                    <div class="col s12 m12 herramienta">
                      <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" href="#modalAddVendedores" data-position="top" data-delay="500" data-tooltip="Seleccionar Vendedor">
                        <i class="material-icons" style="color: #03a9f4">add</i>
                      </a> 
                    </div>
                    <div style="position: relative; height:65px; z-index: 0;">
                      <div class="fixed-action-btn horizontal direction-top direction-left" style="position: absolute; display: inline-block; right:5px;">
                        <a   class="btn-floating  light-blue darken-1" data-position="top"  >
                        <i class="material-icons prefix" >format_list_bulleted</i></a>
                        </a>
                        <ul>
                        <li>
                          <a id="exportReport" data-tooltip="Descargar Excel"  onclick="tableToExcel('data-table-simple', 'Reporte de saldo')"  class="btn-floating gradient-45deg-green-teal  tooltipped center" >
                            <img  width="40px" src="{{asset('TipoArchivo/excel2.ico')}}" >
                          </a> 

                          <a id="exportReportPdf"  class="btn-floating red tooltipped center"  data-tooltip="Descargar PDF"> 
                        <i class="material-icons">picture_as_pdf</i></a>  
                        </li>
                      
                        </ul>
                      </div>
                      </div> 
              </div> 
                  @include('forms.asignarTickets.saldoTickets.modalFiltroVendedor')
                  <div class="row cuerpo">
                    

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          <P id="registrosVendedores" ></P> 
                          <table id="data-table-simple" class="tablaVendedoresSaldo responsive-table display centered" {{-- cellspacing="0" --}}>
                               <thead>
                                  <tr style="background-color: steelblue;color: white">
                                    <th>#</th> 
                                    <th>Trabajador</th>
                                    <th>Cod.Alterno</th>
                                    <th>Paquete</th>  
                                    <th>Perfil</th> 
                                    <th>Cant.Asignado</th>
                                    <th>Saldo</th>
                                    <th>Vendidos</th>
                                    <th>Acciones</th>
                                  </tr>
                               </thead> 
                               <tfoot>
                                  <tr>
                                     <th>#</th> 
                                     <th>Trabajador</th>
                                     <th>Cod.Alterno</th>
                                     <th>Paquete</th> 
                                     <th>Perfil</th> 
                                     <th>Cant.Asignado</th>
                                     <th>Saldo</th>
                                     <th>Vendidos</th>
                                     <th>Acciones</th>
                                  </tr>
                                </tfoot> 
                               <tbody>
                                 @foreach ($arrayDatos as $datos)
                                 <tr> 
                                  <input type="hidden" name="">
                                  <td class="contador" >{{ $datos['cont'] }}</td>
                                  <td class="nombre" >{{ $datos ['nombre'] }}</td> 
                                  <td class="cod_alterno" >{{ $datos ['cod_alterno'] }}</td>
                                  <td class="PerfilAsignado" >{{ $datos ['PerfilAsignado'] }}</td>
                                  <td class="perfil_Nombre" >{{ $datos ['perfil_Nombre'] }}</td>

                                  
                                  <td class="asignados" >{{ $datos ['asignados'] }}</td>
                                  <td class="saldo" >{{ $datos ['saldo'] }}</td>
                                  <td class="diferencia" >{{ $datos ['diferencia'] }}</td>
                                  {{-- <td class="diferencia" >{{ intval($datos ['asignados'] )-intval( $datos ['saldo'])   }}</td> --}}
                                  
                                  <td>  
                                      <a  onclick="cargar({{ $datos['id'] }},{{ $datos['item'] }});" class=" btn-floating blue tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                          <i class="material-icons" >visibility</i>
                                      </a>  
                                  </td>
                                  </tr>
                                     
                                 @endforeach
                                  
                               </tbody>
                            </table>
                          </div>
                    
                  </div> 
                  </div>
                </div>
              </div>
</div>

@endsection 
@section('script')
  <script>
    var datos_Filtrado=[];
    datosBd = <?php echo json_encode($arrayDatos); ?>;
    for (x=0;x<datosBd.length; x++) { 
                              datos_Filtrado.push(new Array(datosBd[x].cont,
                              datosBd[x].nombre,
                              datosBd[x].cod_alterno,
                              datosBd[x].PerfilAsignado,
                              datosBd[x].perfil_Nombre, 
                              datosBd[x].asignados, 
                              datosBd[x].saldo,
                              datosBd[x].diferencia ));
    }
  </script>
  @include('forms.asignarTickets.saldoTickets.scripts.lstSaldoTicketsAsig')
  @include('forms\asignarTickets\saldoTickets\scripts\generarPdfSaldo')
  @include('forms\asignarTickets\saldoTickets\scripts\genrarXLsSaldo')
    
@endsection
 

