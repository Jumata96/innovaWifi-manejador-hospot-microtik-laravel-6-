<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class PerfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        //--

        $perfiles   = DB::table('perfiles')->get();
        $queues     = DB::table('perfiles')->where('idtipo','QUE')->get();
        $hotspot    = DB::table('perfiles')->where('idtipo','HST')->get();
        $router     = DB::table('router')->get();
        $pppoe      = DB::table('perfiles')->where('idtipo','PPP')->get();

        return view('forms.perfiles.hotspot', [
                    'perfiles'   => $perfiles,
                    'valida'     => $valida,
                    'router'     => $router,
                    'queues'     => $queues,
                    'hotspot'    => $hotspot,
                    'pppoe'      => $pppoe
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'              => 'required',
            'precio'            => 'required',
            'vsubida'           => 'required',
            'vbajada'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('perfiles')
            ->insert([
                'idempresa'         => '001',
                'estado'            => 1,
                'idrouter'          => $request->idrouter,
                'name'              => $request->name,
                'precio'            => $request->precio,
                'vsubida'           => $request->vsubida,
                'vbajada'           => $request->vbajada,
                'target'            => $request->vsubida.'/'.$request->vbajada,
                'glosa'             => $request->glosa,  
                'idtipo'            => 'QUE',        
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            
            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
            
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
        //
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
            'name'              => 'required',
            'precio'            => 'required',
            'vsubida'           => 'required',
            'vbajada'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('perfiles')
            ->where('idperfil',$request->idperfil)
            ->update([
                'idrouter'          => $request->idrouter,
                'name'              => $request->name,
                'precio'            => $request->precio,
                'vsubida'           => $request->vsubida,
                'vbajada'           => $request->vbajada,
                'target'            => $request->vsubida.'/'.$request->vbajada,
                'glosa'             => (empty($request->glosa))? null : $request->glosa     
            ]);

            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
                
            return response()->json($collection->toJson());   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('perfiles')
            ->where('idperfil',$request->idperfil)->delete();

        return response()->json();
    }

    public function disabled(Request $request)
    {
        DB::table('perfiles')
            ->where('idperfil',$request->idperfil)
            ->update([
                'estado'    => 0
            ]);

        $perfiles = DB::table('perfiles')->where('idperfil',$request->idperfil)->get();
        $collection = Collection::make($perfiles);
                
        return response()->json($collection->toJson());   
    }

    public function habilitar(Request $request)
    {
        DB::table('perfiles')
            ->where('idperfil',$request->idperfil)
            ->update([
                'estado'    => 1
            ]);

        $perfiles = DB::table('perfiles')->where('idperfil',$request->idperfil)->get();
        $collection = Collection::make($perfiles);
                
        return response()->json($collection->toJson());   
    }

    


    //-----------------------------------------------HOTSPOT------------------------------------------------------------------------------------

    public function getPerfil(Request $request)
    {
        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
                $collection = Collection::make($ARRAY);
            
            }       
        }
                
        return response()->json($ARRAY);   
    }

    public function storeHotspot(Request $request)
    {
         $rules = array(            
            'idrouter'          => 'required',
            'name'              => 'required',
            'precio'            => 'required',
            'perfil'            => 'required',
            'vsubida'           => 'required',
            'vbajada'           => 'required',
            'perfil'            => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('perfiles')
            ->insert([
                'idempresa'         => '001',
                'estado'            => 1,
                'idrouter'          => $request->idrouter,
                'name'              => $request->name,
                'precio'            => $request->precio,
                'hotspot_perfil'    => ($request->perfil == '0')? ((empty($request->dsc_perfil))? $request->name : $request->dsc_perfil):$request->perfil,
                'dsc_perfil'        => (empty($request->dsc_perfil))? ( ($request->perfil == '0')?$request->name:$request->perfil ) : $request->dsc_perfil,
                'vsubida'           => $request->vsubida,
                'vbajada'           => $request->vbajada,
                'rate_limit'        => $request->vsubida.'/'.$request->vbajada,
                'glosa'             => $request->glosa,  
                'shared_users'       => '3',
                'idle_timeout'      => 'none',
                'keepalive_timeout' => '2m',
                'status_autorefresh' => '1m',
                'idtipo'            => 'HST',        
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            if ($request->perfil == '0') {
                
                $API = new routeros_api();
                $API->debug = false;
                $ARRAY = null;

                $router = DB::table('router')->where('idrouter',$request->idrouter)->get();

                foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $ARRAY = $API->comm("/ip/hotspot/user/profile/add", array(
                                    "name" => (empty(trim($request->dsc_perfil)))? $request->name : $request->dsc_perfil,
                                //  "session-timeout" => $session,                                    
                                    "idle-timeout" => 'none',
                                    "keepalive-timeout" => '2m',
                                    "status-autorefresh" => '1m',
                                    "shared-users" => '1',
                                    "rate-limit" => $request->vsubida.'/'.$request->vbajada,
                                //  "address-list" => $list,
                                    "on-login" => $request->name
                                ));   
                    
                    }       
                }

            }
           
            
            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
            
            return response()->json($collection->toJson());        
        }         
            
    }

    public function updateHotspot(Request $request)
    {
         $rules = array(      
            'idrouter'          => 'required',
            'name'              => 'required',
            'perfil'            => 'required',
            'precio'            => 'required',
            'vsubida'           => 'required',
            'vbajada'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('perfiles')
            ->where('idperfil',$request->idperfil)
            ->update([
                'idrouter'          => $request->idrouter,
                'name'              => $request->name,
                'precio'            => $request->precio,
                'hotspot_perfil'    => ($request->perfil == '0')? ((empty($request->dsc_perfil))? $request->name : $request->dsc_perfil):$request->perfil,
                'dsc_perfil'        => (empty($request->dsc_perfil))? ( ($request->perfil == '0')?$request->name:$request->perfil ) : $request->dsc_perfil,
                'vsubida'           => $request->vsubida,
                'vbajada'           => $request->vbajada,
                'rate_limit'        => $request->vsubida.'/'.$request->vbajada,
                'glosa'             => (empty($request->glosa))? null : $request->glosa     
            ]);

            if ($request->perfil == '0') {
                
                $API = new routeros_api();
                $API->debug = false;
                $ARRAY = null;

                $router = DB::table('router')->where('idrouter',$request->idrouter)->get();

                foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                    $ARRAY = $API->comm("/ip/hotspot/user/profile/add", array(
                                    "name" => (empty(trim($request->dsc_perfil)))? $request->name : $request->dsc_perfil,
                                //  "session-timeout" => $session,                                    
                                    "idle-timeout" => 'none',
                                    "keepalive-timeout" => '2m',
                                    "status-autorefresh" => '1m',
                                    "shared-users" => '1',
                                    "rate-limit" => $request->vsubida.'/'.$request->vbajada,
                                //  "address-list" => $list,
                                    "on-login" => $request->name
                                ));                       
                    }       
                }
            }

            $perfiles = DB::table('perfiles')->where('idperfil',$request->idperfil)->get();
            $collection = Collection::make($perfiles);
                
            return response()->json($collection->toJson());   
        }
    }

    //----------------------------------------MANTENEDOR PPPoE-----------------------------------------------------------
    public function getPerfilPPPoE(Request $request)
    {
        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();
        
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $ARRAY = $API->comm("/ppp/profile/print");
                $collection = Collection::make($ARRAY);
            
            }       
        }
                
        return response()->json($ARRAY);   
    }

    public function storePPPoE(Request $request)
    {
         $rules = array(            
            'idrouter'          => 'required',
            'name'              => 'required',
            'precio'            => 'required',
            'perfil'            => 'required',
            'vsubida'           => 'required',
            'vbajada'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('perfiles')
            ->insert([
                'idempresa'         => '001',
                'estado'            => 1,
                'idrouter'          => $request->idrouter,
                'name'              => $request->name,
                'precio'            => $request->precio,
                'perfil_pppoe'      => ($request->perfil == '0')? ((empty($request->dsc_perfil))? $request->name : $request->dsc_perfil):$request->perfil,
                'dsc_perfil'        => (empty($request->dsc_perfil))? ( ($request->perfil == '0')?$request->name:$request->perfil ) : $request->dsc_perfil,
                'remote_address'    => (empty($request->remote_address)? null : $request->remote_address),
                'local_address'     => (empty($request->local_address)? null : $request->local_address),
                'vsubida'           => $request->vsubida,
                'vbajada'           => $request->vbajada,
                'rate_limit'        => $request->vsubida.'/'.$request->vbajada,
                'glosa'             => $request->glosa,  
                'shared_users'      => '3',
                'idle_timeout'      => 'none',
                'keepalive_timeout' => '2m',
                'status_autorefresh' => '1m',
                'idtipo'            => 'PPP',        
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            if ($request->perfil == '0') {
                
                $API = new routeros_api();
                $API->debug = false;
                $ARRAY = null;

                $router = DB::table('router')->where('idrouter',$request->idrouter)->get();

                foreach ($router as $rou) {
                    if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                        $ARRAY = $API->comm("/ppp/profile/add", array(
                            "name" => (empty(trim($request->dsc_perfil)))? $request->name : $request->dsc_perfil,
                            "local-address" => $request->local_address,
                            "remote-address" => $request->remote_address,
                            "rate-limit" => $request->vsubida.'/'.$request->vbajada,
                        ));             
                    }                    
                }
            }

          
            $perfiles = DB::table('perfiles')->where('name',$request->name)->get();
            $collection = Collection::make($perfiles);
            
            return response()->json($collection->toJson());        
        }         
            
    }

    public function updatePPPoE(Request $request)
    {
         $rules = array(      
            'idrouter'          => 'required',
            'name'              => 'required',
            'perfil'            => 'required',
            'precio'            => 'required',
            'vsubida'           => 'required',
            'vbajada'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            DB::table('perfiles')
            ->where('idperfil',$request->idperfil)
            ->update([
                'idrouter'          => $request->idrouter,
                'name'              => $request->name,
                'precio'            => $request->precio,
                'hotspot_perfil'    => ($request->perfil == '0')? ((empty($request->dsc_perfil))? $request->name : $request->dsc_perfil):$request->perfil,
                'dsc_perfil'        => (empty($request->dsc_perfil))? ( ($request->perfil == '0')?$request->name:$request->perfil ) : $request->dsc_perfil,
                'remote_address'    => (empty($request->remote_address)? null : $request->remote_address),
                'local_address'     => (empty($request->local_address)? null : $request->local_address),
                'vsubida'           => $request->vsubida,
                'vbajada'           => $request->vbajada,
                'rate_limit'        => $request->vsubida.'/'.$request->vbajada,
                'glosa'             => (empty($request->glosa))? null : $request->glosa     
            ]);

            if ($request->perfil == '0') {
                
                $API = new routeros_api();
                $API->debug = false;
                $ARRAY = null;

                $router = DB::table('router')->where('idrouter',$request->idrouter)->get();

                foreach ($router as $rou) {
                    if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                        $ARRAY = $API->comm("/ppp/profile/add", array(
                            "name" => (empty(trim($request->dsc_perfil)))? $request->name : $request->dsc_perfil,
                            "local-address" => $request->local_address,
                            "remote-address" => $request->remote_address,
                            "rate-limit" => $request->vsubida.'/'.$request->vbajada,
                        ));                                    
                    }       
                }
            }

            $perfiles = DB::table('perfiles')->where('idperfil',$request->idperfil)->get();
            $collection = Collection::make($perfiles);
                
            return response()->json($collection->toJson());   
        }
    }

    //------------------------------------IMPORTAR PERFIL HOTSPOT HACIA EL MIKROTIK--------------------------------------------------------
    public function guardarImportPerfil(Request $request)
    {
        //dd($request);
        $cont = $request->cont;
        $principal = 0;

        for ($i=0; $i <= $cont; $i++) { 
            $perfil = DB::table('perfiles')->where('name', $request['name'.$i])->get();

            if ( count($perfil) == 0 and !is_null($request['check'.$i])) { 
                
                if (isset($request['principal'.$i])) {
                    $principal = 1;
                }
                
                DB::table('perfiles')
                ->insert([
                    'idempresa'         => '001',
                    'estado'            => 1,
                    'es_principal'      => $principal,
                    'idrouter'          => $request->id_router,
                    'name'              => $request['name'.$i],
                    'precio'            => $request['precio'.$i],
                    'hotspot_perfil'    => $request['name'.$i],
                    'dsc_perfil'        => $request['name'.$i],
                    'vsubida'           => substr($request['target'.$i], 0, strpos($request['target'.$i], '/')),
                    'vbajada'           => substr($request['target'.$i], strpos($request['target'.$i], '/')+1, strlen($request['target'.$i])),
                    'rate_limit'        => $request['target'.$i],
                    'shared_users'       => '3',
                    'idle_timeout'      => 'none',
                    'keepalive_timeout' => '2m',
                    'status_autorefresh' => '1m',
                    'idtipo'            => 'HST',        
                    'fecha_creacion'    => date('Y-m-d h:m:s')
                ]);
                //dd($request['name'.$i]);
            }
            
        }

        $perfil = DB::table('perfiles')->where('name', $request['name'.$i])->get();
        
        return response()->json($perfil);   
    } 

    //------------------------------------IMPORTAR PERFILES DEL MIKROTIK--------------------------------------------------------
    public function importPerfil(Request $request)
    {
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        $router = DB::table('router')->where('idrouter',$request->idrouter)->get();

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                if ($request->idtipo == 'PPP') {
                    $ARRAY = $API->comm("/ppp/profile/print"); 
                }elseif ($request->idtipo == 'HST') {
                    $ARRAY = $API->comm("/ip/hotspot/user/profile/print");
                }elseif ($request->idtipo == 'PCQ') {
                    $ARRAY = $API->comm("/queue/type/print");
                    $ARRAY2 = $API->comm("/queue/tree/print");
                    $ARRAY3 = $API->comm("/ip/firewall/mangle/print");

                    for ($i=0; $i < count($ARRAY) ; $i++) { 
                        if ($ARRAY[$i]['kind'] == 'pcq') {
                            foreach ($ARRAY2 as $tree) {
                                
                                if ($tree["queue"] == $ARRAY[$i]['name']) {
                                    $ARRAY[$i]['name_tree'] = $tree['name'];
                                    $ARRAY[$i]['packet_mark'] = $tree['packet-mark'];
                                    $ARRAY[$i]['parent'] = $tree['parent'];
                                    $packet = $tree['packet-mark'];

                                    foreach ($ARRAY3 as $mangle) {
                                        //dd($mangle);
                                        if (isset($mangle["new-connection-mark"]) and $mangle["new-connection-mark"] == $packet and $mangle['action'] == "mark-connection") {
                                            $ARRAY[$i]['address_list'] = $mangle["src-address-list"];
                                        }
                                    }
                                }
                            }
                        }
                    }
                    for ($i=0; $i < count($ARRAY) ; $i++) { 
                        if ($ARRAY[$i]['kind'] != 'pcq') {
                            unset($ARRAY[$i]);
                        }
                    }
                }                       
                       
            }
        }

        //dd($ARRAY,$ARRAY2);
        return response()->json($ARRAY);   
    }    

}
