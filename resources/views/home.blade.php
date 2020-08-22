@extends('layouts2.app')
@section('titulo','DashBoard')

@section('sub-cabecera')
 <!--   <div id="breadcrumbs-wrapper">
            <div class="container">
              <div class="row">
                <div class="col s10 m6 l6">
                  <h5 class="breadcrumbs-title">DashBoard</h5>
                  <ol class="breadcrumbs">
                    <li><a href="#" style="color: #00796b">Indicadores</a></li>
                    <li><a href="#" style="color: #00796b">Estadísticas</a></li>
                    <li><a href="#" style="color: #00796b">Accesos directos</a></li>
                  </ol>
                </div>
               
              </div>
            </div>
          </div>
  -->
@endsection

@section('main-content')
  <div style="padding-top: 10px"></div>
	@include('forms.dashboard.generales')

  @include('forms.dashboard.monitor')

@endsection

@section('script')
  
  
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

  @include('forms.dashboard.scripts.monitor')
  @include('forms.dashboard.scripts.inicio')

@endsection
