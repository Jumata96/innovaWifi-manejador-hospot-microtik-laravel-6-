<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Carbon\Carbon;
use Validator;
use Auth;
use DB;
use App\User;

class RegistroController extends Controller
{
    public function index(Request $request)
    {
        //dd($request);
        $datos = Collection::make($request);
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['HOTSPOT_EXTERNO'])
            ->where('estado',1)->get();

    	return view('hotspot.registro',[
            'datos'         => $datos,
            'parametros'    => $parametros
        ]);
    }

    public function addRegistro(Request $request)
    {
    	//dd($request);
        $valor = null;
        $contra = null;
        $parametros = DB::table('parametros')
            ->whereIn('tipo_parametro',['HOTSPOT_EXTERNO'])
            ->where('estado',1)->get();

        foreach ($parametros as $value) {
            if ($value->parametro == 'REGISTRAR_CONTRASENA') {
                $valor = $value->valor;
            }        
        }

        if ($valor == 'SI') {
            $contra = $request->password;

            $rules = array(      
                'nombre'        => 'required|string|max:255',
                'apellidos'     => 'required|string|max:255',
                'email'         => 'required|string|email|max:255',
                'celular'       => 'required',
                'password'      => 'required|string|min:6|confirmed'
            );
        }else{
            $rules = array(      
                'nombre'        => 'required|string|max:255',
                'apellidos'     => 'required|string|max:255',
                'email'         => 'required|string|email|max:255',
                'celular'       => 'required'                
            );
        }

        

        $validator = Validator::make ( $request->all(), $rules);

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          

        if (!$user = DB::table('usuarios_hotspot')->where('email', $request->email)->first()) { 

        	$key = ''; 
	        $cont = 0;
	        $total = 0;
	        $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
	        $length = 10;
	        $max = strlen($caracteres) - 1;

	        for ($i=0;$i<$length;$i++) {
	            $key .= substr($caracteres, rand(0, $max), 1);
	        }
              
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = DB::table('usuarios_hotspot')
                ->insert([
                    'idempresa'         => '001',
                    'codigo'            => $key,
                    //'ip'                => $_SERVER["REMOTE_ADDR"],
                    'ip'                => $request->ip,
                    'mac'               => $request->mac,
                    'nombre'            => $request->nombre,
                    'apellidos'         => $request->apellidos,
                    'email'             => $request->email,
                    'celular'           => $request->celular,
                    'contrasena'		=> $contra,

                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'estado'            => 1
                ]);
        }else{
        	$var = $validator->getMessageBag()->toarray();
            array_push($var, 'BAD_CONTRA');
            return response()->json($var);
        }

        $user = DB::table('usuarios_hotspot')->where('email',$request->email)->get();

        $router = DB::table('router')->where('activo',1)->get();
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;
                 
            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                    
                    $perfil = DB::table('perfiles')->where([
                        'idrouter'          => $rou->idrouter,
                        'es_principal'      => 1
                    ])->get();
                    
                    foreach ($perfil as $val) {    

                    	foreach ($user as $datos) {
                            $nombre = $datos->nombre.' '.$datos->apellidos;

                    	 	$ARRAY = $API->comm("/ip/hotspot/user/add", array(
	                            "name"      => $datos->email,
	                            "password"  => $datos->contrasena,  
	                            "profile"   => $val->hotspot_perfil,  
	                            "server"    => 'hotspot1',
                                "comment"   => $nombre
							));  
                    	}                        
                    }
                
                }       
            }

 		return response()->json($user->toJson());   
    }
}
