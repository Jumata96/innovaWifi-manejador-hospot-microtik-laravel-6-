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
        // dd("ingresa");
        $asignados=0;
        $nombre=null; 
        $alterno=null; 
        $data = [];
        $dataFiltrada = []; 
        $cont = 0;
        $saldoPrecio=0; 
        $asignadosPrecio=0; 
         $saldoPrecio=0;
         $vendedor=DB::table ('users')->where('id',$id)->get();  
         foreach ($vendedor as  $user) {
             $nombre =$user->nombre." ".$user->apellidos;
             $alterno=$user->cod_alterno;
         }    
        $ticketCom = new TicketsController();  
        $data=$ticketCom->TicketsMikroPorVendedor(strval($alterno),intval($id));  
        $ticketsAsignados=DB::table ('tickets_asignados_det') 
         ->where([
             ['idtrabajador','=',$id],
             ['item','=',$item]

         ]) ->get(); 
            foreach ($ticketsAsignados as  $ticket) { 
                $asignadosPrecio =intval($ticket->cantidad)*intval($ticket->precio); 
                foreach ($data as  $dataArray) {
                    if($ticket->idperfil==$dataArray['perfil']){ 
                        $cont++;
                        array_push($dataFiltrada,[
                            'id'        => $cont,
                            'nombre'    => $dataArray['nombre'],
                            'plan'      => $dataArray['plan'],
                            'precio'    => $ticket->precio,
                            'target'    => $dataArray['target']
                        ]);  
                        $saldoPrecio+=$ticket->precio;
                        

                    } 
                } 
            }   
        $usuarios = DB::table('users')->where('id',$id)->get();  
        $puntoVenta = DB::table('zonas')->where('estado',1)-> get();  
        return view('forms.asignarTickets.saldoTickets.saldoTicketsVendedor',[
             
            'usuarios'         =>$usuarios,
            'puntoVenta'       =>$puntoVenta, 
            'asignadosPrecio'  =>$asignadosPrecio,
            'saldoPrecio'      =>$saldoPrecio,
            'data'            =>$dataFiltrada

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
        $from = $from->subDay(1);// $to = $to->addDay(1); 
 
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

            $ticketsVendidos = DB::table('ticket_venta') 
            ->select('ticket_venta.idusuario','tickets_asignados_perfil_det.idperfil_det','tickets_asignados.idzona','ticket_venta.idperfil','ticket_venta.precio','ticket_venta.cantidad','ticket_venta.fecha_creacion','ticket_venta.estado','tickets_asignados.descripcion',DB::raw('tickets_asignados_det.cantidad  as cantidadAsignados'),DB::raw('tickets_asignados_det.estado  as estadoTicketAsig') ) 
            ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
            ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
            ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
            ->where('ticket_venta.estado','1')
            ->whereIn('ticket_venta.idusuario',$vendedores)
             ->whereBetween('ticket_venta.fecha_creacion', array($from, $to)) 
            ->get();  
        }else if($request->PuntoVentaFiltrado!=""||$request->PuntoVentaFiltrado!=null) {
            // dd("pasa");
                $ticketsVendidos = DB::table('ticket_venta')//consulta para saber los vendidos de los tickets activos por cleinte  
                ->select('ticket_venta.idusuario','tickets_asignados_perfil_det.idperfil_det','tickets_asignados.idzona','ticket_venta.idperfil','ticket_venta.precio','ticket_venta.cantidad','ticket_venta.fecha_creacion','ticket_venta.estado','tickets_asignados.descripcion',DB::raw('tickets_asignados_det.cantidad  as cantidadAsignados'),DB::raw('tickets_asignados_det.estado  as estadoTicketAsig') ) 
                ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
                ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
                ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
                ->where('ticket_venta.estado','1')
                ->where('tickets_asignados.idzona',$request->PuntoVentaFiltrado)
                ->whereBetween('ticket_venta.fecha_creacion', array($from, $to)) 
                ->get();   

        }else{ 
            $ticketsVendidos = DB::table('ticket_venta')//consulta para saber los vendidos de los tickets activos por cliente  
                ->select('ticket_venta.idusuario','tickets_asignados_perfil_det.idperfil_det','tickets_asignados.idzona','ticket_venta.idperfil','ticket_venta.precio','ticket_venta.cantidad','ticket_venta.fecha_creacion','ticket_venta.estado','tickets_asignados.descripcion',DB::raw('tickets_asignados_det.cantidad  as cantidadAsignados'),DB::raw('tickets_asignados_det.estado  as estadoTicketAsig') ) 
                ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign')
                ->join( 'tickets_asignados_perfil_det','tickets_asignados_perfil_det.idperfil_det','=','tickets_asignados_det.idperfil_det')
                ->join('tickets_asignados','tickets_asignados.codigo','=','tickets_asignados_perfil_det.codigo') 
                ->where('ticket_venta.estado','1')
                ->whereBetween('ticket_venta.fecha_creacion', array($from, $to)) 
                ->get();   
        }  

        // dd($ticketsVendidos);
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

        /* foreach($ticketsVendidos as $vendidos){ 
            $total +=intval($vendidos->precio)*intval($vendidos->cantidad);
        }  */
        
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
                         $Cod_Alterno=$user->cod_alterno;
                         foreach($zonas  as $punto){
                             if($punto->id==$ticketF->idzona){
                                  $Punto_de_Venta=$punto->nombre; 
                             } 
                         } 
                    }  
                }
                $ticket = new TicketsController(); 
                $data=$ticket->TicketsMikroPorVendedor(strval($Cod_Alterno),intval($ticketF->idusuario)); 
                 $Ticket=$ticketF->descripcion;

                 foreach($perfiles  as $perfil){
                    if($perfil->idperfil==$ticketF->idperfil){ 
                         $Plan=$perfil->name;
                         $idPlan=$perfil->idperfil; 
                         $Precio=$perfil->precio;
                    }  
                } 
                    $cont=0;
                 foreach($data  as $datosfiltrados){
                     if($datosfiltrados['perfil']==$idPlan ){
                          $cont++ ;
                     } 
                 }
                
                //   dd($ticketF); 
                $Total_Asignados=$ticketF->cantidadAsignados; 
                $Saldo_Total=$cont; 
                $Total_Vendidos=$Total_Asignados-$Saldo_Total; 
                 if ($Total_Vendidos >$Total_Asignados){
                        $Total_Vendidos =$Total_Asignados; 
                    } 
                // dd($Total_Asignados,$Saldo_Total, $Total_Vendidos);

                $Total_AsignadosMonto=$Total_Asignados*$Precio;
                $Saldo_TotalMonto=$Saldo_Total*$Precio;
                $Total_VendidosMonto=$Total_Vendidos*$Precio; 
                $Cantidad_Venta=$ticketF->cantidad;
                $Subtotal=$ticketF->cantidad*$Precio;
                $Fecha_de_venta=$ticketF->fecha_creacion;
                $Estado=$ticketF->estado;
                 /* dd($Cod_Alterno,$Vendedor,$Punto_de_Venta,$Ticket,$Plan,$Precio,$Total_Asignados,$Saldo_Total,$Total_Vendidos,$Total_AsignadosMonto,
                 $Saldo_TotalMonto,$Total_VendidosMonto,$Fecha_de_venta,$Cantidad_Venta,$Subtotal, $Estado); */
                // dd($ticketF); 
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
        $registro="NO";
        $ARRAY=[];
        $arrayDatos=[]; 
        $data = [];
        $API = new routeros_api();
        $API->debug = false;
        $router = DB::table('router')->where('idrouter','R01')->get();  
        $perfiles = DB::table('perfiles')-> get(); 
        foreach ($router as $rou) {
            if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                $ARRAY = $API->comm("/ip/hotspot/user/print"); 
            }
        } 
        $vendedor=DB::table ('users')->where('idtipo','VEN')->get();
        foreach ($vendedor as  $user) { 
            $id=$user->id; 
            $nombre =$user->nombre." ".$user->apellidos ;  
            $alterno=$user->cod_alterno; 
            $cont = 0;  
            $ticketsAsignados=DB::table('tickets_asignados_det') 
            ->where('idtrabajador',$id) 
            ->where([
                ['idtrabajador','=',$id], 
                ['estado','=',1]
            ])->get();
             foreach($ARRAY as $valor){ 
                 if(isset($valor['name']) and substr($valor['name'],0,strlen($alterno)) == trim($alterno)and isset($valor['profile']) ){  
                      $cont++; 
                      foreach($perfiles as $perfilAs){
                        //   dd($perfilAs);
                          if($perfilAs->name==$valor['profile']){
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
            $prueba=[];
            //  dd($data,"f",$ticketsAsignados);
            foreach ($ticketsAsignados as  $ticket) {
                $contador=0;
                $planMK=null;
                $ticketsBd=0;
                 foreach ($data as  $datosFiltrados) {
                     $asignados=$ticket->cantidad; 
                     $perfil=$ticket->idperfil;
                    //  dd($datosFiltrados);
                    if($datosFiltrados['perfil']==$ticket->idperfil){
                        $contador++; 
                        $planMK=$datosFiltrados['plan'];
                    } 
                 }  
                $ticketsVendidos = DB::table ('ticket_venta') 
                ->select('ticket_venta.cantidad','tickets_asignados_det.item','tickets_asignados_det.precio')
                ->join( 'tickets_asignados_det','tickets_asignados_det.item','=','ticket_venta.id_tickets_asign') 
                ->where('item',$ticket->item) 
                ->where('ticket_venta.estado','1') 
                ->get();
                foreach ($ticketsVendidos as  $tikVen) {
                     $ticketsBd+= $tikVen->cantidad; 
                 }  
                //dd($ticketsBd); 
                    array_push($prueba,[ 
                                    'cantidadticketAsig'    =>$ticket->cantidad,  
                                    'cantidadMikrotik'  => $contador,
                                    'cantidadVendidosBd' => $ticketsBd,
                                    'cantidadVendidos'  =>$ticket->cantidad-$contador, 
                                    'precio'    =>$ticket->precio,
                                    'usuarioId' => $id,
                                    'idPerfilDet'=>$ticket->idperfil_det,
                                    'idPerfilPlan'=>$ticket->idperfil,
                                    'idTicketAsignado'=> $ticket->item,
                                    'perfilNombre'=>$planMK,
                                    'nombre'    => $nombre 
                     ]);  
                //   dd($ticket);
            } 

            //  dd($prueba);
            foreach ($prueba as  $datosPerfil) { 
               
                if($datosPerfil['cantidadVendidosBd']==$datosPerfil['cantidadticketAsig'] ){
                     DB::table('tickets_asignados_det')
                    ->where('item',$datosPerfil['idTicketAsignado'])
                    ->update([ 
                        'estado'            => '0',  
                    ]); 
                    $registro="SI" ;
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
                ->where('tickets_asignados_det.item',$datosPerfil['idTicketAsignado']) 
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

                

                
               

                if($datosPerfil['cantidadVendidosBd']<$datosPerfil['cantidadticketAsig'] AND$datosPerfil['cantidadVendidos']!=$datosPerfil['cantidadVendidosBd']){
                     $cantidadRegistrar=$datosPerfil['cantidadVendidos']-$datosPerfil['cantidadVendidosBd'] ;
                    // dd("ingresa",$datosPerfil,$prueba);
                    DB::table('ticket_venta')
                    ->insert([  
                        'id_tickets_asign'        => $datosPerfil['idTicketAsignado'], 
                        'idusuario'               => $datosPerfil['usuarioId'], 
                        'cantidad'                => $cantidadRegistrar, 
                        'precio'                  => $datosPerfil['precio'], 
                        'idperfil'                => $datosPerfil['idPerfilPlan'],   
                        'estado'                  =>'1', 
                        'fecha_creacion'          =>date('Y-m-d h:m:s')  
                    ]);  

                    
                }         
            }  
               


        }  
        // dd($ARRAY);
        
 
        // return response()->json($ARRAY);   
           return response()->json([
                'EstadoTicket' => $registro  
            ]);
    }
    public function showSaldoTickets( ){
        $arrayDatos=[];  
        $cont = 0;
         $vendedor=DB::table ('users')->where('idtipo','VEN')->get();  
         foreach ($vendedor as  $user) { 
            $asignados=0;
            $nombre=null; 
            $alterno=null; 
            $data = [];
            $plan = null;
            $precio = null;
            $target = null;
            
            $id=$user->id;  
             $nombre =$user->nombre." ".$user->apellidos ;  
             $alterno=$user->cod_alterno;  
             
             $perfiles = DB::table('perfiles')-> get();   
            $ticketCom = new TicketsController(); 

            $data=$ticketCom->TicketsMikroPorVendedor(strval($alterno),intval($id));  
            $ticketsAsignados=DB::table ('tickets_asignados_det') 
                ->where([
                    ['idtrabajador','=',$id],
                    ['estado','=',1]
                ]) 
                ->get();  

            foreach ($ticketsAsignados as  $ticketsA) { 
                $nombrePerfil=null;
                $contadorTickets = 0; 
                foreach ($data as  $dataMik) {
                    // dd($dataMik);
                    if($ticketsA->idperfil==$dataMik['perfil']){
                         $contadorTickets++;
                         $nombrePerfil=$dataMik['plan'];
                    }
                } 
                     $asignados=$ticketsA->cantidad;
                     $saldoVentas=$contadorTickets;
                     $diferencia =$asignados-$saldoVentas;
                    //  dd($ticketsA);
                    if ($diferencia <1){
                        $diferencia =0; 
                    } 
                     $cont+=1;
                    array_push($arrayDatos,[
                        'cont'=>$cont, 
                        'nombre'    => $nombre,
                        'PerfilAsignado'=>$nombrePerfil,
                        'id'        => $id,
                        'asignados' =>$asignados,
                        'cod_alterno'=>$alterno,
                        'saldo'      =>$saldoVentas,
                        'item'      =>$ticketsA->item,
                        'diferencia'   =>$diferencia 
                    ]);  
            }  
            // dd($arrayDatos);
         }   
         
         $puntoVenta = DB::table('zonas')->where('estado',1)-> get(); 

          $vendedorConSaldo=DB::table ('users')
          ->select('users.*','tickets_asignados_det.estado')
          ->join( 'tickets_asignados_det','tickets_asignados_det.idtrabajador','=','users.id')
          ->where([
               ['users.idtipo','=','VEN'],
               ['tickets_asignados_det.estado','=','1'] 
          ])->distinct()
          ->get();
        //  dd($vendedorConSaldo);
       
    
        return view('forms.asignarTickets.saldoTickets.lstSaldoTicketsAsignados2',[ 
            'arrayDatos'   =>$arrayDatos,
            'puntoDeVenta'   =>$puntoVenta,
            'vendedorConSaldo'=>$vendedorConSaldo,
            'vendedores'   =>$vendedor

        ]);
    }



    
}
