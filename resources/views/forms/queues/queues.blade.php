@extends('layouts.app')

@section('htmlheader_title')
	Queues
@endsection

@include('API.router')

@section('main-content')
<br>
	<div class="row">
                  <div class="col s12">
                    <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                      <li class="tab col s3" style="background-color: #78909c; color: #fff"><a class="white-text waves-effect waves-light active" href="#test1"><i class="mdi-action-perm-identity"></i>Configuración Queues</a>
                      </li>
                      <li class="tab col s3" style="background-color: #78909c;"><a href="#test2" class="white-text waves-effect waves-light"><i class="mdi-action-perm-identity"></i>Herramientas</a>
                      </li>
                    <div class="indicator" style="right: 1px; left: 402px;"></div><div class="indicator" style="right: 1px; left: 402px;"></div></ul>
                  </div>                  
                  <div class="col s12">
                    <div id="test1" class="col s12 tabs-mk" style="background-color: white">
                    	<div class="row grey lighten-3" style="height: 52px; padding-top: 6px; margin-left: -0.75rem; margin-right: -0.75rem">
	                        <div class="col s12 m12">
	                          <a class="btn-floating waves-effect waves-light grey lighten-5 tooltipped" href="{{ url('/queues/nuevo') }}" data-position="top" data-delay="500" data-tooltip="Nuevo"><i class="mdi-content-add" style="color: #03a9f4"></i></a>
	                          <a style="margin-left: 6px"></a>                          
	                          <a class="btn-floating waves-effect waves-light light-blue lighten-1 tooltipped modal-trigger" href="#informacion" data-position="top" data-delay="500" data-tooltip="Ver Información del Formulario"><i class="mdi-action-info"></i></a>                                   
	                        </div>  
	                        @include('forms.scripts.modalInformacion')         
	                  </div>
                      @include('forms.queues.lstQueues')
                    </div>

                    <div id="test2" class="col s12 tabs-mk">
                      
                    </div>
  </div>                 
</div>

<br><br><br>
@endsection


