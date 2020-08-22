@extends('layouts2.app')
@section('titulo','Perfil cliente')

@section('main-content')
<br>
@foreach($usuario as $datos)
<div class="row">
  <div class="col s12 m8 l4 offset-m2 offset-l2">
                    <h4 class="header center">Perfil de usuario</h4>
                    <div id="profile-card" class="card" style="overflow: hidden;">
                      <div class="card-image waves-effect waves-block waves-light gradient-45deg-light-blue-indigo">
                        <img class="" src="{{asset('/images/user-profile-bg.jpg')}}" alt="" >
                      </div>
                      <div class="card-content">
                        <img src="{{$datos->avatar_original}}" alt="" class="circle responsive-img activator card-profile-image cyan lighten-1" style="width: 90px">
                        <a class="btn-floating activator btn-move-up waves-effect waves-light blue accent-2 z-depth-4 right">
                          <i class="material-icons">visibility</i>
                        </a>
                        <br>
                        <h5 class="card-title activator grey-text text-darken-4">{{$datos->nombre}}</h5>
                        @if(!empty($datos->nickname))
                        <p>
                          <i class="material-icons">face</i> {{$datos->nickname}}</p>
                        @endif
                        @if(!empty($datos->fecha_nacimiento))
                        <p>
                          <i class="material-icons">cake </i>Fecha nacimiento: {{$datos->fecha_nacimiento}}</p>
                        @endif
                        @if(!empty($datos->genero))
                        <p>
                          <i class="material-icons">perm_identity</i>Género: {{$datos->genero}}</p>
                        @endif
                        @if(!empty($datos->fecha_creacion))
                        <p>
                          <i class="material-icons">date_range </i> Registro: {{$datos->fecha_creacion}} </p>
                        @endif
                        @if(!empty($datos->ciudad_nacimiento))
                        <p>
                          <i class="material-icons">location_on </i> Ciudad nacimiento: {{$datos->ciudad_nacimiento}} </p>
                        @endif
                        @if(!empty($datos->ciudad_radica))
                        <p>
                          <i class="material-icons">location_on </i> Ciudad radica: {{$datos->ciudad_radica}} </p>
                        @endif
                        @if(!empty($datos->email))
                        <p>
                          <i class="material-icons">email</i> {{$datos->email}}</p>
                        @endif
                        @if(!empty($datos->celular))
                        <p>
                          <i class="material-icons">phone</i> {{$datos->celular}}</p>
                        @endif
                       
                      </div>
                      <div class="card-reveal" style="display: none; transform: translateY(0px);">
                        <span class="card-title grey-text text-darken-4">{{$datos->nombre}}
                          <i class="material-icons right">close</i>
                        </span>
                        @if(!empty($datos->nickname))
                        <p>
                          <i class="material-icons">face</i> {{$datos->nickname}}</p>
                        @endif
                        @if(!empty($datos->fecha_nacimiento))
                        <p>
                          <i class="material-icons">cake </i>Fecha nacimiento: {{$datos->fecha_nacimiento}}</p>
                        @endif
                        @if(!empty($datos->genero))
                        <p>
                          <i class="material-icons">perm_identity</i>Género: {{$datos->genero}}</p>
                        @endif
                        @if(!empty($datos->fecha_creacion))
                        <p>
                          <i class="material-icons">date_range </i> Registro: {{$datos->fecha_creacion}} </p>
                        @endif
                        @if(!empty($datos->ciudad_nacimiento))
                        <p>
                          <i class="material-icons">location_on </i> Ciudad nacimiento: {{$datos->ciudad_nacimiento}} </p>
                        @endif
                        @if(!empty($datos->ciudad_radica))
                        <p>
                          <i class="material-icons">location_on </i> Ciudad radica: {{$datos->ciudad_radica}} </p>
                        @endif
                        @if(!empty($datos->email))
                        <p>
                          <i class="material-icons">email</i> {{$datos->email}}</p>
                        @endif
                        @if(!empty($datos->celular))
                        <p>
                          <i class="material-icons">phone</i> {{$datos->celular}}</p>
                        @endif
                        @if(!empty($datos->mac))
                        <p>
                          <i class="material-icons">blur_linear</i> {{$datos->mac}}</p>
                        @endif
                        @if(!empty($datos->ip))
                        <p>
                          <i class="material-icons">settings_ethernet</i> {{$datos->ip}}</p>
                        @endif
                        <p>
                        </p>
                      </div>
                    </div>
  </div>

  <div class="col s12 m8 l4 offset-m2">
    <h4 class="header center">Indicadores</h4>
    <div class="row">
      <div class="col s12">
        <div class="card gradient-45deg-purple-deep-orange gradient-shadow min-height-100 white-text">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5">room </i>
              <p>Recurrencia</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0">{{$datos->concurrencia}}</h4>
              <p class="no-margin">visitas</p>
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col s12">
        <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5">get_app</i>
              <p>Total descarga</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0">{{$down}}</h4>
              <p class="no-margin">{{$tdown}}</p>
              <p></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col s12">
        <div class="card gradient-45deg-indigo-light-blue gradient-shadow min-height-100 white-text">
          <div class="padding-4">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5">file_upload</i>
              <p>total subida</p>
            </div>
            <div class="col s5 m5 right-align">
              <h4 class="mb-0">{{$up}}</h4>
              <p class="no-margin">{{$tup}}</p>
              <p></p>
            </div>
          </div>
        </div>
      </div>
    </div>              
  </div>
<!--
  <div id="chartjs-pie-chart" class="section">
                <h4 class="header">Pie &amp; Doughnut Charts</h4>
                <div class="row">
                  <div class="col s12">
                    <p>Pie and doughnut charts are probably the most commonly used chart there are. They are divided into segments, the arc of each segment shows the proportional value of each piece of data.</p>
                  </div>
                  <div class="col s12">
                    <div class="row">
                      <div class="col s12 m6 l6">
                        <div class="sample-chart-wrapper">
                          <canvas id="pie-chart-sample" width="760" height="380" style="width: 608px; height: 304px;"></canvas>
                        </div>
                        <p class="header center">Pie Charts</p>
                      </div>
                      <div class="col s12 m6 l6">
                        <div class="sample-chart-wrapper">
                          <canvas id="doughnut-chart-sample" width="760" height="380" style="width: 608px; height: 304px;"></canvas>
                        </div>
                        <p class="header center">Doughnut Charts</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            -->
</div>
@endforeach

@endsection

@section('script')
  @include('forms.clientes.scripts.scripts')
@endsection

