<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class QueuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        //-- Validación para mostrar mensajes al realizar un CRUD
        if (count($validacion) === 0) {
            DB::table('validacion')
            ->insert([
                'idusuario' => $idusu,
                'valor'     => 0
            ]);
        }else{
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 0]);
            
        }

        foreach ($validacion as $val) {
            $valida = $val->valor;
        }
        if ($valida > 0) {
            DB::table('validacion')
            ->where('idusuario',strval(Auth::user()->id))
            ->update(['valor' => 0]);
        }
        //--

        $queues = DB::table('queues')->get();

        return view('forms.queues.queues', [
                    'queues'    => $queues,
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
        $router = DB::table('router')->get();

        return view('forms.queues.mntQueues', ['router' => $router]);
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

        DB::table('queues')
        ->insert([
            'idempresa'         => "001",
            'estado'            => 1,
            'idrouter'          => $request->idrouter,
            'nombre'            => $request->nombre,
            'vsubida'           => $request->vsubida,
            'vbajada'           => $request->vbajada,  
            'target'            => 0, //No cambia nada, por definir este campo
            'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);

        
        return redirect('/queues');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
