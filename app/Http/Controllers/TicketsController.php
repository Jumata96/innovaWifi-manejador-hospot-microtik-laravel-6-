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
    public function registrarVenta()
    {
        $asignado=0;
        $vendidos=0;
        $tickets = DB::table('ticket_venta') 
        ->select('ticket_venta.*')

        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
        ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
        ->where('tickets_asignados.estado','1')  
        ->where('ticket_venta.estado',1)->where('ticket_venta.idusuario',Auth::user()->id)->get();//historial de vendidos por cliente


        $ticketsVendidosTicket = DB::table('ticket_venta')//consulta para saber los vendidos de los tickets activos por cleinte  
        ->select('ticket_venta.*')
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
        ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
        ->where('ticket_venta.estado',1)
        ->where('ticket_venta.idusuario',Auth::user()->id)
        ->where('tickets_asignados.estado','1') 
        ->get(); 
        foreach( $ticketsVendidosTicket as $ticket){
                $vendidos+=$ticket->cantidad;
        } 
        $tickets_asignados=DB::table ('tickets_asignados_det')
        ->select('tickets_asignados_det.*' )
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')  
        ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo')  
        ->where('tickets_asignados_det.idtrabajador',Auth::user()->id)
        ->where('tickets_asignados.estado','1')
        ->get(); 

       // dd($tickets_asignados);
        foreach( $tickets_asignados as $asignados){
                $asignado+=$asignados->cantidad;
        } 
        $perfiles=DB::table ('perfiles')->get();    

        return view('forms.tickets.registrarVenta',[
            'tickets'           => $tickets,
            'tickets_asignados' =>$tickets_asignados,
            'vendidos'         =>$asignado-$vendidos,
            'asignado'          =>$asignado,
            'perfiles'          =>$perfiles
        ]);
    }
    public function contadorVentasPerfilAsignado(Request $request){
       //dd($request); 
        $vendidos=0;
        $Asignados=0;
        $item =0; 
        $precio=null;
        $idperfil=null;
        $ticketsAsignados = DB::table ('tickets_asignados_det') 
        ->select('cantidad','precio','idperfil','item')
        ->where('idperfil_det',$request->idTicketPerfil) 
        ->get();
        foreach ($ticketsAsignados as  $asig) {
            $Asignados +=$asig->cantidad;
            $precio=$asig->precio;
            $idperfil=$asig->idperfil;
            $item2 =$asig->item;
        }  
         
        // dd($ticketsAsignados);

        // idTicketPerfil
        $ticketsVendidos = DB::table ('ticket_venta') 
        ->select('ticket_venta.cantidad','tickets_asignados_det.item','tickets_asignados_det.precio')
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign') 
        ->where('idperfil_det',$request->idTicketPerfil) 
        ->where('ticket_venta.estado','1') 

        ->get();

        //dd($ticketsVendidos );
        foreach ($ticketsVendidos as  $item) {
            $vendidos +=$item->cantidad; 
        }    

        $disponible=$Asignados-$vendidos; 

      $datos['ticketsAsignados'] = $Asignados;  
      $datos['ticketsDisponibles'] = $disponible;  
      $datos['ticketsCantidad'] = $request->cantidad;
      $datos['precio'] = $precio;  
      $datos['idperfil'] = $idperfil;  
      $datos['item'] = $item2; 


      return response()->json($datos);
    }
    public function storeTicketsVenta(Request $request){
        //dd($request)  ;

        DB::table('ticket_venta')
        ->insert([  
            'id_tickets_asign'        =>$request->idTicketAsignadoDet,
             'idusuario'              =>Auth::user()->id ,
            'cantidad'                =>$request->cantidad, 
            'precio'                  =>$request->precio,
            'idperfil'                =>$request->idPerfil, 
            'ticket'                  =>$request->codigo, 
            'estado'                  =>'1', 
            'fecha_creacion'          =>date('Y-m-d h:m:s')  
        ]); 


        
        $codigo=0;
        $cantidadTotalAsignados=0; 
        $totalVentas=0;
        $idperfil_det=0;
        $cantidadPerfilAsignado=0;
        $ventasDePerfil=0;

        $ticketsCodigos=DB::table ('ticket_venta')
        ->select('ticket_venta.cantidad','tickets_asignados_perfil_det.codigo','tickets_asignados.tickets_cant','tickets_asignados_perfil_det.idperfil_det',DB::raw('tickets_asignados_perfil_det.cantidad as cantidadPerfil '))         
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
        ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
        ->where('tickets_asignados_det.item',$request->idTicketAsignadoDet)
        ->get();   
        foreach($ticketsCodigos as $codigos){
            $cantidadTotalAsignados         =$codigos->tickets_cant;
            $codigo                         =$codigos->codigo; 
            $idperfil_det                   =$codigos->idperfil_det;
            $cantidadPerfilAsignado         =$codigos->cantidadPerfil; 
        } 
        /* $ventasRealizadasPorPerfil = DB::table ('ticket_venta')
            ->select('ticket_venta.cantidad','tickets_asignados_perfil_det.codigo'  )         
            ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
            ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det') 
            ->where('tickets_asignados_perfil_det.idperfil_det',$idperfil_det)
            ->get(); 
            foreach( $ventasRealizadasPorPerfil as $ventasPorPerfil){
                $ventasDePerfil += $ventasPorPerfil->cantidad;
        }  */
        $ventasRealizadas=DB::table ('ticket_venta')
        ->select('ticket_venta.cantidad','tickets_asignados_perfil_det.codigo','tickets_asignados.tickets_cant')         
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
        ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
        ->where('tickets_asignados.codigo',$codigo)
        ->where('ticket_venta.estado','1') 
        ->get(); 
        foreach($ventasRealizadas as $codigos){
            $totalVentas  +=$codigos->cantidad; 
        }
 
        if($totalVentas==$cantidadTotalAsignados){
           // dd("ingreso a guardar");
            DB::table('tickets_asignados')
            ->where('codigo',$codigo)
            ->update([ 
                'estado'            => '3',  
            ]);
        } 

    }
    public function UpdateVenta(Request $request){
        //dd($request);

        $rules = array(  
            'cantidadTicket'          => 'required',  
            'precioTicket'            => 'required', 
            'idPerfilTicket'          => 'required', 
            'codigoTicket'            => 'required', 
            'glosa'                   => 'required', 

             
            );
            $validator = Validator::make ( $request->all(), $rules );
    
            if ($validator->fails()){
                $var = $validator->getMessageBag()->toarray();
                array_push($var, 'error');
                //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
                return response()->json($var);
            }

            DB::table('ticket_venta')
            ->where('codigo',$request->idTicket)
            ->update([  
                'idusuario'              =>Auth::user()->id ,
                'cantidad'                =>$request->cantidadTicket, 
                'precio'                  =>$request->precioTicket,
                'idperfil'                =>$request->idPerfilTicket, 
                'ticket'                  =>$request->codigoTicket, 
                'glosa'                  =>$request->glosa, 
            ]);
            return response()->json(array('conforme'=> 'registro'));

        /* $codigo=DB::table('ticket_venta')->where('ticket',$request->codigoTicket)->get();
        if(count($codigo)<=0){ 
        }
        else{
            return response()->json(array('errors'=> 'EXISTE'));
        } */
    

        

      
    }
    public function destroy($id)
    {
         
        DB::table('ticket_venta')
        ->where('codigo',$id)
        ->update([ 
            'estado'            => '2',  
        ]);

        return redirect('/tickets/registrarVenta');
    }
    public function ValidarCodigo(Request $request)
    {
        //dd($request);
        $codigo=DB::table('ticket_venta')->where('ticket',$request->codigo)->get();
        // dd(count($codigo));
        if(count($codigo)>0){
            return response()->json(array('valor'=> 'EXISTE')); 
        }else{
            //no existe el codigos
            return response()->json(array('valor'=> 'NO_EXISTE'));
        }
         
         
         
    }
    public function historialVentas()
    {

        $ticketsVendidosTicket = DB::table('ticket_venta')//consulta para saber los vendidos de los tickets activos por cleinte  
        ->select('ticket_venta.*',DB::raw('tickets_asignados_perfil_det.idperfil_det as codigoPerfil'),DB::raw('tickets_asignados.descripcion as detalle'))
        ->orderBy('tickets_asignados_perfil_det.codigo', 'desc')
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
        ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
        ->where('ticket_venta.estado',1)
        ->where('tickets_asignados.estado','3')

        ->where('ticket_venta.idusuario',Auth::user()->id) 
        ->get(); 

        $perfiles=DB::table ('perfiles')->get();     
        // dd($ticketsVendidosTicket);
        return view('forms.tickets.lstHistorialTickets',[
            'ticketsVendidosTicket' =>$ticketsVendidosTicket,
            'perfiles'              =>$perfiles
        ]); 
    }

    public function saldoTicketsAsignados()
    {
        $API = new routeros_api();
        $API->debug = false;
        $router = DB::table('router')->where('idrouter','R01')->get();

        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $ARRAY = $API->comm("/ip/hotspot/user/print");
                //$collection = Collection::make($ARRAY); 
            }
        }
        $usuarios = DB::table('users')->where('idtipo','VEN')->get();
        // dd($ARRAY);
         return view('forms.asignarTickets.saldoTickets.lstSaldoTicketsAsignados',[
             'ARRAY'       =>$ARRAY,
             'usuarios'   =>$usuarios

         ]);

    }

    
}
