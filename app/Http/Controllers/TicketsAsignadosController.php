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


        $tickets = DB::table('tickets_asignados')->whereIn('estado', [3,1, 0])->get(); 
        $zonas  =DB::table('zonas')->get(); 
        $router     = DB::table('router')->get();
        $perfiles=DB::table ('perfiles')->where('estado',1)->where('idtipo','HST')->get();
        $equipos = DB::table('equipos') ->where('estado',1)->get();  
        $vendedores = DB::table('users')->where('users.idtipo','VEN')->get();
        // dd($tickets );
        
       
        
        $tickets_Venta=DB::table ('ticket_venta')
        ->select('ticket_venta.cantidad','tickets_asignados_perfil_det.codigo')         
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
         ->where('ticket_venta.estado','1') 
        ->get(); 
        /* dd($tickets_Venta); */
         $tickets_Asig =DB::table ('tickets_asignados_det')
         ->select('tickets_asignados_det.idtrabajador','tickets_asignados_det.cantidad','tickets_asignados_perfil_det.idperfil_det','tickets_asignados_perfil_det.codigo')          
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')  
        ->get(); 
        //  dd( $tickets_Asig);
        // dd($tickets);
        return view('forms.asignarTickets.lstTicketsAsignados',[
            'tickets'           => $tickets,
            'zonas'             =>$zonas,
            'perfiles'          =>$perfiles,
            'router'            => $router,
            'vendedores'       =>$vendedores,
            'tickets_Venta'     =>$tickets_Venta,
            'tickets_Asig'     =>$tickets_Asig,
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
            'descripcion'      =>'required',
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
            'descripcion'           =>$request->descripcion,
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
        // dd($id);
        $tickets= DB::table('tickets_asignados')
        ->where('codigo',$id)
        ->get();
        
        foreach ($tickets as $tick) {
            $codigo =$tick->codigo; 
        } 

        $ticketsDetalle = DB::table('tickets_asignados_perfil_det')
        ->where('codigo',$codigo)
        ->get(); 

        $tickets_Venta=DB::table ('ticket_venta')
         ->select('ticket_venta.cantidad','tickets_asignados_perfil_det.idperfil_det','tickets_asignados_perfil_det.codigo')         
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
        ->where('tickets_asignados_perfil_det.codigo',$id)
        ->where('ticket_venta.estado','1')
        ->get(); 

        /* $asignados=DB::table ('tickets_asignados_det')
         ->select('tickets_asignados_det.idtrabajador','tickets_asignados_perfil_det.idperfil_det','tickets_asignados_perfil_det.codigo')          
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
        ->where('tickets_asignados_perfil_det.codigo',$id)->distinct()
        ->get(); */ //------------->CANTIDAD DE VENDEDORES ASIGANDOS 

        $asignados=DB::table ('tickets_asignados_det')
         ->select('tickets_asignados_det.idtrabajador','tickets_asignados_det.cantidad','tickets_asignados_perfil_det.idperfil_det','tickets_asignados_perfil_det.codigo')          
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
        ->where('tickets_asignados_perfil_det.codigo',$id)
        ->get();


        // dd($asignados);
       // dd($tickets_Venta);
        //dd($tickets); 
        $zonas  =DB::table('zonas')->get(); 
        $perfiles=DB::table ('perfiles')->where('estado',1)->where('idtipo','HST')->get(); 
         

        return view('forms.asignarTickets.updTicketsAsignados',[
            'ticketsDet'    => $ticketsDetalle,
            'tickets'       =>$tickets,
            'tickets_Venta' =>$tickets_Venta,
            'asignados'     =>$asignados,
            'zonas'         =>$zonas,
            'perfiles'      =>$perfiles
            
        ] );
        

       


    }
    public function asignarTrabajador($idUsuario , $idTicket)
    {   
       
 
        $tickets_asignados=DB::table ('tickets_asignados')->where('codigo',$idTicket)->get(); 
        foreach ($tickets_asignados as  $ticket) {
            $idZona=$ticket->idzona;
        }
        $zonas  =DB::table('zonas')->where('id',$idZona)->get(); 

        $tickets_per_det=DB::table ('tickets_asignados_perfil_det')->where('codigo',$idTicket)->get(); 
     
        $perfiles=DB::table ('perfiles')->get();  
        $vendedor=DB::table ('users')->where('id',$idUsuario)->get(); 
        $tickets_asignados_Det=DB::table ('tickets_asignados_det')
        ->select('tickets_asignados_det.*')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
        ->where('tickets_asignados_det.idtrabajador',$idUsuario)
        ->where('tickets_asignados_perfil_det.codigo',$idTicket) 
        ->get();  
        // dd($tickets_asignados_Det);

        $tickets_Venta=DB::table ('ticket_venta')
        ->select('ticket_venta.*')         
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign') 
        ->where('ticket_venta.idusuario',$idUsuario)
        ->where('ticket_venta.estado','1')
        ->get();  
        $codigos = DB::table('codigo_alterno')
            ->where(
                [
                    ['idtrabajador','=',intval($idUsuario)],
                    ['estado','=',array(1,3)] 
                ]

            )->get(); 
        // dd($tickets_asignados_Det);
        
        return view('forms.asignarTickets.asignarTicketTrabajador.lstTicketsTrabajador',[
            'tickets_asignados'         =>$tickets_asignados,
            'tickets_per_det'           =>$tickets_per_det,
            'tickets_Venta'             =>$tickets_Venta,
            'perfiles'                  =>$perfiles,
            'vendedor'                  =>$vendedor,
            'codigos'                   =>$codigos,
            'tickets_asignados_Det'     =>$tickets_asignados_Det,
            'zonas'                      =>$zonas


        ] );
    }
    public function asignarTrabajadorDetalle(Request $request){
        
        $tickets_per_det=DB::table ('tickets_asignados_perfil_det')->where('idperfil_det',$request->idTicketPerfil)->get(); 
        foreach ($tickets_per_det as  $value) {
            $idperfil=$value->idperfil;
            $idTicket=$value->codigo;
        } 
        $perfil=DB::table ('perfiles')->where('idperfil',$idperfil)->get(); 
        foreach ($perfil as  $item) {
            $precio=$item->precio;
        }  
        $codigos = DB::table('codigo_alterno') ->where('codigo', $request->codigoAlterno)->get();
         foreach ($codigos as  $codigo) {
            $cod_descripcion=$codigo->descripcion; 
        }  

        DB::table('tickets_asignados_det')
        ->insert([
            'codigo_alterno'        =>$cod_descripcion,
            'idtrabajador'  =>$request->idVendedor,
            'idperfil_det'  =>$request->idTicketPerfil,
            'idperfil'      =>$idperfil,
            'cantidad'      =>$request->cantidad,
            'precio'        =>$precio, 

        ]);
         DB::table('codigo_alterno')
        ->where('codigo', $request->codigoAlterno)
        ->update([
            'estado'         =>3, 
        ]);

        $datos['idvendedor'] = $request->idVendedor;
        $datos['idTicket'] = $idTicket;  
        return response()->json($datos);


    }
    public function contadorPerfilesAsignados(Request $request){
        //dd($request);

        $asignados=0;
        $totalTickets=0;

        $tickets_per_det=DB::table ('tickets_asignados_perfil_det') 
        ->select('tickets_asignados_det.cantidad',DB::raw('tickets_asignados_perfil_det.cantidad as CantidadTotal')  )
        ->join('tickets_asignados_det', 'tickets_asignados_det.idperfil_det','=','tickets_asignados_perfil_det.idperfil_det') 
        ->where('tickets_asignados_perfil_det.idperfil_det',$request->idTicketPerfil)
        ->get(); 

        $cantidad=DB::table ('tickets_asignados_perfil_det')->select('cantidad')->where('idperfil_det',$request->idTicketPerfil)->get();
      //  dd($cantidad);
        foreach ($tickets_per_det as  $ticketAsignados) {
            $asignados +=$ticketAsignados->cantidad;  
        } 
        foreach ($cantidad as  $cant) { 
            $totalTickets =$cant->cantidad;  
        } 

      //  dd($asignados); 

      $datos['ticketsAsignados'] = $asignados;  
      $datos['ticketsTotal'] = $totalTickets;  
      $datos['cantidad'] = $request->cantidad;  


      

      return response()->json($datos);
    }
    public function ticketsPorPersona(Request $request){
        // dd($request);
        $asignados=0;
        $tickets=DB::table ('tickets_asignados_det')->where('idtrabajador',$request->idvendedor)->get(); 
        foreach ($tickets as  $ticket) {
            $asignados +=$ticket->cantidad;
             
        }  
        $datos['cantidad'] = $asignados;  
        
        return response()->json($datos);
    }
    public function TipoTicketsPorPersona(Request $request){

        $tiposTickets = DB::table('tickets_asignados_det')
        ->select('idperfil')
        ->where('idtrabajador',$request->idvendedor)->distinct()->get();   
        $datos['ticketsTipos'] =count($tiposTickets);  

      return response()->json($datos);
    
    }
    public function TicketsPorPersona2 (Request $request){
       // dd($request);

        $asignados=0;
        $nombre=null;

        $tiposTickets = DB::table('tickets_asignados_det')
        ->select('tickets_asignados_det.idperfil')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
        ->where('tickets_asignados_det.idtrabajador',$request->idvendedor)
        ->where('tickets_asignados_perfil_det.codigo',$request->idticket)  
        ->distinct()->get();   
        // dd($tiposTickets);
        $tiposTicketsActivos = DB::table('tickets_asignados_det')
        ->select('tickets_asignados_det.idperfil')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
        ->where([
            ['tickets_asignados_det.idtrabajador','=',$request->idvendedor],
            ['tickets_asignados_det.estado','=',1]
        ])->distinct()->get();  
        $vendedor=DB::table ('users')->where('id',$request->idvendedor)->get(); 
        foreach ($vendedor as  $user) {
            $nombre =$user->nombre." ".$user->apellidos /* + $user->apellidos */; 
        }  

        
        $tickets=DB::table ('tickets_asignados_det')
        ->select('tickets_asignados_det.*','tickets_asignados_perfil_det.codigo')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
        ->where('idtrabajador',$request->idvendedor)
        ->where('tickets_asignados_perfil_det.codigo',$request->idticket) 
        ->get();
        //dd($tickets) ;
        foreach ($tickets as  $ticket) {
            $asignados +=$ticket->cantidad; 
        }  
        $datos['cantidad'] = $asignados;  
        $datos['ticketsTipos'] =count($tiposTickets); 
        $datos['ticketsActivos'] =count($tiposTicketsActivos);    

        $datos['nombre'] =$nombre; 
        $datos['idvendedor'] =$request->idvendedor; 


        return response()->json($datos);
    
    }
    public function destroy($id)
    {
         
        DB::table('tickets_asignados')
        ->where('codigo',$id)
        ->update([ 
            'estado'            => '2',  
        ]);

        return redirect('/tickets/Asignar');
    }
    public function habilitar ($id){
        //dd($id);
        DB::table('tickets_asignados')
        ->where('codigo',$id)
        ->update([ 
            'estado'            => '1',  
        ]);
        return redirect('/tickets/Asignar');

    }
    public function desabilitar ($id){
        //dd($id);
        DB::table('tickets_asignados')
        ->where('codigo',$id)
        ->update([ 
            'estado'            => '0',  
        ]);
        return redirect('/tickets/Asignar');

    }
    public function historialVentas()
    {

        $ticketsVendidosTicket = DB::table('ticket_venta')
        ->select('ticket_venta.*',DB::raw('tickets_asignados_perfil_det.idperfil_det as codigoPerfil'),DB::raw('tickets_asignados.descripcion as detalle'))
        ->orderBy('tickets_asignados_perfil_det.codigo', 'desc')
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
        ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
        ->where('ticket_venta.estado',1)
        ->where('tickets_asignados.estado','3') 
        ->get(); 

        $perfiles=DB::table ('perfiles')->get();    


        // dd($ticketsVendidosTicket);
        return view('forms.tickets.lstHistorialTickets',[
            'ticketsVendidosTicket' =>$ticketsVendidosTicket,
            'perfiles'              =>$perfiles
        ]);
         
         
         
    } 
    public function cerrarTicket($id)
    {
         
        DB::table('tickets_asignados')
        ->where('codigo',$id)
        ->update([ 
            'estado'            => '3',  
        ]); 
        $TicketsAsignados=DB::table ('tickets_asignados_det')
        ->select('tickets_asignados_det.*')          
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
        ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
        ->where('tickets_asignados.codigo',$id) 
        ->get(); 
        foreach($TicketsAsignados as $asig){
            DB::table('tickets_asignados_det')
            ->where('item',$asig->item)
            ->update([ 
                'estado'            => '0',  
            ]); 
        }
 
        // dd( $TicketsAsignados);

        return redirect('/tickets/Asignar');
    }


    



    
}
