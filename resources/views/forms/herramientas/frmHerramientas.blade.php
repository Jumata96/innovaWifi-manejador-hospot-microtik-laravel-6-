@extends('layouts2.app')
@section('titulo','Importar/Exportar')

@section('main-content')
<br>
<div class="row">
	<div class="col s12 m12 l12">
                <div class="card">
                  <div class="card-header">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>IMPORT/EXPORT CLIENTE</h2>
                  </div>
                  
                  <div class="row card-header sub-header">
                        <div class="col s12 m12 herramienta">                         
                          <button id="addEquipo" class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" type="submit" name="action" data-position="top" data-delay="500" data-tooltip="Guardar">
                            <i class="material-icons blue-text text-darken-2">check</i></button>
                          <a style="margin-left: 6px"></a>   
                          <a href="#informacion" class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" data-position="top" data-delay="500" data-tooltip="Ver información del Formulario">
                            <i class="material-icons">info</i>
                          <a href="{{url('/equipos')}}" class="btn-floating right waves-effect waves-light grey lighten-5 tooltipped" href="#!" data-activates="dropdown2" data-position="top" data-delay="500" data-tooltip="Regresar">
                            <i class="material-icons" style="color: #424242">keyboard_tab</i></a>
                        </div>  

                        @include('forms.scripts.modalInformacion')              
                        
                  </div>
                                    
    <div class="row cuerpo">
      <div class="col s12 m12 l12">
          <div class="card white">
            <div class="card-content">
              <div class="row">
                <div class="col s12 m6 l6">
                <label for="idgrupo">Mikrotik Router</label>
                <select class="browser-default" id="idgrupo" name="idgrupo" data-error=".errorTxt1" > 
                  <option value="" disabled="" selected="">Elija un router</option>
                                                                     
                </select>
                <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
              </div>

              <div class="input-field col s12 s12 m6 l6 right-align">
                <div class="chip center-align" style="width: 70%">
                  <b>Estado:</b> No Disponible
                  <i class="material-icons mdi-navigation-close"></i>
                </div>
              </div> 
            </div>                     
          </div>
        </div>       
    </div>

      <div class="col s12 m6 l6">
                <div class="card">
                  <div class="card-header indigo lighten-5">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>IMPORADOR</h2>
                  </div>
               
                  <form method="POST" action="{{ url('tipo/guardar') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="grey lighten-5">
                    <div class="row cuerpo" style="margin-top: 1rem; margin-bottom: 0.5rem">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                      
                      
                      <div class="card white">
                          <div class="card-content">
                            <div class="row">
				                <div class="col s12 m12 l12">
				                <label for="idgrupo">Tipo de Acceso</label>
				                <select class="browser-default" id="idgrupo" name="idgrupo" data-error=".errorTxt1" > 
				                  <option value="" disabled="" selected="">Importar desde</option>
				                </select>
				                <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
				              </div>
				            </div>                              
                          </div>
                      </div>   
                    </div>
                  </form>               
                </div>
  	</div>
      
    <div class="col s12 m6 l6">
                <div class="card">
                  <div class="card-header blue lighten-5">                    
                    <i class="fa fa-table fa-lg material-icons">receipt</i>
                    <h2>EXPORTADOR</h2>
                  </div>
           
                  <form method="POST" action="{{ url('tipo/guardar') }}" accept-charset="UTF-8" enctype="multipart/form-data" class="grey lighten-5">
                    <div class="row cuerpo" style="margin-top: 1rem; margin-bottom: 0.5rem">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                      
                      
                      <div class="card white">
                          <div class="card-content">
                            <div class="row">
				                <div class="col s12 m12 l12">
				                <label for="idgrupo">Tipo de Acces</olabel>
				                <select class="browser-default" id="idgrupo" name="idgrupo" data-error=".errorTxt1" > 
				                  <option value="" disabled="" selected="">Exportar desde</option>
				                </select>
				                <div class="errorTxt1" id="error1" style="color: red; font-size: 12px; font-style: italic;"></div>
				              </div>
				            </div>                              
                          </div>
                      </div>   
                    </div>
                  </form>               
                </div>
  </div>
      
        

    </div>
                  
              </div>
  </div>
</div>
<br><br><br><br><br>
@endsection

@section('script')
  @include('forms.equipos.scripts.equipos')        
  @include('forms.equipos.scripts.addEquipo')                           
@endsection
