<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class EmpresaController extends Controller
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

        $empresa = DB::table('empresa')->get();

        return view('forms.empresa.lstEmpresa', [
                    'empresa'   => $empresa,
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
       return view('forms.empresa.mntEmpresa');
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

        DB::table('empresa')
        ->insert([
            'idempresa'         => $request->idempresa,
            'estado'            => 1,
            'nombre'            => $request->razon_social,
            'direccion'         => $request->direccion,
            'RUC'               => $request->RUC,
            'referencia'        => $request->refrencia,
            'DNI1'              => $request->DNI1,
            'representante1'    => $request->representante1,
            'DNI2'              => $request->DNI2,
            'representante2'    => $request->representante2,
            'razon_social'      => $request->razon_social,
            'telefono'          => $request->telefono,
            'documento1'        => $request->documento1,
            'documento2'        =>  $request->documento2,
            'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);

        
        return redirect('/empresa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = DB::table('empresa')
                    ->where('idempresa',$id)->get();

        return view('forms.empresa.edtEmpresa',['empresa' => $empresa]);
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

        DB::table('empresa')
        ->where('idempresa',strval($request->idempresa))
        ->update([
            'direccion'         => $request->direccion,
            'RUC'               => $request->RUC,
            'referencia'        => $request->refrencia,
            'DNI1'              => $request->DNI1,
            'representante1'    => $request->representante1,
            'DNI2'              => $request->DNI2,
            'representante2'    => $request->representante2,
            'razon_social'      => $request->razon_social,
            'telefono'          => $request->telefono,
            'documento1'        => $request->documento1,
            'documento2'        =>  $request->documento2        
        ]);

        return redirect('/empresa');
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

        DB::table('empresa')
            ->where('idempresa',$id)->delete();

        return redirect('/empresa');
    }
}
