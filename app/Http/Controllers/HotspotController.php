<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;
use Carbon\Carbon;

class HotspotController extends Controller
{
    public function conexiones()
    {        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
        $collection = 0;
        $i = 0;

        $router = DB::table('router')->where('activo',1)->get();

        foreach ($router as $rou) {
            $i = 0;
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/ip/hotspot/active/print");
                if (count($ARRAY) > 0) {
                    for ($i=0; $i < count($ARRAY); $i++) { 
                        $ARRAY[$i]['idrouter'] = $rou->idrouter;
                    }                    
                }
                
                $collection = Collection::make($ARRAY);  
                $i++;         
            }       
        }

        //dd($collection);
        $usuarios = DB::table('usuarios_hotspot')
        ->where([
        	'idempresa'		=> '001',
        	'estado'		=> 1
        ])->get();

        return view('forms.conexiones.lstConexiones',[
        	'collection'	=> $collection,
        	'usuarios'		=> $usuarios
        ]);
    }

    public function desconectar($id,$idrouter){
        //dd($id,$idrouter);
        $router = DB::table('router')->where('idrouter',$idrouter)->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
        $collection = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $API->comm("/ip/hotspot/active/remove", array(
                                "numbers" => $id,
                ));

                $ARRAY = $API->comm("/ip/hotspot/active/print");
                $collection = Collection::make($ARRAY);   

                $API->disconnect();                
            }       
        }


        return redirect('/conexiones');
    }

    //------------------PAGINA DE BIENVENIDA-----------------------------
    public function bienvenida()
    {
        $bienvenida = DB::table('hotspot_bienvenida')->where('codigo',1)->get();

        return view('hotspot.login2',[
            'bienvenida'    => $bienvenida
        ]);
    }

    public function mntBienvenida()
    {
        $bienvenida = DB::table('hotspot_bienvenida')->get();

        return view('forms.hotspot.mntBienvenida',[
            'bienvenida'    => $bienvenida
        ]);
    }

    public function addBienvenida(Request $request)
    { 
        //dd($request);
        if (!$user = DB::table('hotspot_bienvenida')->where('codigo', 1)->first()) { 
            DB::table('hotspot_bienvenida')
             ->insert([
                'idempresa'             => '001',
                'codigo'                => 1,
                'color_fondo'           => $request->color_fondo,
                'color_btn_navegar'     => $request->color_btn_navegar,
                'color_btn_cerrar'      => $request->color_btn_cerrar,
                'link'                  => $request->link                
             ]);
        }else{
            DB::table('hotspot_bienvenida')
             ->where('codigo',1)
             ->update([
                'color_fondo'           => $request->color_fondo,
                'color_btn_navegar'     => $request->color_btn_navegar,
                'color_btn_cerrar'      => $request->color_btn_cerrar,
                'link'                  => $request->link
             ]);
        }

              
            
        $datos = DB::table('hotspot_bienvenida')->where('codigo',1)->get();
        $collection = Collection::make($datos);
                
        return response()->json($collection->toJson());   
    }

    public function addParametrosBienvenida(Request $request)
    { 
        //dd($request);
        $mostrar_ip = 0;
        $mostrar_mac = 0;
        $mostrar_up_down = 0;
        $mostrar_tiempo_con = 0;
        $mostrar_status = 0;

        if(!empty($request->mostrar_ip)){
            $mostrar_ip = 1;
        }
        if(!empty($request->mostrar_mac)){
            $mostrar_mac = 1;
        }
        if(!empty($request->mostrar_up_down)){
            $mostrar_up_down = 1;
        }
        if(!empty($request->mostrar_tiempo_con)){
            $mostrar_tiempo_con = 1;
        }
        if(!empty($request->mostrar_status)){
            $mostrar_status = 1;
        }

        if (!$user = DB::table('hotspot_bienvenida')->where('codigo', 1)->first()) { 
            DB::table('hotspot_bienvenida')
             ->insert([
                'idempresa'             => '001',
                'codigo'                => 1,
                'mostrar_ip'            => $mostrar_ip,
                'mostrar_mac'           => $mostrar_mac,
                'mostrar_up_down'       => $mostrar_up_down,
                'mostrar_tiempo_con'    => $mostrar_tiempo_con,
                'mostrar_status'        => $mostrar_status
             ]);
        }else{
            DB::table('hotspot_bienvenida')
             ->where('codigo',1)
             ->update([
                'mostrar_ip'            => $mostrar_ip,
                'mostrar_mac'           => $mostrar_mac,
                'mostrar_up_down'       => $mostrar_up_down,
                'mostrar_tiempo_con'    => $mostrar_tiempo_con,
                'mostrar_status'        => $mostrar_status
             ]);
        }

              
            
        $datos = DB::table('hotspot_bienvenida')->where('codigo',1)->get();
        $collection = Collection::make($datos);
                
        return response()->json($collection->toJson());   
    }

    //-----------PAGINA DE CIERRE DE SESIÓM----------------
    public function logout()
    {
        $logout = DB::table('hotspot_logout')->where('codigo',1)->get();

        return view('hotspot.logout2',[
            'logout'    => $logout
        ]);
    }

    public function mntLogout()
    {
        $logout = DB::table('hotspot_logout')->get();

        return view('forms.hotspot.mntLogout',[
            'logout'    => $logout
        ]);
    }

    public function addLogout(Request $request)
    { 
        //dd($request);
        if (!$user = DB::table('hotspot_logout')->where('codigo', 1)->first()) { 
            DB::table('hotspot_logout')
             ->insert([
                'idempresa'             => '001',
                'codigo'                => 1,
                'color_fondo'           => $request->color_fondo,
                'color_btn_iniciar'     => $request->color_btn_iniciar
             ]);
        }else{
            DB::table('hotspot_logout')
             ->where('codigo',1)
             ->update([
                'color_fondo'           => $request->color_fondo,
                'color_btn_iniciar'     => $request->color_btn_iniciar
             ]);
        }

              
            
        $datos = DB::table('hotspot_logout')->where('codigo',1)->get();
        $collection = Collection::make($datos);
                
        return response()->json($collection->toJson());   
    }

    public function addParametrosLogout(Request $request)
    { 
        //dd($request);
        $mostrar_ip = 0;
        $mostrar_mac = 0;
        $mostrar_up_down = 0;
        $mostrar_tiempo_con = 0;

        if(!empty($request->mostrar_ip)){
            $mostrar_ip = 1;
        }
        if(!empty($request->mostrar_mac)){
            $mostrar_mac = 1;
        }
        if(!empty($request->mostrar_up_down)){
            $mostrar_up_down = 1;
        }
        if(!empty($request->mostrar_tiempo_con)){
            $mostrar_tiempo_con = 1;
        }

        if (!$user = DB::table('hotspot_logout')->where('codigo', 1)->first()) { 
            DB::table('hotspot_logout')
             ->insert([
                'idempresa'             => '001',
                'codigo'                => 1,
                'mostrar_ip'            => $mostrar_ip,
                'mostrar_mac'           => $mostrar_mac,
                'mostrar_up_down'       => $mostrar_up_down,
                'mostrar_tiempo_con'    => $mostrar_tiempo_con
             ]);
        }else{
            DB::table('hotspot_logout')
             ->where('codigo',1)
             ->update([
                'mostrar_ip'            => $mostrar_ip,
                'mostrar_mac'           => $mostrar_mac,
                'mostrar_up_down'       => $mostrar_up_down,
                'mostrar_tiempo_con'    => $mostrar_tiempo_con
             ]);
        }

              
            
        $datos = DB::table('hotspot_logout')->where('codigo',1)->get();
        $collection = Collection::make($datos);
                
        return response()->json($collection->toJson());   
    }

    //-----------PAGINA DE LA PUBLICIDAD----------------
    public function publicidad()
    {
        return view('hotspot.publicidad2');
    }

    public function lstPublicidad()
    {
        $valida = 0;

        //-- Validación para mostrar mensajes al realizar un CRUD
        $validacion = DB::table('validacion')
                        ->select('valor')
                        ->where('idusuario',Auth::user()->id)->get();

        foreach ($validacion as $val) {
            $valida = $val->valor;
        }
        if ($valida > 0) {
            DB::table('validacion')
            ->where('idusuario',strval(Auth::user()->id))
            ->update(['valor' => 0]);
        }

        $publicidad = DB::table('hotspot_publicidad')->get();

        return view('forms.hotspot.lstPublicidad',[
            'publicidad'    => $publicidad,
            'valida'        => $valida
        ]);
    }

    public function create()
    {
        return view('forms.hotspot.mntPublicidad',[
            
        ]);
    }

    public function mntPublicidad()
    {
        $publicidad = DB::table('hotspot_publicidad')->get();

        return view('forms.hotspot.mntPublicidad',[
            'publicidad'    => $publicidad
        ]);
    }

    //-----------PAGINA DE INICIO----------------
    public function inicio()
    {
        $carrusel = DB::table('carrusel')->where([
            'estado'        => 1,
            'app'           => 'INNOVAWIFI'
        ])->get();

        $parametros = DB::table('parametros')
            ->where([
                'idempresa'         => '001',
                'tipo_parametro'    => 'HOTSPOT',
                'estado'            => 1
            ])->get();

        return view('hotspot.index2',[
            'carrusel'      => $carrusel,
            'parametros'    => $parametros
        ]);
    }

    //-----------VALIDAR USUARIO (RECURRENCIA Y ACCESO POR DIA)----------------
    public function validar(Request $request)
    {
        //dd($request);
        $fecha_actual = new \DateTime();
        $fecha_actual = date_format($fecha_actual,'d/m/Y');
        $ultima_conn = null;
        $bandera = 0;
        $limite = 1;


        
        //$usuario = DB::table('usuarios_hotspot')->where('codigo',$request->idcliente)->get();
        $recurrencia = DB::table('historial_recurrencia')->where('idcliente',$request->idcliente)->get();
        $parametros = DB::table('parametros')->where('tipo_parametro','HOTSPOT_EXTERNO')->get();

        foreach ($parametros as $val) {
            if ($val->parametro == 'TIEMPO_LIMITE') {
                $limite = $val->valor_long;
            }
        }
        
        foreach ($recurrencia as $val) {
            $ultima_conn = date_format(date_create($val->fecha_ingreso),'d/m/Y');
            if ($fecha_actual == $ultima_conn) {
                $bandera = $bandera + 1;
                //break;
            }
        }   

        if ($bandera == $limite) {
            return response()->json('BLOQUEADO');
        }

        

        //--------------------Registrar Descarga y Subida--------------------------    
        $router = DB::table('router')->where('activo',1)->get();
            
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
        $down = 0;
        $up = 0;
        $tdow = 0;
        $tup = 0;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $cliente = DB::table('usuarios_hotspot')->where('codigo',$request->idcliente)->get();
                $nombre = null;
                $correo = null;

                foreach ($cliente as $val) {
                    $email = $val->email;
                    $tdown = $val->descarga;
                    $tup = $val->subida;
                }


                $ARRAY = $API->comm("/ip/hotspot/user/print");     
                           
                foreach ($ARRAY as $value) {
                    if ($value['name'] == trim($email)) {
                        $down = $value['bytes-out'];
                        $up = $value['bytes-in'];                                                      
                    }
                }               
            }
        }

        if ($down >= $tdown) {
            $tdown = $down;
        }else{
            $tdown = $tdown + $down;
        }

        if ($up >= $tup) {
            $tup = $up;
        }else{
            $tup = $tup + $up;
        }

        DB::table('usuarios_hotspot')
        ->where('codigo',$request->idcliente)
        ->update([
            'concurrencia'      => count($recurrencia)+1,
            'descarga'          => $tdown,
            'subida'            => $tup
        ]);

        DB::table('historial_recurrencia')
        ->insert([
            'idempresa'           => '001',
            'idcliente'           => $request->idcliente,
            'ip'                  => $request->ip,
            'mac'                 => $request->mac,
            'fecha_ingreso'       => date('Y-m-d h:m:s')
        ]); 

   

        return response()->json('ACCEDER');
    }

}
