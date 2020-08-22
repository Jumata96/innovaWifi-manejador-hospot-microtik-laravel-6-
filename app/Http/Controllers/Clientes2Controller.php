<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class Clientes2Controller extends Controller
{
    public function index()
    {
    	$router = DB::table('router')->where('principal',1)->get();
     
        $usuarios = DB::table('usuarios_hotspot')
        ->where([
        	'idempresa'		=> '001'
        ])->get();

        return view('forms.clientes.lstClientes',[
        	'router'		=> $router,
        	'usuarios'		=> $usuarios
        ]);
    }

    public function show($id)
    {
        $down = 0;
        $up = 0;
        $tdown = null;
        $tup = null;

        $usuario = DB::table('usuarios_hotspot')
                    ->where(['codigo' => $id, 'estado' => 1])->get();

        foreach ($usuario as $val) {
            $down = $val->descarga;
            $up = $val->subida;
        }

        if ($down > 1073741824) {
            $down = number_format((($down/1024)/1024)/1024,1);
            $tdown = 'Gigas';
        }else if ($down > 1048576) {
            $down = number_format(($down/1024)/1024,1);
            $tdown = 'Megas';
        }else if ($down > 1024) {
            $down = number_format($down/1024,1);
            $tdown = 'KiB';
        }

        if ($up > 1073741824) {
            $up = number_format((($up/1024)/1024)/1024,1);
            $tup = 'Gigas';
        }else if ($up > 1048576) {
            $up = number_format(($up/1024)/1024,1);
            $tup = 'Megas';
        }else if ($up > 1024) {
            $up = number_format($up/1024,1);
            $tup = 'KiB';
        }

        return view('forms.clientes.perfilCliente',[
            'usuario'   => $usuario,
            'down'      => $down,
            'tdown'     => $tdown,
            'up'        => $up,
            'tup'       => $tup
        ]);
    }

    public function destroy($id)
    {
        //dd($id);
        $email = null;
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        $router = DB::table('router')->where('activo',1)->get();
            
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $cliente = DB::table('usuarios_hotspot')->where('codigo',$id)->get();
                $nombre = null;
                $correo = null;

                foreach ($cliente as $val) {
                    $email = $val->email;
                }

                $ARRAY = $API->comm("/ip/hotspot/user/print");     
                           
                foreach ($ARRAY as $value) {
                    if ($value['name'] == trim($email)) {
                        $ARRAY = $API->comm("/ip/hotspot/user/remove", array(
                            ".id"       => $value['.id']  
                        ));                                                                         
                    }
                }               
            }
        }

        DB::table('usuarios_hotspot')
            ->where(['codigo' => $id, 'estado' => 1])->delete();


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

        return redirect('/hotspot/usuarios');
    }

    public function disabled(Request $request)
    {
        //dd($request);
        $router = DB::table('router')->where('activo',1)->get();
            
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $cliente = DB::table('usuarios_hotspot')->where('codigo',$request->id)->get();
                $nombre = null;
                $correo = null;

                foreach ($cliente as $val) {
                    $nombre = $val->nombre.' '.$val->apellidos;
                    $email = $val->email;
                }

                $ARRAY = $API->comm("/ip/hotspot/user/print");     
                           
                foreach ($ARRAY as $value) {
                    if ($value['name'] == trim($email)) {
                        $ARRAY = $API->comm("/ip/hotspot/user/disable", array(
                            ".id"       => $value['.id']  
                        ));                                                                         
                    }
                }               
            }
        }

        DB::table('usuarios_hotspot')
        ->where('codigo',$request->id)
        ->update([
            'estado'    => 0
        ]);



        $cliente = DB::table('usuarios_hotspot')->where('codigo',$request->id)->get();
        $collection = Collection::make($cliente);
                
        return response()->json($collection->toJson());   
    }

    public function habilitar(Request $request)
    {
        //dd($request);
        $router = DB::table('router')->where('activo',1)->get();
            
        $API = new routeros_api();
        $API->debug = false;
        $ARRAY = null;

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {

                $cliente = DB::table('usuarios_hotspot')->where('codigo',$request->id)->get();
                $nombre = null;

                foreach ($cliente as $val) {
                    $nombre = $val->nombre.' '.$val->apellidos;
                    $email = $val->email;
                }

                $ARRAY = $API->comm("/ip/hotspot/user/print");     
                            
                foreach ($ARRAY as $value) {
                    if ($value['name'] == trim($email)) {
                        $ARRAY = $API->comm("/ip/hotspot/user/enable", array(
                            ".id"       => $value['.id']  
                        ));                                                                         
                    }
                }               
            }
        }
        

        DB::table('usuarios_hotspot')
        ->where('codigo',$request->id)
        ->update([
            'estado'    => 1
        ]);



        $cliente = DB::table('usuarios_hotspot')->where('codigo',$request->id)->get();
        $collection = Collection::make($cliente);
                
        return response()->json($collection->toJson());   
    }
    
}
