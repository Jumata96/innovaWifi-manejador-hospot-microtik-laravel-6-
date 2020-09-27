<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Hash; 
use Carbon\Carbon;
use Validator;
use Auth;
use Excel;
use DB;  
use DateTime;

class TicketsController extends Controller
{
    public function registrar()
    {
        $tickets = DB::table('ticket')->where('estado',1)->get();

        return view('forms.tickets.addRegistrar',[
            'tickets'   => $tickets
        ]);
    } public function validar(Request $request)
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

        $ventasRealizadas=DB::table ('ticket_venta')
        ->select('ticket_venta.cantidad',DB::raw('tickets_asignados_det.cantidad  as cantidadPerfilAsignado') )         
        ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
        ->where([
            ['ticket_venta.estado','=','1'],
            ['tickets_asignados_det.item','=', intval($request->idTicketAsignadoDet)] 
        ]) 
        ->get();  
        $cantidadPerfilAsig=null;
        $cantidadVentasPerfilAsig=null;

        foreach($ventasRealizadas as $ventasPerfil){  
             $cantidadPerfilAsig +=$ventasPerfil->cantidad;
             $cantidadVentasPerfilAsig =$ventasPerfil->cantidadPerfilAsignado; 
        } 
        // dd($cantidadPerfilAsig,$cantidadVentasPerfilAsig) ;
        if($cantidadPerfilAsig==$cantidadVentasPerfilAsig){
           // dd("ingreso a guardar");
            DB::table('tickets_asignados_det')
            ->where('item',intval($request->idTicketAsignadoDet))
            ->update([ 
                'estado'            => '0',  
            ]);
        }  
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
    public function TicketsAsignadosPorPersona (Request $request)
    {
        // dd($request);
 
         $asignados=0;
         $nombre=null; 
         $alterno=null;
         $API = new routeros_api();
         $API->debug = false;
         $ARRAY=[];

         
         $vendedor=DB::table ('users')->where('id',$request->idvendedor)->get(); 
         foreach ($vendedor as  $user) {
             $nombre =$user->nombre." ".$user->apellidos /* + $user->apellidos */; 
             $alterno=$user->cod_alterno;
         }   
        

         $tickets=DB::table ('tickets_asignados_det') 
         ->where('idtrabajador',$request->idvendedor) 
         ->get();
         //dd($tickets) ;
         foreach ($tickets as  $ticket) {
             $asignados +=$ticket->cantidad; 
         }  
         $router = DB::table('router')->where('idrouter','R01')->get();  
         
        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $ARRAY = $API->comm("/ip/hotspot/user/print");
                //$collection = Collection::make($ARRAY); 
            }
        } 
        $perfiles = DB::table('perfiles')-> get(); 

        //dd($ARRAY,$alterno); 

         $datos['cantidad'] = $asignados;    
         $datos['nombre'] =$nombre; 
         $datos['idvendedor'] =$request->idvendedor; 
         $datos['alterno'] =$alterno; 
         $datos['perfiles'] =$perfiles; 
         $datos['ARRAY'] =$ARRAY;  

         return response()->json($datos);
     
     }

    public function saldoTicketsAsignados(){
        /* $API = new routeros_api();
        $API->debug = false; */
        $router = DB::table('router')->where('idrouter','R01')->get(); 

        /* foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $ARRAY = $API->comm("/ip/hotspot/user/print");
                //$collection = Collection::make($ARRAY); 
            }
        } */
        $usuarios = DB::table('users')->where('idtipo','VEN')->get(); 

         return view('forms.asignarTickets.saldoTickets.lstSaldoTicketsAsignados',[ 
             'vendedores'   =>$usuarios

         ]);

    }
    public function showSaldo($id ,$item){
         $ARRAY=[];
         $data = [];
         $contador_elementos=0;
        $API = new routeros_api();
        $API->debug = false;
        $router = DB::table('router')->where('idrouter','R01')->get();  
         $perfiles = DB::table('perfiles')-> get(); 
        
        foreach ($router as $rou) {//--------trae la informaciòn
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $ARRAY = $API->comm("/ip/hotspot/user/print");
                //$collection = Collection::make($ARRAY); 

                $API->disconnect();
            }else{
                echo "No se pudo conectar al mikrotik";
            }
        }
        $ticketsAsignados=DB::table ('tickets_asignados_det') 
         ->where([
             ['idtrabajador','=',$id],
             ['item','=',$item]

         ]) ->get(); 
        //   dd($ticketsAsignados);
         foreach($ticketsAsignados as $asignados){  
            foreach($ARRAY as $valor){ 
                    if(isset($valor['name']) and substr($valor['name'],0,strlen($asignados->codigo_alterno)) == trim($asignados->codigo_alterno)and isset($valor['profile']) ){   
                        foreach($perfiles as $perfilAs){
                            //   dd($perfilAs);
                            if($perfilAs->name==$valor['profile']){
                                if($asignados->idperfil ==$perfilAs->idperfil ){
                                    $contador_elementos++;
                                    array_push($data,[ 
                                        'id'        =>$contador_elementos,
                                        'nombre'    => $valor['name'],
                                        'plan'      => $valor['profile'],
                                        'perfil'    =>$perfilAs->idperfil,
                                        'precio'    =>$asignados->precio,
                                        'target'    =>$perfilAs->rate_limit,
                                    ]);  
                                }       
                            } 
                        }      
                    } 
            }  
            $asignadosPrecio=$asignados->cantidad*$asignados->precio;
            $saldoPrecio=count($data)*$asignados->precio;

         }; 
        $usuarios = DB::table('users')->where('id',$id)->get();  
        $puntoVenta = DB::table('zonas')->where('estado',1)-> get();  
        return view('forms.asignarTickets.saldoTickets.saldoTicketsVendedor',[
             
            'usuarios'         =>$usuarios,
            'puntoVenta'       =>$puntoVenta, 
            'asignadosPrecio'  =>$asignadosPrecio,
            'saldoPrecio'      =>$saldoPrecio,
            'data'            =>$data

        ]);
         
    } 
    
    public function reporteVenta(){ 
        $total = 0;

        $fecha_validar = Carbon::now(); 
        $ticketsVendidos = DB::table('ticket_venta')//cargamos el formulario en 0   
        ->where('ticket_venta.estado','1')//ponemos 
         ->limit(0)
        ->get();  

        $perfiles = DB::table('perfiles')->where('estado',1)->get();
        $zonas = DB::table('zonas')->where('estado',1)->get(); 
        $users = DB::table('users')->where('idtipo','VEN')->get(); 
        $arrayFiltro=[]; 
        $arrayZonas=[]; 
        $ArrayDatosFiltrados=[];
          foreach($users  as $user){
            array_push($arrayFiltro,[
                'id'    =>$user->id,
                'value' =>$user->nombre." ".$user->apellidos,
                'label' =>"Doc :".$user->nro_documento." | Nombre:".$user->nombre." ".$user->apellidos." | Codigo:".$user->id, 
                'idZona'=>$user->idzona,
            ]);
          }
          foreach($zonas  as $zona){
            array_push($arrayZonas,[
                'id'    =>$zona->id,
                'value' =>$zona->nombre,
                'label' =>"PV| ".$zona->nombre,
            ]);
          }

        foreach($ticketsVendidos as $vendidos){ 
            $total +=intval($vendidos->precio)*intval($vendidos->cantidad);
        }    
         $parametros = DB::table('parametros') 
            ->where([
                ['tipo_parametro','=','REPORTES'],
                ['estado','=',1]
            ]) 
            ->get();

        return view('forms.reportes.reporteVentas.rptVenta',[
            'Ventas'       => $ticketsVendidos, 
            'perfiles'       => $perfiles,
            'zonas'       => $zonas,
            'users'       => $users, 
            'total'       => $total ,
            'arrayFiltro'       => $arrayFiltro  ,
            'arrayZonas'       => $arrayZonas  ,  
             'ArrayDatosFiltrados'=>$ArrayDatosFiltrados,
             'parametros'        => $parametros
            
        ]); 

    }

     public function TicketsMikroPorVendedor(string $alterno,int $id){
          
            $ARRAY=[];
          $API = new routeros_api();
          $API->debug = false;
        //   $alterno='A';
        //   $id=125;
          $data=[];
          $cont=0;
          $router = DB::table('router')->where('idrouter','R01')->get();    
          $vendedor=DB::table ('users')->where('idtipo','VEN')->get();    
          $perfiles = DB::table('perfiles')-> get();     
             foreach ($router as $rou) {//--------trae la informaciòn
                 if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                     $ARRAY = $API->comm("/ip/hotspot/user/print");
                     //$collection = Collection::make($ARRAY); 
                 }
             } 

              foreach($ARRAY as $valor){
                 
                 if(isset($valor['name']) and substr($valor['name'],0,strlen($alterno)) == trim($alterno)and isset($valor['profile']) ){  


                       
                      foreach($perfiles as $perfilAs){
                        //   dd($perfilAs);
                          if($perfilAs->name==$valor['profile']){
                              $cont++;
                                array_push($data,[
                                    'id'        => $cont,
                                    'nombre'    => $valor['name'],
                                    'plan'      => $valor['profile'],
                                    'perfil'    =>$perfilAs->idperfil,
                                    'target'    =>$perfilAs->rate_limit
                                ]);   
                          }
                          
                      } 
                     
                 }
              
             } 

             foreach($vendedor as $datos){
                 if("".$datos->id !== "".trim($id)){
                     foreach($data as $key => $valor){
                         if(substr($valor['nombre'],0,strlen($datos->cod_alterno)) == trim($datos->cod_alterno)){
                             if(substr($alterno,0,strlen($datos->cod_alterno)) != trim($datos->cod_alterno) ){
                                 unset($data[$key]);
                             }                                              
                         }
                     }
                 }
             }

             return $data;

    }
    public function TicketsEstado(string $tickets_asignados_Cod){
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

    public function reporteVentaFiltro(Request $request){  
        $total=0;   
        $from = Carbon::createFromFormat('d/m/Y',$request->from); 
        $to = Carbon::createFromFormat('d/m/Y',$request->to);
        
        $vendedores=[];
        $ArrayDatosFiltrados=[];
       
        if($request->contadorVendedores>0){
            
            for ($i = 1; $i <= $request->contadorVendedores; $i++) {
                $nombre="vendedor".$i;
                if(intval($request->$nombre) !=0){
                    array_push($vendedores,[
                         'idvendedor'=>intval($request->$nombre)
                     ]); 
                } 
            } 

            $ticketsVendidos = DB::table('ticket_venta as venta')
                ->select('venta.idusuario','asigPerDet.idperfil_det','asig.idzona','venta.idperfil','venta.precio','venta.cantidad','venta.fecha_creacion','venta.estado','asig.descripcion',DB::raw('asigDet.cantidad  as cantidadAsignados'),DB::raw('asigDet.item  as itemAsignados'),DB::raw('asigDet.estado  as estadoTicketAsig') )
                ->join( 'tickets_asignados_det as asigDet','asigDet.item','=','venta.id_tickets_asign')
                ->join( 'tickets_asignados_perfil_det as asigPerDet','asigPerDet.idperfil_det','=','asigDet.idperfil_det')
                ->join('tickets_asignados as asig','asig.codigo','=','asigPerDet.codigo')   
                ->whereIn('venta.idusuario',$vendedores)
                ->whereBetween('venta.fecha_creacion', array($from, $to)) 
                ->get();   
        }else if($request->PuntoVentaFiltrado!=""||$request->PuntoVentaFiltrado!=null) {
             
                $ticketsVendidos = DB::table('ticket_venta as venta')
                ->select('venta.idusuario','asigPerDet.idperfil_det','asig.idzona','venta.idperfil','venta.precio','venta.cantidad','venta.fecha_creacion','venta.estado','asig.descripcion',DB::raw('asigDet.cantidad  as cantidadAsignados'),DB::raw('asigDet.item  as itemAsignados'),DB::raw('asigDet.estado  as estadoTicketAsig') )
                ->join( 'tickets_asignados_det as asigDet','asigDet.item','=','venta.id_tickets_asign')
                ->join( 'tickets_asignados_perfil_det as asigPerDet','asigPerDet.idperfil_det','=','asigDet.idperfil_det')
                ->join('tickets_asignados as asig','asig.codigo','=','asigPerDet.codigo')   
                ->where('asig.idzona',$request->PuntoVentaFiltrado)
                ->whereBetween('venta.fecha_creacion', array($from, $to)) 
                ->get();   

        }else{  
            //consulta para saber los vendidos de los tickets activos por cliente  
            $ticketsVendidos = DB::table('ticket_venta as venta')
                ->select('venta.idusuario','asigPerDet.idperfil_det','asig.idzona','venta.idperfil','venta.precio','venta.cantidad','venta.fecha_creacion','venta.estado','asig.descripcion',DB::raw('asigDet.cantidad  as cantidadAsignados'),DB::raw('asigDet.item  as itemAsignados'),DB::raw('asigDet.estado  as estadoTicketAsig') )
                ->join( 'tickets_asignados_det as asigDet','asigDet.item','=','venta.id_tickets_asign')
                ->join( 'tickets_asignados_perfil_det as asigPerDet','asigPerDet.idperfil_det','=','asigDet.idperfil_det')
                ->join('tickets_asignados as asig','asig.codigo','=','asigPerDet.codigo')   
                ->where('venta.estado','1')
                ->whereBetween('venta.fecha_creacion', array($from, $to)) 
                ->get();  
        }   
        $router = DB::table('router')->where('activo',1)->get();
        $formaPago = DB::table('forma_pagos')->get();
        $perfiles = DB::table('perfiles')->get(); 
        $zonas = DB::table('zonas')->get(); 
         
        $users = DB::table('users')->where('idtipo','VEN')->get();
        $arrayDataTable=[]; 

        $arrayFiltro=[]; 
        $arrayZonas=[];  
          foreach($users  as $user){
            array_push($arrayFiltro,[
                'id'    =>$user->id,
                'value' =>$user->nombre." ".$user->apellidos,
                'label' =>"Doc :".$user->nro_documento." | Nombre:".$user->nombre." ".$user->apellidos." | Codigo:".$user->id, 
                'idZona'=>$user->idzona,
            ]);
          }
          foreach($zonas  as $zona){
            array_push($arrayZonas,[
                'id'    =>$zona->id,
                'value' =>$zona->nombre,
                'label' =>"PV| ".$zona->nombre,
            ]);
          }  
         foreach($ticketsVendidos as $ticketF){  
                 $total +=intval($ticketF->precio)*intval($ticketF->cantidad);
                $Vendedor=null;
                $Cod_Alterno=null;
                $Punto_de_Venta=null;
                $Ticket=null;
                $Plan=null;
                $idPlan=null;
                $Precio=null;
                $Total_AsignadosMonto=0;
                $Saldo_TotalMonto=0;
                $Total_VendidosMonto=0;
                $Total_Asignados=0;
                $Saldo_Total=0;
                $Total_Vendidos=0; 
                $Cantidad_Venta=0;
                $Subtotal=0;
                $Fecha_de_venta=null;
                $Estado=null;
                //  dd($ticketF);
                foreach($users  as $user){
                    if($user->id==$ticketF->idusuario){ 
                        //  dd($ticketF);
                         $Vendedor=$user->nombre." ".$user->apellidos;
                        
                         foreach($zonas  as $punto){
                             if($punto->id==$ticketF->idzona){
                                  $Punto_de_Venta=$punto->nombre; 
                             } 
                         } 
                    }  
                } 
                 $Ticket=$ticketF->descripcion;

                 foreach($perfiles  as $perfil){
                    if($perfil->idperfil==$ticketF->idperfil){ 
                         $Plan=$perfil->name;
                         $idPlan=$perfil->idperfil; 
                         $Precio=$perfil->precio;
                    }  
                } 

                $ventasRealizadas=DB::table ('ticket_venta')
                ->select('ticket_venta.*','tickets_asignados_det.codigo_alterno')         
                ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign') 
                ->where('tickets_asignados_det.item',$ticketF->itemAsignados)
                ->where('ticket_venta.estado','1') 
                ->get(); 
                 foreach($ventasRealizadas  as $ventaRealizada){
                      $Cod_Alterno=$ventaRealizada->codigo_alterno;
                      $Total_Vendidos+=$ventaRealizada->cantidad;
                   
                }   
                $Total_Asignados=$ticketF->cantidadAsignados;   

                $Saldo_Total=$Total_Asignados- $Total_Vendidos; 
                if($Saldo_Total<1){
                   $Saldo_Total=0; 
                } 
                $Total_AsignadosMonto=$Total_Asignados*$Precio;
                $Saldo_TotalMonto=$Saldo_Total*$Precio;
                $Total_VendidosMonto=$Total_Vendidos*$Precio; 
                $Cantidad_Venta=$ticketF->cantidad;
                $Subtotal=$ticketF->cantidad*$Precio;
                $Fecha_de_venta=$ticketF->fecha_creacion;
                $Estado=$ticketF->estado; 
                array_push($ArrayDatosFiltrados,[
                    'Vendedor'=>$Vendedor,
                    'Cod_Alterno'=>$Cod_Alterno,
                    'Punto_de_Venta'=>$Punto_de_Venta,
                    'Ticket'=>$Ticket,
                    'Plan'=>$Plan,
                    'Precio'=>$Precio,
                    'Total_AsignadosMonto'=>$Total_AsignadosMonto,
                    'Saldo_TotalMonto'=>$Saldo_TotalMonto,
                    'Total_VendidosMonto'=>$Total_VendidosMonto,
                    'Total_Asignados'=>$Total_Asignados,
                    'Saldo_Total'=>$Saldo_Total,
                    'Total_Vendidos'=>$Total_Vendidos, 
                    'Cantidad_Venta'=>$Cantidad_Venta,
                    'Subtotal'=>$Subtotal,
                    'Fecha_de_venta'=>$Fecha_de_venta,
                    'estadoTicket'=>$ticketF->estadoTicketAsig,
                    'Estado'=>$Estado 
                ]); 
        } 
         $parametros = DB::table('parametros') 
            ->where([
                ['tipo_parametro','=','REPORTES'],
                ['estado','=',1]
            ]) 
            ->get();
      

        return view('forms.reportes.reporteVentas.rptVenta',[
            'Ventas'       => $ticketsVendidos, 
            'perfiles'       => $perfiles,
            'zonas'       => $zonas,
            'users'       => $users, 
            'total'       => $total ,
            'fechaFrom'       => $from,
            'fechaTo'       => $to,
            'arrayZonas'       => $arrayZonas,
            'arrayFiltro' =>$arrayFiltro,
            'parametros'   =>$parametros,
            'ArrayDatosFiltrados'=>$ArrayDatosFiltrados
        ]);

    } 
    public function consultarVentasMikrotik (Request $request){  
        // dd("ok");
        $registro="NO";
        $ARRAY=[];  
        $API = new routeros_api();
        $API->debug = false;
        $router = DB::table('router')->where('idrouter','R01')->get();  
        $perfiles = DB::table('perfiles')-> get(); 
        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $ARRAY = $API->comm("/ip/hotspot/user/print"); 
            }
        } 
        //  dd($ARRAY);
        $cont=0;
        $ticketsAsignados=DB::table ('tickets_asignados_det') 
                ->where([ 
                    ['estado','=',1]
                ]) 
                ->get();  
        // dd($ticketsAsignados);
        foreach($ticketsAsignados as $asignados){ 
            // dd($asignados);
            $data = [];
            foreach($ARRAY as $valor){ 
                    if(isset($valor['name']) and substr($valor['name'],0,strlen($asignados->codigo_alterno)) == trim($asignados->codigo_alterno)and isset($valor['profile']) ){  
                        $cont++; 
                        foreach($perfiles as $perfilAs){
                            //   dd($perfilAs);
                            if($perfilAs->name==$valor['profile']){
                                if($asignados->idperfil ==$perfilAs->idperfil ){
                                    array_push($data,[
                                        'id'        => $cont,
                                        'nombre'    => $valor['name'],
                                        'plan'      => $valor['profile'],
                                        'perfil'    =>$perfilAs->idperfil
                                    ]); 

                                }
                                
                                      
                            } 
                        }      
                    } 
            } 
            // dd($data);

            $ticketsVendidos = DB::table ('ticket_venta as venta') 
                    ->select('venta.cantidad','asig.item','asig.precio')
                    ->join( 'tickets_asignados_det as asig','asig.item','=','venta.id_tickets_asign') 
                    ->where('asig.item',$asignados->item) 
                    ->where('venta.estado','1') 
                    ->get(); 
            // dd($ticketsVendidos);
            $cantidadVentasReg=0;
            foreach($ticketsVendidos as $vendidosTic ){
                $cantidadVentasReg += intval($vendidosTic->cantidad);

            }
            $tickets_vendidos_bd= intval($cantidadVentasReg);
            $tickets_asignados=intval($asignados->cantidad);
            $tickets_pendientes_venta=$tickets_asignados-$tickets_vendidos_bd; 
            $tickets_mikrotick=count($data);

            
             if($tickets_vendidos_bd==$tickets_asignados ){
                        DB::table('tickets_asignados_det')
                        ->where('item',$asignados->item)
                        ->update([ 
                            'estado'            => '0',  
                        ]); 
                        $registro="SI" ;
            }
            if( $tickets_vendidos_bd<$tickets_asignados and $tickets_pendientes_venta >$tickets_mikrotick ){
                $tickets_venta_registrar= $tickets_pendientes_venta-$tickets_mikrotick;
                DB::table('ticket_venta')
                ->insert([  
                            'id_tickets_asign'        => $asignados->item, 
                            'idusuario'               => $asignados->idtrabajador,  
                            'cantidad'                => $tickets_venta_registrar,
                            'precio'                  => $asignados->precio, 
                            'idperfil'                => $asignados->idperfil,    
                            'estado'                  =>'1', 
                            'fecha_creacion'          =>date('Y-m-d h:m:s')  
                ]);
            } 
            
                
                $codigo=0;
                $cantidadTotalAsignados=0; 
                $totalVentas=0;
                $idperfil_det=0;
                $cantidadPerfilAsignado=0;
                $ventasDePerfil=0;

                $ticketsCodigos=DB::table ('tickets_asignados_det')
                ->select('tickets_asignados.*')         
                ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
                ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
                ->where('tickets_asignados_det.item',$asignados->item) 
                ->get();  
                foreach($ticketsCodigos as $codigos){
                    $cantidadTotalAsignados         =$codigos->tickets_cant;
                    $codigo                         =$codigos->codigo;   
                }  
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
                // dd($totalVentas,$cantidadTotalAsignados);
        
                if($totalVentas==$cantidadTotalAsignados){
                // dd("ingreso a guardar");
                    DB::table('tickets_asignados')
                    ->where('codigo',$codigo)
                    ->update([ 
                        'estado'            => '3',  
                    ]);
                } 

        }    
           return response()->json([
                'EstadoTicket' => $registro  
            ]);
    }
    public function showSaldoTickets(){
        $arrayDatos=[];  
        $cont = 0;
        $contadorElementos=0; 
        $vendedor=DB::table ('users')
                ->select('users.*')         
                ->join( 'tickets_asignados_det','tickets_asignados_det.idtrabajador','=','users.id') 
                ->where([
                    ['users.idtipo','=','VEN'],
                    ['tickets_asignados_det.estado','=','1']
                ]) 
                ->distinct()
                ->get(); 
        $perfiles = DB::table('perfiles')-> get();  

        $ARRAY=[];
        $API = new routeros_api();
        $API->debug = false;
        $router = DB::table('router')->where('idrouter','R01')->get();  
        
        foreach ($router as $rou) {//--------trae la informaciòn
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $ARRAY = $API->comm("/ip/hotspot/user/print");
                //$collection = Collection::make($ARRAY); 

                $API->disconnect();
            }else{
                echo "No se pudo conectar al mikrotik";
            }
        }
        $ticketsAsignados=DB::table ('tickets_asignados_det') 
                ->where([ 
                    ['estado','=',1]
                ]) 
                ->get();  
        
        foreach($ticketsAsignados as $asignados){ 
            //  dd($asignados);
            $data = [];
            foreach($ARRAY as $valor){ 
                    if(isset($valor['name']) and substr($valor['name'],0,strlen($asignados->codigo_alterno)) == trim($asignados->codigo_alterno)and isset($valor['profile']) ){  
                        $cont++; 
                        foreach($perfiles as $perfilAs){
                            //   dd($perfilAs);
                            if($perfilAs->name==$valor['profile']){
                                if($asignados->idperfil ==$perfilAs->idperfil ){
                                    array_push($data,[
                                        'id'        => $cont,
                                        'nombre'    => $valor['name'],
                                        'plan'      => $valor['profile'],
                                        'perfil'    =>$perfilAs->idperfil
                                    ]); 

                                }
                                
                                      
                            } 
                        }      
                    } 
            }  
            $ticketsVendidos = DB::table ('ticket_venta as venta') 
                    ->select('venta.cantidad','asig.item','asig.precio')
                    ->join( 'tickets_asignados_det as asig','asig.item','=','venta.id_tickets_asign') 
                    ->where('asig.item',$asignados->item) 
                    ->where('venta.estado','1') 
                    ->get(); 
            // dd($ticketsVendidos);
            $cantidadVentasReg=0;
            foreach($ticketsVendidos as $vendidosTic ){
                $cantidadVentasReg += intval($vendidosTic->cantidad);

            }
            $tickets_vendidos_bd= intval($cantidadVentasReg);
            $tickets_asignados=intval($asignados->cantidad);
            $tickets_pendientes_venta=$tickets_asignados-$tickets_vendidos_bd; 
            $tickets_mikrotick=count($data); 
            $diferencia= $tickets_asignados-$tickets_mikrotick;
            if ($diferencia <1){
                        $diferencia =0; 
                    } 

            $nombre=null;
            $id=null;
             $vendedorAsig=DB::table ('users')->where('id',intval($asignados->idtrabajador))->get();  
            foreach( $vendedorAsig as $vend){
                $nombre=$vend->nombre." ".$vend->apellidos;
                $id=$vend->id; 
            }
            $cont++;
            $PerfilAsignadoNom=null;
            $ticketsCodigosAsig=DB::table ('tickets_asignados_det')
                ->select('tickets_asignados.*')         
                ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
                ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
                ->where('tickets_asignados_det.item',$asignados->item) 
                ->get();  
             foreach( $ticketsCodigosAsig as $asigna){
                $PerfilAsignadoNom=$asigna->descripcion ;
                
            }
            // dd($ticketsCodigos1);
            $contadorElementos+=1;

            array_push($arrayDatos,[
                        'cont'=>$contadorElementos, 
                        'nombre'    => $nombre,
                        'PerfilAsignado'=> $PerfilAsignadoNom,
                        'id'        => $id,
                        'asignados' =>$asignados->cantidad,
                        'cod_alterno'=>$asignados->codigo_alterno,
                        'saldo'      =>$tickets_pendientes_venta,
                        'item'      =>$asignados->item,
                        'diferencia'   =>$diferencia 
            ]); 

        } 
        $puntoVenta = DB::table('zonas')->where('estado',1)-> get(); 
 
        return view('forms.asignarTickets.saldoTickets.lstSaldoTicketsAsignados2',[ 
            'arrayDatos'   =>$arrayDatos,
            'puntoDeVenta'   =>$puntoVenta,
            'vendedores'   =>$vendedor
        ]);
    } 



    
}
