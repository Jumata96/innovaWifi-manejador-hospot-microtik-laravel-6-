<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class ParametrosController extends Controller
{
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

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['PPPOE','DASHBOARD'])
            ->where('estado',1)->get();

        return view('forms.parametros.frmParametros', [
            'parametros'	=> $parametros,
        	'valida'     	=> $valida
		]);
    }

    public function generales()
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

        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['HOTSPOT_EXTERNO','DASHBOARD'])
            ->where('estado',1)
            ->orderBy('tipo_parametro','desc')
            ->get();

        return view('forms.parametros.frmGenerales', [
            'parametros'    => $parametros,
            'valida'        => $valida
        ]);
    }

    

    
    public function update(Request $request)
    {
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['PPPOE','DASHBOARD'])
            ->where('estado',1)->get();

        foreach ($parametros as $value) {
            if ($value->campo_texto == 0) {
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor'     => $request[''.$value->parametro]
                ]);
            }else if($value->campo_texto == 1){
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor_long' => $request[''.$value->parametro]
                ]);
            }
        }
                
        return response()->json(['estado' => 'correcto']);          
    }

    public function updGenerales(Request $request)
    {
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['HOTSPOT_EXTERNO','DASHBOARD','REPORTES'])
            ->where('estado',1)->get();

        foreach ($parametros as $value) {
            if ($value->campo_texto == 0) {
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor'     => $request[''.$value->parametro]
                ]);
            }else if($value->campo_texto == 1){
                DB::table('parametros')
                ->where('parametro',$value->parametro)
                ->update([
                    'valor_long' => $request[''.$value->parametro]
                ]);
            }
        }
                
        return response()->json(['estado' => 'correcto']);          
    }

    public function reportes()
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

        $parametros = DB::table('parametros') 
            ->where([
                ['tipo_parametro','=','REPORTES'],
                ['estado','=',1]
            ]) 
            ->get();

        return view('forms.parametros.frmGenerales', [
            'parametros'    => $parametros,
            'valida'        => $valida
        ]);
    }

    
}
