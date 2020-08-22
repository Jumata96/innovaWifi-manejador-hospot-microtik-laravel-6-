<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class SocialController extends Controller
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
        	->where([
        		'idempresa' 		=> '001',
        		'tipo_parametro'	=> 'HOTSPOT',
        		'estado'			=> 1
        	])->get();

        return view('forms.social.frmSocial', [
            'parametros'	=> $parametros,
        	'valida'     	=> $valida
		]);
    }

    public function update(Request $request)
    {
        
            DB::table('parametros')
            ->where('parametro',$request->parametro)
            ->update([
                'valor'       => $request->valor
            ]);            
                
            return response()->json(['estado' => 'correcto']);          
    }
}
