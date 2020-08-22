<?php 


  $API = new routeros_api();
  $API->debug = false;

  if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto)) {

    $API->write("/log/getall", true);
    $READ = $API->read(false);
    $ARRAY = $API->parse_response($READ);
    
    //dd($ARRAY);
    $i = 0;

  ?>

  
<br>
<div class="row">
  <div class="col s12 m12 l12">
    <div class="card white">
      <div class="card-content">
        Existen <?php echo count($ARRAY); ?> registros. <br><br>
        <table id="data-table-simple" class="responsive-table display" cellspacing="0">
             <thead>
                <tr>
                   <th width="20px">#</th>
                   <th width="100%">Fecha</th>
                   <th width="100%">Tópico</th>
                   <th width="100%">Mensaje</th>
                </tr>
             </thead>

             <tfoot>
                <tr>
                   <th>#</th>
                   <th>Fecha</th>
                   <th>Tópico</th>
                   <th>Mensaje</th>
                </tr>
              </tfoot>

             <tbody>
              <tr>
                <?php foreach ($ARRAY as $valor) {
               		$i++;                     
                 ?>

                   
                   <td><?php echo $i; ?></td>
                   <td><?php echo $valor['time'] ?></td>
                   <td><?php echo $valor['topics'] ?></td>
                   <td><?php echo $valor['message'] ?></td>
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