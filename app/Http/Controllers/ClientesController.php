<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class ClientesController extends Controller
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

        $clientes = DB::table('clientes')->get();

        return view('forms.clientes.lstClientes', [
                    'clientes'   => $clientes,
                    'valida'     => $valida
                ]);
    }

    public function cliente($id)
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

        $clientes = DB::table('clientes')
                    ->where('idcliente',$id)->get();        
        $servicio = DB::table('servicio_internet')
                    ->where('idcliente',$id)->get();
        $router = DB::table('router')->get();
        $tipo = DB::table('tipo_acceso')->get();
        $queues = DB::table('queues')->get();
        $eqemisor = DB::table('equipos')->where(['idmodo' => 2, 'estado' => 1])->get();
        $eqreceptor = DB::table('equipos')->where(['idmodo' => 3, 'estado' => 1])->get();
        $perfiles = DB::table('perfiles')->get();
        $comprobantes = DB::table('factura')
                    ->where('idcliente',$id)->get();    


        $idservicio = null;
        foreach ($servicio as $serv) {
            $idservicio = $serv->idservicio;
        }

        $notificaciones = DB::table('notificaciones')
                    ->where('idservicio',$idservicio)->get();

        return view('forms.clientes.clientes', [
                    'clientes'   => $clientes,
                    'servicio'   => $servicio,
                    'router'     => $router,
                    'tipo'       => $tipo,
                    'queues'     => $queues,
                    'eqemisor'   => $eqemisor,
                    'eqreceptor' => $eqreceptor,
                    'notificaciones' => $notificaciones,
                    'perfiles'   => $perfiles,
                    'comprobantes' => $comprobantes,
                    'valida'     => $valida
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.clientes.mntClientes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        if (count($validacion) === 0) {
            DB::table('validacion')
            ->insert([
                'idusuario' => $idusu,
                'valor'     => 1
            ]);
        }else{
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 1]);
            
        }

        DB::table('clientes')
        ->insert([
            'idempresa'         => "001",
            'estado'            => 1,
            'idcliente'         => $request->nro_documento,
            'apaterno'          => $request->apaterno,
            'amaterno'          => $request->amaterno,
            'nombres'           => $request->nombres,
            'documento'         => $request->documento,
            'nro_documento'     => $request->nro_documento,
            'direccion'         => $request->direccion,
            'correo'            => $request->correo,
            'telefono1'         => $request->telefono1,
            'telefono2'         => $request->telefono2,
            'forma_pago'        => (empty($request->forma_pago))? null : $request->forma_pago,
            'doc_venta'         => (empty($request->doc_venta))? null : $request->doc_venta,
            'moneda'            => (empty($request->moneda))? null : $request->moneda,
            'dia_pago'          => (empty($request->dia_pago))? null : $request->dia_pago,
            'contacto'          => (empty($request->contacto))? null : $request->contacto,
            'idpersonal'        => Auth::user()->id,
            'razon_social'      => $request->apaterno.' '.$request->amaterno.' '.$request->nombres,
            'glosa'             => (empty($request->glosa))? null : $request->glosa,
            'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);

        
        return redirect('/clientes');
    }

    public function storeServicio(Request $request)
    {    
        $rules = array(            
            'idrouter'          => 'required',
            'tipo_acceso'       => 'required',
            'perfil_internet'   => 'required',
            'emisor_conectado'  => 'required'
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
                'fecha_instalacion' => date('Y-m-d'),
                'dia_pago'          => $request->dia_pago,
                'precio'            => $request->precio,
                'emisor_conectado'  => $request->emisor_conectado,
                'equipo_receptor'   => $request->equipo_receptor,
                'ip_receptor'       => $request->ip_receptor,
                'usuario_receptor'  => $request->usuario_receptor,
                'contrasena_receptor'   => $request->contrasena_receptor, 
                'glosa'             => $request->glosa,               
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

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
        $clientes = DB::table('clientes')
                    ->where('idcliente',$id)->get();

        return view('forms.clientes.edtClientes',['clientes' => $clientes]);
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
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        if (count($validacion) > 0) {           
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 2]);  
        }

        DB::table('clientes')
        ->where('idcliente',strval($request->idcliente))
        ->update([
            'apaterno'          => $request->apaterno,
            'amaterno'          => $request->amaterno,
            'nombres'           => $request->nombres,
            'documento'         => $request->documento,
            'nro_documento'     => $request->nro_documento,
            'direccion'         => $request->direccion,
            'correo'            => $request->correo,
            'telefono1'         => $request->telefono1,
            'telefono2'         => $request->telefono2,
            'forma_pago'        => (empty($request->forma_pago))? null : $request->forma_pago,
            'doc_venta'         => (empty($request->doc_venta))? null : $request->doc_venta,
            'moneda'            => (empty($request->moneda))? null : $request->moneda,
            'dia_pago'          => (empty($request->dia_pago))? null : $request->dia_pago,
            'contacto'          => (empty($request->contacto))? null : $request->contacto,
            'idpersonal'        => Auth::user()->id,
            'razon_social'      => $request->apaterno.' '.$request->amaterno.' '.$request->nombres,
            'glosa'             => (empty($request->glosa))? null : $request->glosa     
        ]);

        return redirect('/clientes');
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

        DB::table('clientes')
            ->where('idcliente',$id)->delete();

        return redirect('/clientes');
    }

    public function showHerramientas(){

        return view('forms.herramientas.frmHerramientas');
    }
}
