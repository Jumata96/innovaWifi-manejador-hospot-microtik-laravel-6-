<?php 

  $API = new routeros_api();
  $API->debug = false;

  if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

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
                          <i class="material-icons prefix active" style="color: #9e9e9e">memory</i>
                          <input id="#" name="#" type="text" value="<?php echo $val['cpu']; ?>" disabled >
                          <label for="#" class="">CPU</label>
                        </div>
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="material-icons prefix active" style="color: #9e9e9e">cached</i>
                          <input id="#" name="#" type="text" value="<?php echo $val['cpu-frequency']; ?>" disabled >
                          <label for="#" class="">Frecuencia del CPU</label>
                        </div>
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="material-icons prefix active" style="color: #9e9e9e">report</i>
                          <input id="#" name="#" type="text" value="<?php echo $val['version']; ?>" disabled >
                          <label for="#" class="">Versión del RouterOS</label>
                        </div>
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="material-icons prefix active" style="color: #9e9e9e">history</i>
                          <input id="#" name="#" type="text" value="<?php echo $val['uptime']; ?>" disabled >
                          <label for="#" class="">Tiempo Conectado</label>
                        </div>
                        <div class="input-field col s12 s12 m12 l12">
                          <i class="material-icons prefix active" style="color: #9e9e9e">grade</i>
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