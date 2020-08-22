<!DOCTYPE html>
<html lang="es">

<head>
  @include('hotspot.layouts.partials.htmlHead')
</head>

<body style="background: white" >
	
	<div id="main" style="padding-left: 0px">
      <!-- START WRAPPER -->
      <div class="wrapper">
             <br>
        <section id="content center">
        	<div class="row">
        		<div class="col s12 m8 l6 offset-m2 offset-l3">
                    <div class="card gradient-45deg-light-blue-cyan">
                            <div class="card-content white-text center">
                              <h6 class="card-title font-weight-400">Oferta de Producto</h6>
                              <br>
                              <img src="{{asset('img/oferta2.png')}}" style="width: 100%; min-height: 60%;">
                              <br><br>
                              <p>Camisa manga larga,
                                <br> Por cierre de temporada en todo los modelos</p>
                                <div class="card-action border-non center">
                                  <a class="waves-effect waves-light btn gradient-45deg-red-pink box-shadow">Offerta: 10% dst.</a>
                                </div>
                            </div>
                            
                      </div>
            </div>
        	</div>
        </section>
        
        </div>
        <!-- END WRAPPER -->
    </div>     
      @include('hotspot.layouts.partials.scripts')  
      <script language="JavaScript">
	
	  </script>
</body>
</html>