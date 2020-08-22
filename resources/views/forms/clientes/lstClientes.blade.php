@extends('layouts2.app')
@section('titulo','Lista de usuarios registrados')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>LISTA DE USUARIOS REGISTRADOS</h2>
                  </div>
                 
                  <div class="card-header" style="height: 50px; padding-top: 5px; background-color: #f6f6f6">
                        <div class="col s12 m12">
                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/hotspot/conexiones') }}" data-position="top" data-delay="500" data-tooltip="Nuevo">
                            <i class="material-icons" style="color: #03a9f4">add</i>
                          </a>
                          <a style="margin-left: 6px"></a>                          
                                                        
                        </div>  
                        @include('forms.scripts.modalInformacion')         
                  </div>
                                    
                  <div class="row cuerpo">
                    <?php 

                      $bandera = false;

                      if (count($usuarios) > 0) {
                        # code...
                        $bandera = true;
                        $i = 1;
                      }

                    ?>

                  <br>
                  <div class="row">
                    <div class="col s12 m12 l12">
                      
                        <div class="card-content">
                          Existen <?php echo ($bandera)? count($usuarios) : 0; ?> registros. <br><br>
                          <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                               <thead>
                                  <tr>
                                     <th>#</th>
                                     <th class="center">Avatar</th>
                                     <th>Nombre</th>
                                     <th>Correo</th>
                                     <th class="center">Social login</th>
                                     <th class="center">Fecha creación</th>                                     
                                     <th class="center">Estado</th>
                                     <th char="center">Acción</th>
                                  </tr>
                               </thead>
                                                            

                               <tbody>
                                @foreach($usuarios as $datos)
                                <tr class="center">
                                     <td class="center-align"><?php echo $i++; ?></td>
                                     <td>
                                      @if(!is_null($datos->avatar_original))
                                       <img src="{{$datos->avatar_original}}" alt="{{$datos->nombre}}" class="z-depth-2 circle responsive-img valign profile-image teal lighten-5" style="height: 50px; width: 50px">
                                      @else
                                        <div class="center-align z-depth-2 circle responsive-img valign profile-image grey lighten-5" style="height: 50px; width: 50px;">
                                          <i class="material-icons" style="padding-top: 0.5rem; font-size: 2.2rem; color: #616161">person</i>
                                        </div>                                       
                                      @endif
                                     </td>
                                     <td>{{$datos->nombre}}</td>
                                     <td>{{$datos->email}}</td>
                                     <td class="center">
                                      @if($datos->social_login == 'google')
                                        <div class="chip center-align white-text" style="background: #4285F4 !important">
                                            <b>GOOGLE+</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @elseif($datos->social_login == 'facebook')
                                        <div class="chip center-align white-text" style="background: #4267B2">
                                            <b>FACEBOOK</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @elseif($datos->social_login == 'twitter')
                                        <div class="chip center-align white-text" style="background: #1DA1F2">
                                            <b>TWITTER</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @else
                                        <div class="chip center-align white-text" style="background: #bdbdbd">
                                            <b>MANUAL</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                    </td>
                                     <td>{{$datos->fecha_creacion}}</td>
                                     <td class="center">
                                        @if($datos->estado == 0)
                                        <div class="chip center-align" style="width: 70%;">
                                            <b>NO DISPONIBLE</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @else
                                        <div class="chip center-align teal accent-4 white-text" style="width: 70%">
                                          <b>ACTIVO</b>
                                          <i class="material-icons"></i>
                                        </div>
                                      @endif
                                     </td>

                                     <td class="center" style="width: 9rem">
                                       <a href="{{ url('/hotspot/usuario') }}/{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver">
                                        <i class="material-icons" style="color: #7986cb ">visibility</i>
                                      </a>                                       
                                       <a href="#confirmacion{{$i}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Eliminar">
                                        <i class="material-icons" style="color: #dd2c00">remove</i>
                                      </a>
                                      @if($datos->estado == 1)                                      
                                       <a href="#confirmacion2{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Desabilitar">
                                        <i class="material-icons" style="color: #757575 ">clear</i></a>
                                       @else
                                       <a href="#confirmacion3{{$datos->codigo}}" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Habilitar">
                                        <i class="material-icons" style="color: #2e7d32 ">check</i></a>
                                       @endif
                                     </td>
                                </tr>
                                  @include('forms.clientes.scripts.alertaConfirmacion')
                                  @include('forms.clientes.scripts.alertaConfirmacion2')
                                  @include('forms.clientes.scripts.alertaConfirmacion3')
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
  @include('forms.clientes.scripts.desabilitar')
  @include('forms.clientes.scripts.habilitar')
@endsection