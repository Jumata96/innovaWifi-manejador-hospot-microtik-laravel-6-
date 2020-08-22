<?php 
  

  $API = new routeros_api();
  $API->debug = false;

  if ($API->connect($rou->ip , $rou->usuario , $rou->contrasena, $rou->puerto )) {

    //Recursos del Mikrotik
    $API->write("/system/resource/getall", true);
    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);
   
    $i = 0;

    foreach ($ARRAY as $arr) {
   		//dd($arr);
  		$val = $arr;
    }

    //Licencia Mikrotik
    $API->write("/system/license/getall", true);
    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);
   
    $i = 0;

    foreach ($ARRAY as $arr) {
   		//dd($arr);
  		$val2 = $arr;
    }

    // dd($val );
    ?>


                      <div class="row">
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="mdi-hardware-memory prefix active" style="color: #9e9e9e"></i>
                          <input id="#" name="#" type="text" value="<?php echo $val['cpu']; ?>" disabled >
                          <label for="#" class="">CPU</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="mdi-action-cached prefix active" style="color: #9e9e9e"></i>
                          <input id="#" name="#" type="text" value="<?php echo $val['cpu-frequency']; ?>" disabled >
                          <label for="#" class="">Frecuencia del CPU</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="mdi-content-report prefix active" style="color: #9e9e9e"></i>
                          <input id="#" name="#" type="text" value="<?php echo $val['version']; ?>" disabled >
                          <label for="#" class="">Versión del RouterOS</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="mdi-action-history prefix active" style="color: #9e9e9e"></i>
                          <input id="#" name="#" type="text" value="<?php echo $val['uptime']; ?>" disabled >
                          <label for="#" class="">Tiempo Conectado</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="mdi-action-grade prefix active" style="color: #9e9e9e"></i>
                          <input id="#" name="#" type="text" value="Nivel <?php echo $val2['software-id']; ?>" disabled >
                          <label for="#" class="">Licencia</label>
                        </div>
                      </div>
                      
<?php 
	

    $API->disconnect();

  }else{
    echo "No se pudo conectar al mikrotik";
  }

?>