<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use Illuminate\Support\Collection as Collection;
use Carbon\Carbon;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idcliente)
    {
        $idemisor = null;
        $idreceptor = null;

        $modo = DB::table('modo_equipo')->where('estado',1)->get();
        foreach ($modo as $value) {
            if($value->es_emisor == 1)
                $idemisor = $value->idmodo;
            if($value->es_cliente == 1)
                $idreceptor = $value->idmodo;
        }

        $servicio = DB::table('servicio_internet')->get();
        $router = DB::table('router')->get();
        $tipo = DB::table('tipo_acceso')->get();
        $queues = DB::table('queues')->get();
        $eqemisor = DB::table('equipos')->where('idmodo',$idemisor)->get();
        $eqreceptor = DB::table('equipos')->where('idmodo',$idreceptor)->get();
        $perfiles = DB::table('perfiles')->get();

        return view('forms.servicio.mntServicio', [
                    'servicio'   => $servicio,
                    'router'     => $router,
                    'tipo'       => $tipo,
                    'queues'     => $queues,
                    'eqemisor'   => $eqemisor,
                    'eqreceptor' => $eqreceptor,
                    'idcliente'  => $idcliente,
                    'perfiles'   => $perfiles
                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(            
            'idrouter'          => 'required',
            'tipo_acceso'       => 'required',
            'perfil_internet'   => 'required',
            'precio'            => 'required',
            'dia_pago'          => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('servicio_internet')
            ->insert([
                'idempresa'         => '001',
                'estado'            => 1,
                'idrouter'          => $request->idrouter,
                'tipo_acceso'       => $request->tipo_acceso,
                'perfil_internet'   => $request->perfil_internet,
                'usuario_cliente'   => $request->usuario_cliente,
                'contrasena_cliente' => $request->contrasena_cliente,
                'direccion'         => $request->direccion,
                'coordenadas'       => $request->coordenadas,
                'ip'                => $request->ip,
                'mac'               => $request->mac,
                'fecha_instalacion' => Carbon::createFromFormat('d/m/Y', $request->fecha_instalacion),
                'dia_pago'          => $request->dia_pago,
                'precio'            => $request->precio,
                'emisor_conectado'  => $request->emisor_conectado,
                'equipo_receptor'   => $request->equipo_receptor,
                'ip_receptor'       => $request->ip_receptor,
                'usuario_receptor'  => $request->usuario_receptor,
                'contrasena_receptor'   => $request->contrasena_receptor, 
                'glosa'             => $request->glosa,               
                'fecha_creacion'    => date('Y-m-d h:m:s'),
                'idcliente'         => $request->idcliente
            ]);

            $servicio = DB::table('servicio_internet')->where('idcliente',$request->idcliente)->get();
            $idcliente = null;
            $fecha = Carbon::now();            
            $fecha->day = $request->dia_pago;
            $fecha_fin = Carbon::now();            
            $fecha_fin->day = $request->dia_pago - 1;
            $fecha_fin->addMonth();

            foreach ($servicio as $value) {
                $idcliente = $value->idcliente;

                DB::table('notificaciones')
                ->insert([
                    'idempresa'         => '001',
                    'aviso'             => 0,
                    'corte'             => 0,
                    'frecuencia'        => 0,
                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'idservicio'        => $value->idservicio,
                    'fecha_inicio'      => $fecha->format('Y-m-d'),
                    'fecha_fin'         => $fecha_fin->format('Y-m-d')
                ]);
            }
            DB::table('clientes')->where('idcliente',$idcliente)
            ->update(['dia_pago' => $request->dia_pago]);

            $idusu = Auth::user()->id;
            $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

            if (count($validacion) > 0) {           
                DB::table('validacion')
                ->where('idusuario',strval($idusu))
                ->update(['valor' => 1]);  
            }

            $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
        
            $API = new routeros_api();
            $API->debug = false;
            $ARRAY = null;

            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $perfil = DB::table('perfiles')->where('idperfil',$request->perfil_internet)->get();

                    foreach ($perfil as $val) {                    

                        if( trim($request->tipo_acceso) == "HST" ){     
                            $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                "name"      => $request->usuario_cliente,
                                "password"  => $request->contrasena_cliente,  
                                "profile"   => $val->hotspot_perfil,  
                                "server"    => 'hotspot1'
                            ));  
                        }else if(trim($request->tipo_acceso) == "QUE"){
                            $ARRAY = $API->comm("/queue/simple/add", array(
                                "name"      => $request->usuario_cliente,
                                "target"    => $request->ip,  
                                "max-limit" => $val->target  
                            )); 
                        }else if(trim($request->tipo_acceso) == "PPP"){
                            $ARRAY = $API->comm("/ppp/secret/add", array(
                                "name"      => $request->usuario_cliente,
                                "password"  => $request->contrasena_cliente,
                                "service"   => 'pppoe',
                                "profile"   => $val->perfil_pppoe  
                            ));  
                        }
                    }
                
                }       
            }

            $servicios = DB::table('vw_servicio_internet')->get();


           
            $collection = Collection::make($servicios);
            
            return response()->json($collection->toJson());        
        }         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idemisor = null;
        $idreceptor = null;

        $modo = DB::table('modo_equipo')->where('estado',1)->get();
        foreach ($modo as $value) {
            if($value->es_emisor == 1)
                $idemisor = $value->idmodo;
            if($value->es_cliente == 1)
                $idreceptor = $value->idmodo;
        }
        
        $servicio = DB::table('servicio_internet')
                    ->where('idservicio',$id)->get();
        $router = DB::table('router')->get();
        $tipo = DB::table('tipo_acceso')->get();
        $queues = DB::table('queues')->get();
        $eqemisor = DB::table('equipos')->where('idmodo',$idemisor)->get();
        $eqreceptor = DB::table('equipos')->where('idmodo',$idreceptor)->get();
        $perfiles = DB::table('perfiles')->get();

         return view('forms.servicio.updServicio', [
                    'servicio'   => $servicio,
                    'router'     => $router,
                    'tipo'       => $tipo,
                    'queues'     => $queues,
                    'eqemisor'   => $eqemisor,
                    'eqreceptor' => $eqreceptor,
                    'perfiles'   => $perfiles
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(            
            'idrouter'          => 'required',
            'tipo_acceso'       => 'required',
            'perfil_internet'   => 'required',
            'precio'            => 'required',
            'dia_pago'          => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('servicio_internet')
            ->where('idservicio',$request->idservicio)
            ->update([      
                'idrouter'          => $request->idrouter,
                'tipo_acceso'       => $request->tipo_acceso,
                'perfil_internet'   => $request->perfil_internet,
                'usuario_cliente'   => $request->usuario_cliente,
                'contrasena_cliente' => $request->contrasena_cliente,
                'direccion'         => $request->direccion,
                'coordenadas'       => $request->coordenadas,
                'ip'                => $request->ip,
                'mac'               => $request->mac,
                'dia_pago'          => $request->dia_pago,
                'precio'            => $request->precio,
                'fecha_instalacion' => Carbon::createFromFormat('d/m/Y', $request->fecha_instalacion),
                'emisor_conectado'  => $request->emisor_conectado,
                'equipo_receptor'   => $request->equipo_receptor,
                'ip_receptor'       => $request->ip_receptor,
                'usuario_receptor'  => $request->usuario_receptor,
                'contrasena_receptor'   => $request->contrasena_receptor, 
                'glosa'             => $request->glosa
            ]);

            $servicio = DB::table('servicio_internet')->where('idservicio',$request->idservicio)->get();
            $idcliente = null;
            foreach ($servicio as $value) {
                $idcliente = $value->idcliente;
            }
            DB::table('clientes')->where('idcliente',$idcliente)
            ->update(['dia_pago' => $request->dia_pago]);

            $idusu = Auth::user()->id;
            $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

            if (count($validacion) > 0) {           
                DB::table('validacion')
                ->where('idusuario',strval($idusu))
                ->update(['valor' => 2]);  
            }

            $servicios = DB::table('vw_servicio_internet')->get();
            $collection = Collection::make($servicios);
            
            return response()->json($collection->toJson());        
        }         
    }

    public function updateNotificaciones(Request $request)
    {
        $dia_pago = Carbon::now()->addMonth()->day($request->dia_pago);
        $fecha_aviso = Carbon::now()->addMonth()->day($request->dia_pago)->subDays($request->aviso);
        $fecha_corte = Carbon::now()->addMonth()->day($request->dia_pago)->addDays($request->corte);
        $fecha_frecuencia = Carbon::now()->day($request->dia_pago)->addMonths($request->frecuencia+1);   

        DB::table('notificaciones')
            ->where('codigo',$request->codigo)
            ->update([
                'aviso'         => $request->aviso,
                'corte'         => $request->corte,
                'frecuencia'    => $request->frecuencia,
                'fecha_pago'    => $dia_pago,
                'fecha_aviso'   => $fecha_aviso,
                'fecha_corte'   => $fecha_corte,
                'fecha_frecuencia'   => $fecha_frecuencia
            ]);            
                
        return response()->json(['estado' => 'correcto']);          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        if (count($validacion) === 0) {
            DB::table('validacion')
            ->insert([
                'idusuario' => $idusu,
                'valor'     => 3
            ]);
        }else{
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 3]);
            
        }

        DB::table('servicio_internet')
            ->where('idservicio',$id)->delete();

        DB::table('notificaciones')
            ->where('idservicio',$id)->delete();

        return redirect('/clientes');
    }
}
