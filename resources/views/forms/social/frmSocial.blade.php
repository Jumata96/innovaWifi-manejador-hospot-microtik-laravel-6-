@extends('layouts2.app')
@section('titulo','Parámetros Redes Sociales')

@section('main-content')
<br>
<div class="row">
  <div class="col s12 m8 l6 offset-m2 offset-l3">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>PARÁMETROS REDES SOCIALES</h2>
                  </div>
                  <form class="formValidate right-alert" id="formValidate" method="POST" action="{{ url('/usuario/grabar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <a id="update" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons" style="color: #2E7D32">check</i>
                          </a>    
                          <a href="{{ url('/hotspot/pagina-inicio') }}" target="_blank" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" data-position="top" data-delay="500" data-tooltip="Ver prototipo página">
                            <i class="material-icons" style="color: #7986cb ">visibility</i>
                          </a> 
                          <a style="margin-left: 6px"></a>   
                          
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
                  
                  <div class="row cuerpo">
                    <div class="col s12 ">
                      
                    
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="card white">
                          <div class="card-content">
                              <span class="card-title">Generales</span>
                                @if(count($parametros) > 0)
                                @foreach($parametros as $val)
                                <div class="row">
                                
                                  <div class="input-field col s12 m6 l8">                                  
                                    <p>{{$val->descripcion}}</p>                                  
                                  </div>  
                                  
                                  <div class="col s12 m6 l4">
                                    <label for="idmodelo">Registro</label>
                                    <select id="{{$val->parametro}}" class="browser-default" name="{{$val->parametro}}" data-error=".errorTxt1"> 
                                      <option value="" disabled="">Habilitar</option>
                                      @if($val->valor == 'SI')
                                        <option value="SI" selected="">SI</option>
                                        <option value="NO">NO</option>
                                      @else if($val->valor == 'NO')
                                        <option value="SI">SI</option>
                                        <option value="NO" selected="">NO</option>
                                      @endif
                                    </select>                                  
                                  </div>         
                                </div>
                                @endforeach        
                                @endif   
                          </div>
                      </div>
                    </div>
                      
                  </div>
                  </form>
              </div>
  </div>
</div>
<br><br><br>
@endsection

@section('script')
  @include('forms.social.scripts.addSocial')
@endsection
