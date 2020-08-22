@extends('layouts2.app')
@section('titulo','Lista de Routers')


@include('API.router')
@section('main-content')
<br>

<div class="row" >
                  <div class="col s12">
                    <ul class="tabs tab-demo z-depth-1" style="width: 100%;">
                      <li class="tab col s4" style="background-color: #78909c; color: #fff"><a class="white-text waves-effect waves-light active" href="#test1"><i class="mdi-action-perm-identity"></i>Mantenedor Router</a>
                      </li>
                      <li class="tab col s4" style="background-color: #78909c;"><a href="#test2" class="white-text waves-effect waves-light"><i class="mdi-action-perm-identity"></i>Configuración</a>
                      </li>
                      <li class="tab col s4" style="background-color: #78909c;"><a href="#test3" class="white-text waves-effect waves-light"><i class="mdi-action-perm-identity"></i>Log Mikrotik</a>
                      </li>
                    <div class="indicator" style="right: 1px; left: 402px;"></div><div class="indicator" style="right: 1px; left: 402px;"></div></ul>
                  </div>
                  <div class="col s12">
                    <div id="test1" class="col s12 tabs-mk">
                      @include('forms.scripts.mntMikrotik')
                    </div>
                    <div id="test2" class="col s12 tabs-mk">
                      @include('forms.router.tipoAcceso')
                    </div>
                    <div id="test3" class="col s12 tabs-mk">
                      @foreach($router as $rou)
                        @include('API.mikrotik.log')
                      @endforeach
                    </div>
  </div>                 
</div>

<br><br><br>
@endsection



