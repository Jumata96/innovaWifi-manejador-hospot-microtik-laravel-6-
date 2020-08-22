<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Carbon\Carbon;
use Validator;
use Auth;
use DB;

class TicketsController extends Controller
{
    public function registrar()
    {
        $tickets = DB::table('ticket')->where('estado',1)->get();

        return view('forms.tickets.addRegistrar',[
            'tickets'   => $tickets
        ]);
    }

    public function validar(Request $request)
    {
        //dd($request);
        $ARRAY2 = null;
        $idperfil = null;
        $API = new routeros_api();
        $API->debug = false;
        $router = DB::table('router')->where('activo',1)->get();

        $ticket = DB::table('ticket')->where('ticket',$request->pin)->get();

        if (count($ticket) > 0) {
            return response()->json("TICKET_EXISTE"); 
        }

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                //$rows = array(); $rows2 = array();  

                //--------Usuarios Conectados------------------
                $ARRAY = $API->comm("/ip/hotspot/user/print");  
                
                $collection = Collection::make($ARRAY);     

            }else{
                echo "<font color='#ff0000'>La conexion ha fallado. Verifique si el Api esta activo.</font>";
            }
        }
        $API->disconnect();

        foreach ($ARRAY as $value) {
            //dd($value);
            if (isset($value["name"]) and trim($value["name"]) == trim($request->pin)) {

                $perfil = DB::table('perfiles')->where('name',trim($value["profile"]))->get();

                foreach ($perfil as $val) {
                    $idperfil = $val->idperfil;
                    $ARRAY2 = [
                        "nombre"    => $request->pin,
                        "idperfil"  => $idperfil,
                        "name"      => $val->name,
                        "precio"    => $val->precio
                    ];
                }                
            }
        }

        //dd($ARRAY2);
        if($ARRAY2 == null){
            $ARRAY2 = array();
            array_push($ARRAY2, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($ARRAY2);
        }

        $collection = Collection::make($ARRAY2);
            
        return response()->json($collection->toJson()); 
        //return response()->json($ARRAY2);
    }

    public function store(Request $request)
    {
        //dd($request);
        $ticket = DB::table('ticket')->where('ticket',$request->codigo)->get();

        if (count($ticket) > 0) {
            return response()->json("TICKET_EXISTE"); 
        }

        DB::table('ticket')
        ->insert([
            'estado'            => 1,
            'idusuario'         => Auth::user()->id,
            'ticket'            => $request->codigo,
            'idperfil'          => $request->idperfil,
            'descripcion'       => "CREADO AUTOMATICAMENTE",
            'glosa'             => (empty($request->glosa))? null : $request->glosa,
            'fecha_creacion'    => date('Y-m-d h:m:s')
        ]);

        return response()->json("CORRECTO"); 
    }
    
}
