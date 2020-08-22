<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Probando ando';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {  
        $notificaciones = DB::table('notificaciones')->get();
        $fecha_actual = new \DateTime();
        $fecha_actual = date_format($fecha_actual,'d/m/Y');
        $fecha_pago = null;
        $fecha_aviso = null;
        $fecha_corte = null;
        $idrouter = null;
        $usuario = null;

        foreach ($notificaciones as $val) {
            $servicio = DB::table('servicio_internet')->where([
                ['idservicio', '=', $val->idservicio ],
                ['estado', '=', 1]
            ])->get();

            if (count($servicio) > 0) { //Verifica si existe registro de servicio de internet 
                $fecha_pago = date_format(date_create($val->fecha_pago),'d/m/Y');
                $fecha_aviso = date_format(date_create($val->fecha_aviso),'d/m/Y');
                $fecha_corte = date_format(date_create($val->fecha_corte),'d/m/Y');

                foreach ($servicio as $serv) {
                    $usuario = $serv->usuario_cliente;

                    if ($fecha_actual <= $fecha_corte) {

                        if ($fecha_aviso <= $fecha_actual) {
                            $router = DB::table('router')->where('idrouter',$serv->idrouter)->get();

                            $API = new routeros_api();
                            $API->debug = false;
                            $ARRAY = null;

                            foreach ($router as $rou) {
                                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                                    $ARRAY = $API->comm("/ip/hotspot/user/print");

                                    foreach ($ARRAY as $value) {
                                        if ($value['name'] == $usuario) {
                                            $ARRAY = $API->comm("/ip/hotspot/user/set", array(
                                                "profile"   => 'Aviso 1M',  
                                                ".id"       => $value['.id']
                                            ));     
                                            
                                        }
                                    }
                                }       
                            } 
                        }
                        
                    }else if($fecha_actual == $fecha_corte){

                        $router = DB::table('router')->where('idrouter',$serv->idrouter)->get();

                        $API = new routeros_api();
                        $API->debug = false;
                        $ARRAY = null;

                        foreach ($router as $rou) {
                            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                                    $ARRAY = $API->comm("/ip/hotspot/user/print");

                                    foreach ($ARRAY as $value) {
                                        if ($value['name'] == $usuario) {
                                            $ARRAY = $API->comm("/ip/hotspot/user/set", array(
                                                "profile"   => 'Corte Morosos',  
                                                ".id"       => $value['.id']
                                            ));     
                                            
                                        }
                                    }                                    
                                }       
                            } 

                    }
                }
            }
        }

        $this->info("Ingreso");
    }
}
