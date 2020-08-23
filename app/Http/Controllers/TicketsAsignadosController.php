<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class TicketsAsignadosController extends Controller
{
    //
    public function asignarTickets(Request $request){

        $tickets = DB::table('tickets_asignados')->get();
        $zonas  =DB::table('zonas')->get(); 
        $router     = DB::table('router')->get();
        $perfiles=DB::table ('perfiles')->where('estado',1)->where('idtipo','HST')->get();
        $equipos = DB::table('equipos') ->where('estado',1)->get(); 
        
        $vendedores = DB::table('users')->where('users.idtipo','VEN')->get();
         

        return view('forms.asignarTickets.lstTicketsAsignados',[
            'tickets'           => $tickets,
            'zonas'             =>$zonas,
            'perfiles'          =>$perfiles,
            'router'            => $router,
            'vendedores'       =>$vendedores,
            'equipos'           => $equipos
        ] );

    }
    public function create()
    { 
        $zonas  =DB::table('zonas')->get();
       
        return view('forms.asignarTickets.addTicketsAsignados',[
            'zonas'             =>$zonas
        ]); 
    }
    public function store(Request $request)
    { 
        

        $rules = array(     
            'puntoDeVenta'     => 'required',
            'cantidad'   => 'required',
        );

        $validator = Validator::make ( $request->all(), $rules );
        
        
        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');            
            return response()->json($var);
        } 

        
        DB::table('tickets_asignados')
        ->insert([ 
            'idusuario'         => Auth::user()->id ,
            'tickets_cant'      => intval($request->cantidad),
            'idzona'            => $request->puntoDeVenta,
            'estado'            => 1,
            'fecha_creacion'    => date('Y-m-d h:m:s'),
            'glosa'             => $request->glosa,
        ]);  

        $codigo = DB::table('tickets_asignados')->max('codigo');
        $datos['codigo'] = $codigo; 
            return response()->json($datos);

    }
    public function storeDetallePerfil(Request $request)
    {   

        DB::table('tickets_asignados_perfil_det')
        ->insert([ 
            'codigo'            => $request->codigo, 
            'idusuario'         => Auth::user()->id ,
            'idperfil'          => $request->conceptoId,
            'cantidad'          => $request->cantidad,
            'precio'            => $request->precio, 
        ]);  
 
        return response()->json("conforme");
        


    }
    public function show($id)
    {   
        //dd($id);
        $tickets= DB::table('tickets_asignados')
        ->where('codigo',$id)
        ->get();
        foreach ($tickets as $tick) {
            $codigo =$tick->codigo; 
        } 

        $ticketsDetalle = DB::table('tickets_asignados_perfil_det')
        ->where('codigo',$codigo)
        ->get();
        
        

        
        //dd($tickets); 
        $zonas  =DB::table('zonas')->get(); 
        $perfiles=DB::table ('perfiles')->where('estado',1)->where('idtipo','HST')->get(); 
         

        return view( 'forms.asignarTickets.updTicketsAsignados',[
            'ticketsDet'   => $ticketsDetalle,
            'tickets'   =>$tickets,
            'zonas'     =>$zonas,
            'perfiles'          =>$perfiles,
            
        ] );

       


    }
}
