<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;



class RouterController extends Controller
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

        $router = DB::table('router')->get();
        $tipo = DB::table('tipo_acceso')->get();

        return view('forms.router.lstRouter', [
                    'router'    => $router,
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

        DB::table('router')
        ->insert([
            'idempresa'     => "001",
            'activo'        => 1,
            'idrouter'      => $request->idrouter,
            'alias'         => $request->alias,
            'ip'            => $request->ip,
            'usuario'       => $request->usuario,
            'password'      => $request->password,
            'puerto'        => (empty($request->puerto))? 9728 : $request->puerto,
            'fecha_creacion' => date('Y-m-d')
        ]);

        
        return redirect('/router');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $router = DB::table('router')
                    ->where('idrouter',$id)->get();

        $tipo = DB::table('tipo_acceso')->get();

        return view('forms.router.frmRouter', [
            'router'    => $router,
            'tipo'      => $tipo
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
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        if (count($validacion) > 0) {           
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 2]);  
        }

        DB::table('router')
        ->where('idrouter',strval($request->idrouter))
        ->update([
            'alias'         => $request->alias,
            'ip'            => $request->ip,
            'usuario'       => $request->usuario,
            'password'      => $request->password,
            'puerto'        => (empty($request->puerto))? 9728 : $request->puerto
        ]);

        return redirect('/router');
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

        DB::table('router')
            ->where('idrouter',$id)->delete();

        return redirect('/router');
    }

    public function prueba(){
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

            dd($ARRAY);
        }
   
    }
}
