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
                        <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" href="#modalAddVendedores" data-position="top" data-delay="500" data-tooltip="Seleccionar Vendedor">
                          <i class="material-icons" style="color: #03a9f4">add</i>
                        </a>
                        <a style="margin-left: 6px"></a>  
                       
                        @include('forms.scripts.modalInformacion')         
                  </div>
                  @include('forms.asignarTickets.saldoTickets.modalAddVendedor')
                  <div class="row cuerpo">
                    

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen 0 registros. <br><br>
                          <table id="data-table-simple" class=" tablaVendedoresSaldo responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                    <th>#</th> 
                                    <th>Trabajador</th>
                                    <th>Cod.Alterno</th>
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
                                     <th>Cant.Asignado</th>
                                     <th>Saldo</th>
                                     <th>Vendidos</th>
                                     <th>Acciones</th>
                                  </tr>
                                </tfoot> 
                               <tbody>
                                  <tr  >                                  
                                     <td colspan="7" class="center"> <h4>Debe de seleccionar un  vendedor</h4></td>  
                                  </tr> 
                                  {{-- <tr  >
                                    <td ></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                    <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i>
                                    </a>

                                    </td>
                                </tr> --}} 
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
@include('forms.asignarTickets.saldoTickets.scripts.lstSaldoTicketsAsignados')
    
@endsection

