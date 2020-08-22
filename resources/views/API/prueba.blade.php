<?php 

  //require 'routeros_api.php';
  require 'routeros_api2.php';
 ?>
<?php 
 
  $ipRouteros="172.168.0.1";  // tu RouterOS.
  $Username="leo";
  $Pass="l3o1988";
  $api_puerto=8728;

  $API = new routeros_api();
  $API->debug = false;

  if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {

    $API->write("/ip/dhcp-server/lease/getall", true);
    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);
   
    $i = 0;

  ?>

  
<br>
<div class="row">
  <div class="col s12 m12 l12">
    <div class="card white">
      <div class="card-content">
        Existen <?php echo count($ARRAY); ?> IP´s asigandas. <br><br>
        <table id="data-table-simple" class="responsive-table display" cellspacing="0">
             <thead>
                <tr>
                   <th>#</th>
                   <th>Host</th>
                   <th>IP-Address</th>
                   <th>MAC-Address</th>
                   <th>Tiempo</th>
                   <th>Expira</th>
                </tr>
             </thead>

             <tfoot>
                <tr>
                   <th>#</th>
                   <th>Host</th>
                   <th>IP-Address</th>
                   <th>MAC-Address</th>
                   <th>Tiempo</th>
                   <th>Expira</th>
                </tr>
              </tfoot>

             <tbody>
              <tr>
              <?php foreach ($ARRAY as $valor) {

               $i++;   

                  if (array_key_exists('host-name', $valor)) {
                   
                    $host = $valor['host-name'] ;
                  }else{

                    $host = "---";

                  }

                  if (array_key_exists('expires-after', $valor)) {
                   
                    $expira = $valor['expires-after'] ;
                  }else{

                    $expira = "---";

                  } ?>

                   
                   <td><?php echo $i; ?></td>
                   <td><?php echo $host ?></td>
                   <td><?php echo $valor['address'] ?></td>
                   <td><?php echo $valor['mac-address'] ?></td>
                   <td><?php echo $valor['last-seen'] ?></td>
                   <td><?php echo $expira; ?></td>
                </tr>
                <?php } ?>
             </tbody>
          </table>
        </div>
    </div>
  
</div>

     


    <?php

    $API->disconnect();

  }else{
    echo "No se pudo conectar al mikrotik";
  }




?>