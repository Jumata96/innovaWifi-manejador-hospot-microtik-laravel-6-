<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection as Collection;
// use Barryvdh\DomPDF\Facade as PDF;
use Auth;
use Validator;
use PDF;  
use DB;  


class FichasVendidasController extends Controller
{
      //
    public function index02(){ 

        $ArrayZonas=[];  
        $datosTabla=[];  
         $totalesEmpresa=[]; 
         $totaleVendedores=0; 
        $contadorZonas=0;
         $tAsigandosEmpresa   = 0;
         $tVendidosEmpresa      = 0;
         $tSaldoEmpresa       = 0; 
         $tAsigandosEmpresaD   = 0;//D==dinero
         $tVendidoEmpresaD     = 0;
         $tSaldoEmpresaD      = 0;  

         $puntosVenta  =DB::table('zonas')->where('estado',1)->get();   
        foreach ($puntosVenta as $puntosV) { 
            $contadorZonas+=1;
            $contadorVendedores=0;
            $vendedores=null;
            $contadorArrayTabla=0;  
            $tAsigandosZona    = 0;
            $tVendidoZona      = 0;
            $tSaldoZona       = 0; 
            $tAsigandosZonaD    = 0;//D==dinero
            $tVendidoZonaD      = 0;
            $tSaldoZonaD       = 0; 
            // dd($puntosV->id);
            $vendedores=DB::table ('users')->where('idzona',$puntosV->id)->where('idtipo','VEN')->get();  

            foreach ($vendedores as  $vendedor) {
                $contadorArrayTabla+=1;   
                $TasignadoTabrajdor =0;
                $TvendidoTrabrajador=0;
                $TsaldoTrabajador   =0;
                $TasignadoTrabajadorD    =0;//DINERO
                $TvendidosTrabajadorD    =0;
                $TsaldoTrabajadorD      =0; 
                $tickets_asignados_det=null; 
                        $tickets_asignados_det=DB::table ('tickets_asignados_det')  
                        ->where('idtrabajador', $vendedor->id)
                        ->where('estado',0)
                        ->get();    
                        // dd($tickets_asignados_det,$vendedor);
                        foreach ($tickets_asignados_det as  $ticketAsignados) {
                            // dd($tickets_asignados_det,$vendedor); 
                            // dd($tickets_asignados_det);
                            $TasignadoPerfil    =null;
                            $TvendidosPerfil    =null;
                            $TsaldoPerfil      =null; 
                            $CostoTicketAsignado  = null;
                            $codigoAlterno      =$ticketAsignados->codigo_alterno;
                            $perfil=DB::table('perfiles')->where('idperfil',intval($ticketAsignados->idperfil))->get();  
                            //  dd($perfil);
                            $perfilasignado     =$perfil[0]->name; 
                            $TasignadoPerfil    =$ticketAsignados->cantidad;  
                            //contamos los tickets vendidos 
                            $ticket_venta=DB::table('ticket_venta')->where('id_tickets_asign',intval($ticketAsignados->item))->where('estado',1)->get();   
                            if($perfil!=null){
                                $contadorVendidos=0;
                                foreach ($ticket_venta as  $ventas) {
                                    $contadorVendidos=$contadorVendidos+$ventas->cantidad;
                                } 
                                $TvendidosPerfil = $contadorVendidos;
                            }else{
                                $TvendidosPerfil =0;
                            }
                            $TsaldoPerfil =intval($TasignadoPerfil) - intval($TvendidosPerfil);
                            if($TsaldoPerfil<0){
                                $TsaldoPerfil =0;
                            }
                            if($TsaldoPerfil>$TasignadoPerfil){
                                $TsaldoPerfil=$TasignadoPerfil;
                            }  
                            // if($TasignadoPerfil==0 || $TsaldoPerfil==0){ 
                            //     DB::table('tickets_asignados_det')
                            //     ->where('item', intval($ticketAsignados))
                            //     ->update('estado' => 0); 
                            // }
                            $TasignadoTabrajdor  += $TasignadoPerfil;
                            $TvendidoTrabrajador += $TvendidosPerfil;
                            $TsaldoTrabajador    += $TsaldoPerfil;
                            // dd($ticketAsignados->precio);
                            $TasignadoTrabajadorD    +=intval($TasignadoPerfil)*floatval($ticketAsignados->precio) ;
                            $TvendidosTrabajadorD    +=intval($TvendidosPerfil)*floatval($ticketAsignados->precio) ;
                            $TsaldoTrabajadorD      +=intval($TsaldoPerfil)*floatval($ticketAsignados->precio) ;
                        }   
                $tAsigandosZona    += $TasignadoTabrajdor;
                $tVendidoZona      += $TvendidoTrabrajador;
                $tSaldoZona        += $TsaldoTrabajador; 
                $tAsigandosZonaD   += $TasignadoTrabajadorD;//D==dinero
                $tVendidoZonaD     += $TvendidosTrabajadorD;
                $tSaldoZonaD       += $TsaldoTrabajadorD;   
            }  
           array_push($ArrayZonas,[
             'id'        => $puntosV->id,
             'numero'    => $contadorZonas,
             'puntoVenta'    => $puntosV->nombre,
             'trabajadores'    =>  count($vendedores),
             'asigandos'      => $tAsigandosZona,
             'vendido'      => $tVendidoZona,
             'saldo'      => $tSaldoZona,
             'tAsigandos'      => $tAsigandosZonaD,
             'tVendido'      => $tVendidoZonaD,
             'tSaldo'      => $tSaldoZonaD,
            ]);  
            $tAsigandosEmpresa   += $tAsigandosZona;
            $tVendidosEmpresa      += $tVendidoZona;
            $tSaldoEmpresa       += $tSaldoZona; 
            $tAsigandosEmpresaD   += $tAsigandosZonaD;//D==dinero
            $tVendidoEmpresaD     += $tVendidoZonaD;
            $tSaldoEmpresaD      += $tSaldoZonaD; 
            $totaleVendedores    +=count($vendedores); 

        }  
        array_push($totalesEmpresa,[
             'TotalAsignados'    => $tAsigandosEmpresa, 
             'TotalVendidos'     => $tVendidosEmpresa, 
             'TotalSaldo'        => $tSaldoEmpresa, 
             'TotalAsigDirero'    => $tAsigandosEmpresaD, 
             'TotalVendDirero'    => $tVendidoEmpresaD, 
             'TotalSaldDirero'    => $tSaldoEmpresaD, 
            //  'Nombre'             => $zonas[0]->nombre, 
              'Trabajadores'       => $totaleVendedores 
        ]);  
            // dd($ArrayZonas);
        return view('forms.fichasVendidas.listar.lstTicketsAsignados',[ 
            'arrayZonas'             =>$ArrayZonas, 
            'totalesEmpresa'        =>$totalesEmpresa

        ] );

    } 
   public function FichasPorZona($id){ 
    //    dd('llego');
         $datosTabla=[];  
         $datosZona=[];  
         $contadorArrayTabla=0;  
         $tAsigandosZona    = 0;
         $tVendidoZona      = 0;
         $tSaldoZona       = 0; 
         $tAsigandosZonaD    = 0;//D==dinero
         $tVendidoZonaD      = 0;
         $tSaldoZonaD       = 0;  
        $zonas  =DB::table('zonas')->where('id',$id)->get(); 
        $vendedores=DB::table ('users')->where('idzona',$id)->where('idtipo','VEN')->get(); 
        //  dd($vendedores);
        $perfilesDispo=DB::table ('perfiles')->where('estado',1)->get(); 
        //   dd($perfilesDispo);
        foreach ($vendedores as  $vendedor) {
            $contadorArrayTabla+=1; 
            $TasignadoTabrajdor =0;
            $TvendidoTrabrajador=0;
            $TsaldoTrabajador   =0;
            $TasignadoTrabajadorD    =0;//DINERO
            $TvendidosTrabajadorD    =0;
            $TsaldoTrabajadorD      =0; 
            $tickets_asignados_det=null; 
                    $tickets_asignados_det=DB::table ('tickets_asignados_det')  
                    ->where('idtrabajador', $vendedor->id)
                    ->where('estado',0)
                    ->get();    
                    foreach ($tickets_asignados_det as  $ticketAsignados) {
                        $TasignadoPerfil    =null;
                        $TvendidosPerfil    =null;
                        $TsaldoPerfil      =null; 
                        $CostoTicketAsignado  = null;
                        $codigoAlterno      =$ticketAsignados->codigo_alterno;
                        $perfil=DB::table('perfiles')->where('idperfil',intval($ticketAsignados->idperfil))->get();  
                        //   dd($perfil);
                        $perfilasignado     =$perfil[0]->name; 
                        $TasignadoPerfil    =$ticketAsignados->cantidad;  
                        //contamos los tickets vendidos 
                        $ticket_venta=DB::table('ticket_venta')->where('id_tickets_asign',intval($ticketAsignados->item))->where('estado',1)->get();   
                        if($perfil!=null){
                            $contadorVendidos=0;
                            foreach ($ticket_venta as  $ventas) {
                                $contadorVendidos=$contadorVendidos+$ventas->cantidad;
                            } 
                            $TvendidosPerfil = $contadorVendidos;
                            // dd($TvendidosPerfil );
                        }else{
                            $TvendidosPerfil =0;
                        }
                        // dd($TasignadoPerfil,$TvendidosPerfil);
                        // if ($TasignadoPerfil<$TvendidosPerfil) {
                        //     $TvendidosPerfil=$TasignadoPerfil; 
                        // } 
                        // dd($TasignadoPerfil,$TvendidosPerfil);
                        
                        $TsaldoPerfil =intval($TasignadoPerfil) - intval($TvendidosPerfil);
                        if($TsaldoPerfil<0){
                            $TsaldoPerfil =0;
                        }
                        if($TsaldoPerfil>$TasignadoPerfil){
                            $TsaldoPerfil=$TasignadoPerfil;
                        }  
                        // dd('');
                        //  if($TasignadoPerfil==0 || $TsaldoPerfil==0){ 
                        //         DB::table('tickets_asignados_det')
                        //         ->where('item',$ticketAsignados->item)
                        //         ->update(['estado' => 0]); 
                        // }
                        //  dd('llego');
                        $TasignadoTabrajdor  += $TasignadoPerfil;
                        $TvendidoTrabrajador += $TvendidosPerfil;
                        $TsaldoTrabajador    += $TsaldoPerfil;
                        $TasignadoTrabajadorD    +=intval($TasignadoPerfil)*floatval($ticketAsignados->precio) ;
                        $TvendidosTrabajadorD    +=intval($TvendidosPerfil)*floatval($ticketAsignados->precio) ;
                        $TsaldoTrabajadorD      +=intval($TsaldoPerfil)*floatval($ticketAsignados->precio) ;
                        //  dd('paso');
                    }     
            array_push($datosTabla,[
             'numero'    => $contadorArrayTabla,
             'id'           => $vendedor->id,
             'nombre'       => $vendedor->nombre." ".$vendedor->apellidos,
             'codigoAlterno'=>$vendedor->cod_alterno,
             'asignado'    => $TasignadoTabrajdor,
             'vendido'      => $TvendidoTrabrajador,
             'saldo'        => $TsaldoTrabajador,
             'asignadoD'    => $TasignadoTrabajadorD,
             'vendidoD'      => $TvendidosTrabajadorD,
             'saldoD'        => $TsaldoTrabajadorD, 
            ]); 
            $tAsigandosZona    += $TasignadoTabrajdor;
            $tVendidoZona      += $TvendidoTrabrajador;
            $tSaldoZona        += $TsaldoTrabajador; 
            $tAsigandosZonaD   += $TasignadoTrabajadorD;//D==dinero
            $tVendidoZonaD     += $TvendidosTrabajadorD;
            $tSaldoZonaD       += $TsaldoTrabajadorD;   
        }
        //  dd($datosTabla);
        array_push($datosZona,[
             'ZonaTotalAsignados'    => $tAsigandosZona, 
             'ZonaTotalVendidos'     => $tVendidoZona, 
             'ZonaTotalSaldo'        => $tSaldoZona, 
             'ZonaTotalAsigDirero'    => $tAsigandosZonaD, 
             'ZonaTotalVendDirero'    => $tVendidoZonaD, 
             'ZonaTotalSaldDirero'    => $tSaldoZonaD, 
             'ZonaNombre'             => $zonas[0]->nombre, 
             'ZonaTrabajadores'       => count($vendedores), 
        ]);  
        // dd($datosZona);

        return view('forms.fichasVendidas.ticketsZona.lstTicketsZona',[  
            'arrayTabla'             =>$datosTabla,
            'arrayZona'             =>$datosZona,
            'vendedores'           =>$vendedores,
            'perfiles'             =>$perfilesDispo

        ] );
   }    
   public function FichasPorTrabajador($id){ 
    //    dd('llego');
         $datosTabla=[];  
         $datosZona=[];  
         $contadorArrayTabla=0;  
         $TasignadoTabrajdor =0;
         $TvendidoTrabrajador=0;
         $TsaldoTrabajador   =0;
         $TasignadoTrabajadorD    =0;//DINERO
         $TvendidosTrabajadorD    =0;
         $TsaldoTrabajadorD      =0; 
          
         $vendedores=DB::table ('users')->where('id',$id)->where('idtipo','VEN')->get(); 
         $zonas  =DB::table('zonas')->where('id', $vendedores[0]->idzona)->get();
        //  dd($vendedores);
        $perfilesDispo=DB::table ('perfiles')->where('estado',1)->get(); 
        //  dd($perfilesDispo);
        foreach ($vendedores as  $vendedor) { 
            $tickets_asignados_det=null; 
                    $tickets_asignados_det=DB::table ('tickets_asignados_det')  
                    ->where('idtrabajador', $vendedor->id)
                    ->where('estado',0)
                    ->get();    
                    foreach ($tickets_asignados_det as  $ticketAsignados) {
                        // dd('llego');
                        $contadorArrayTabla+=1; 
                        $TasignadoPerfil    =0;
                        $TvendidosPerfil    =0;
                        $TsaldoPerfil      =0; 
                        $CostoTicketAsignado  = null;
                        $codigoAlterno      =$ticketAsignados->codigo_alterno;
                        $perfil=DB::table('perfiles')->where('idperfil',intval($ticketAsignados->idperfil))->get();  
                        //  dd($perfil);
                        $perfilasignado     =$perfil[0]->name; 
                        $TasignadoPerfil    =$ticketAsignados->cantidad;  
                        //contamos los tickets vendidos 
                        $ticket_venta=DB::table('ticket_venta')->where('id_tickets_asign',intval($ticketAsignados->item))->where('estado',1)->get();   
                        if($perfil!=null){
                            $contadorVendidos=0;
                            foreach ($ticket_venta as  $ventas) {
                                $contadorVendidos=$contadorVendidos+$ventas->cantidad;
                            } 
                            $TvendidosPerfil = $contadorVendidos;
                        }else{
                            $TvendidosPerfil =0;
                        }
                        $TsaldoPerfil =intval($TasignadoPerfil) - intval($TvendidosPerfil);
                        if($TsaldoPerfil<0){
                            $TsaldoPerfil =0;
                        }
                        if($TsaldoPerfil>$TasignadoPerfil){
                            $TsaldoPerfil=$TasignadoPerfil;
                        }  
                        //  if($TasignadoPerfil==0 || $TsaldoPerfil==0){ 
                        //         DB::table('tickets_asignados_det')
                        //         ->where('item', intval($ticketAsignados->item))
                        //         ->update(['estado' => 0]); 
                        // }
                        $TasignadoTabrajdor  += $TasignadoPerfil;
                        $TvendidoTrabrajador += $TvendidosPerfil;
                        $TsaldoTrabajador    += $TsaldoPerfil;
                        $TasignadoTrabajadorD    +=intval($TasignadoPerfil)*floatval($ticketAsignados->precio) ;
                        $TvendidosTrabajadorD    +=intval($TvendidosPerfil)*floatval($ticketAsignados->precio) ;
                        $TsaldoTrabajadorD      +=intval($TsaldoPerfil)*floatval($ticketAsignados->precio) ;

                        array_push($datosTabla,[
                        'numero'    => $contadorArrayTabla,
                        'nombre'    => $perfil[0]->name, 
                        'perfilAsignado'    => $ticketAsignados->item,
                        'precio'    => $ticketAsignados->precio, 
                        'id'           => $vendedor->id, 
                        'codigoAlterno'=>$vendedor->cod_alterno,
                        'asignado'     => $TasignadoPerfil,
                        'vendido'      => $TvendidosPerfil,
                        'saldo'        => $TsaldoPerfil,
                        'asignadoD'    => intval($TasignadoPerfil)*floatval($ticketAsignados->precio) ,
                        'vendidoD'     =>intval($TvendidosPerfil)*floatval($ticketAsignados->precio) ,
                        'saldoD'       => intval($TsaldoPerfil)*floatval($ticketAsignados->precio), 
                        ]);  
                    }      
        }
        // dd($datosTabla);
 
         array_push($datosZona,[
             'TrabajadoresTotalAsignados'    => $TasignadoTabrajdor, 
             'TrabajadoresTotalVendidos'     => $TvendidoTrabrajador, 
             'TrabajadoresTotalSaldo'        => $TsaldoTrabajador, 
             'TrabajadoresTotalAsigDirero'    => $TasignadoTrabajadorD, 
             'TrabajadoresTotalVendDirero'    => $TvendidosTrabajadorD, 
             'TrabajadoresTotalSaldDirero'    => $TsaldoTrabajadorD, 
             'TrabajadorNombre'             => $vendedores[0]->nombre." ".$vendedores[0]->apellidos, 
             'ZonaNombre'                     => $zonas[0]->nombre, 
             'ZonaId'                     => $zonas[0]->id, 
             'Trabajadores'                   => count($vendedores), 
        ]);  
        //  dd($datosZona);


        return view('forms.fichasVendidas.ticketsTrabajador.lstTicketsTrabajador',[  
            'arrayTabla'             =>$datosTabla,
            'arrayTrabajador'             =>$datosZona,
            'vendedores'           =>$vendedores,
            'perfiles'             =>$perfilesDispo

        ] );
   } 
   public function ImprimirFichasTrabajador($id){ 
        $datosTabla=[];  
          $ARRAY=[];  
        $tickets_asignados_det=DB::table ('tickets_asignados_det')->where('item', $id)->get();  
        // $empresa=DB::table ('empresa')->get();    
        //  $ticket_venta=DB::table ('ticket_venta')->where('id_tickets_asign', $id)->limit(20)->get();  
         $ticket_venta=DB::table ('ticket_venta')->where('id_tickets_asign', $id)->get();  
         $perfiles=DB::table ('perfiles')->where('idperfil', $tickets_asignados_det[0]->idperfil)->get();  
        //  dd( $tickets_asignados_det);
            //   dd($ticket_venta,$tickets_asignados_det); 
        $i=0;
        foreach ($ticket_venta as $value) {
            // dd($value->time_pin_hospot);
            $i+=1;
            array_push($datosTabla,[ 
                      'codigo'              =>$value->codigo,
                      'id_tickets_asign'    =>$value->id_tickets_asign,
                      'cantidad'            =>$value->cantidad,
                      'precio'              =>$value->precio,
                      'idperfil'            =>$value->idperfil,
                      'estado'              =>$value->estado,
                      'time_pin_hospot'     =>$value->time_pin_hospot.":00",
                      'id_pin_hospot'       =>$value->id_pin_hospot,
                      'color'               =>$perfiles[0]->perfil_color,
                ]);  
            if($i==5){
                array_push($ARRAY,$datosTabla); 
                 $datosTabla=[];
                  $i=0;

            }
            
            # code...
        }

        //   dd($ARRAY);

        

 

        $pdf = PDF::loadView('forms.comprobante.cliente.lstTicketsPerfilAsigPer', compact('tickets_asignados_det','ticket_venta','ARRAY')); 
         $pdf -> setPaper ( 'Legal' , 'landscape' );
        // $pdf->setDefaultFont('Courier');
        return $pdf->download('imprimir.pdf');

 
   } 
    public function asignarTrabajadorDetalle02(Request $request){
        //    dd($request);
        $rules = array(     
            'idPerfil'     => 'required',
            'cantidad'   => 'required',
            'idVendedor'      =>'required',
        ); 
        $validator = Validator::make ( $request->all(), $rules );
        
        
        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');            
            return response()->json($var);
        } 

        // dd('llego');
         $API = new routeros_api();
         $API->debug = false;
         $id_perfil_host=null;
         $uptime_perfil_host=null;
         $codigo_vendedor=null;
         $ticket_asig_color="fafafa";
         $ticket_asig_Tiempo="00:00:00";
         $FichasController =new FichasController(); //LLAMAR FUNCIONES INTERNAS

        //  $ARRAY = null;
         $router = DB::table('router')->where('idrouter','R01')->get();

        $fechaRegistro=date('Y-m-d h:m:s') ;
        
        $perfil     =DB::table ('perfiles')->where('idperfil',$request->idPerfil )->get();  
        $vendedor   = DB::table('users') ->where('id', $request->idVendedor)->get();
        // new MaestroController();

        if( $vendedor[0]->cod_alterno==null){
            // si el vendedor no tiene cod alterno se genera
           $codigo_vendedor = $FichasController->codigoNletras(5); 
           DB::table('perfiles')
           ->where('id',$vendedor[0]->id) 
           ->update([
                'cod_alterno' =>$codigo_vendedor 
            ]); 
        }else{
            $codigo_vendedor  = $vendedor[0]->cod_alterno; 
        }
        // dd($codigo_vendedor); 
        DB::table('tickets_asignados_det')
        ->insert([
            'codigo_alterno'        =>$vendedor[0]->cod_alterno,
            'idtrabajador'      =>$vendedor[0]->id , 
            'idperfil'          => $perfil[0]->idperfil,
            'cantidad'          =>$request->cantidad,
            'precio'            =>$perfil[0]->precio,
            'fecha_creacion'    => $fechaRegistro,
            'estado'            =>0

        ]); 
            $tickets_asignados_det = DB::table('tickets_asignados_det') ->where('fecha_creacion', $fechaRegistro)->get();  
            foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) { 
                     if ($perfil[0]->id_perfil_host==null) { 

                         $ARRAY_PROFILES = $API->comm("/ip/hotspot/user/profile/print");  
                        //  dd($ARRAY_PROFILES); 
                        // echo $ARRAY_PROFILES  ;
                           foreach ($ARRAY_PROFILES as $perfiles_host) {     
                                    if($perfil[0]->name==$perfiles_host['name'] ){
                                        // dd($perfil[0]->name,$perfiles_host['name']);
                                        $id_perfil_host=$perfiles_host['.id'];
                                        $uptime_perfil_host=$perfiles_host['session-timeout'];
                                        // dd($perfiles_host['.id']);

                                         DB::table('perfiles')
                                        ->where('idperfil',intval($perfil[0]->idperfil))
                                        ->update([
                                            'id_perfil_host' =>$perfiles_host['.id']   
                                        ]); 
                                        // dd('actua');
                                    } 
                                    
                            }  
                            // dd('llego');
                     }else{
                                $perfil     =null;   
                                $perfil     =DB::table ('perfiles')->where('idperfil',$request->idPerfil )->get();  
                                // dd($perfil);

                                $ticket_asig_color=$perfil[0]->perfil_color;
                                            $ticket_asig_Tiempo= str_pad($perfil[0]->perfil_sesion_dias,2,0,STR_PAD_LEFT).':'.str_pad($perfil[0]->perfil_sesion_horas,2,0,STR_PAD_LEFT).':'.str_pad($perfil[0]->perfil_sesion_min,2,0,STR_PAD_LEFT); 
                                            // dd(str_pad($perfil[0]->perfil_sesion_dias,2,0,STR_PAD_LEFT)  );


                         $ARRAY_PROFILES = $API->comm("/ip/hotspot/user/profile/print");  
                        //  dd($ARRAY_PROFILES); 
                           foreach ($ARRAY_PROFILES as $perfiles_host) {     
                                    if($perfil[0]->id_perfil_host==$perfiles_host['.id'] ){ 
                                        $id_perfil_host=$perfiles_host['.id'];
                                        $uptime_perfil_host=$perfiles_host['session-timeout'];

                                    } 
                            }   

                            // dd($uptime_perfil_host);


                        for($i=1;$i<=$request->cantidad;$i++){ 
                                $ARRAY = null; 
                                $y = 0;
                                $codigo_generado=null;
                                $codigo_generado=null;
                                do {
                                    echo $y++;
                                    $codigo_generado = $FichasController->codigoNnumeros(10); 
                                    //  dd('ingresooo');
                                       $codigo_pin_host =$codigo_vendedor.$codigo_generado.str_pad($i,5,"0",STR_PAD_LEFT);
                                        $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                            "name" => $codigo_vendedor.$codigo_generado.str_pad($i,5,"0",STR_PAD_LEFT),
                                            "profile" => $id_perfil_host,     //jala de porfile                               
                                            "limit-uptime" => $uptime_perfil_host,//jala de porfile 
                                            // "uptime" => '0s',
                                            // "bytes-in" => '0',
                                            // "bytes-out" => '0',
                                            // "packets-in" => '0',
                                            // "packets-out" => '0',
                                            // "dynamic" => 'false',
                                            // "disabled" => 'false'
                                        )); 

                                
                                } while (is_array($ARRAY));
 
                                            DB::table('ticket_venta')
                                            ->insert([
                                                'id_tickets_asign'        =>$tickets_asignados_det[0]->item,
                                                'idusuario'               => Auth::user()->id, 
                                                'cantidad'                =>1, 
                                                'precio'                  =>$perfil[0]->precio,
                                                'idperfil'                =>$perfil[0]->idperfil,
                                                'time_pin_hospot'          =>$ticket_asig_Tiempo,
                                                
                                                // 'ticket'                  =>$vendedor[0]->cod_alterno, 
                                                // 'estado'                  =>$vendedor[0]->cod_alterno, 
                                                'id_pin_hospot'           => $codigo_pin_host,  
                                                'fecha_creacion'          => $fechaRegistro 
                                            ]);  
                                            
                        } 
                    } 
              }  
            }

             $tickets_creados_rb = DB::table('ticket_venta')
            ->where('id_tickets_asign',$tickets_asignados_det[0]->item)
            ->get(); 
            if(count($tickets_creados_rb)<=0){
                 DB::table('tickets_asignados_det')
                    ->where('item',$tickets_asignados_det[0]->item)
                    ->delete();  
                    return response()->json(array("estado"=>"Nocreado"));

            }else{
                DB::table('tickets_asignados_det')
                    ->where('item',$tickets_asignados_det[0]->item)
                    ->update([
                        'perfil_color'             =>$ticket_asig_color,
                        'perfil_tiempo'            => $ticket_asig_Tiempo,
                        'estado'            =>1

                    ]);  

            }

            


            
                                                



        // $datos['idvendedor'] = $request->idVendedor;
        //   $collection = Collection::make($vendedor[0]); 

        // return response()->json($collection);
        //  return response()->json(["estado"=>"Creado"]);


    }

    public function codigoNnumeros(int $n){
        $key = '';
  
        $caracteres = "0123456789012345678901234567890123456789012345678901234567890123456789";
        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
        $length = $n;
        $max = strlen($caracteres) - 1;
  
        for ($i=0;$i<$length;$i++) {
            $key .= ''.substr($caracteres, rand(0, $max), 1);
        }
  
        return $key;
    }
    public function codigoNletras(int $n){
        $key = '';
  
        $caracteres = "ABCDEFGHIJKM#NLOPQRSTUVWXYZa+bcdefghijkmnlopqrstuvwxyz";
        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
        $length = $n;
        $max = strlen($caracteres) - 1;
  
        for ($i=0;$i<$length;$i++) {
            $key .= ''.substr($caracteres, rand(0, $max), 1);
        }
  
        return $key;
    }
    public function contadorPerfilesAsignadosTrabajador(Request $request){
        // dd($request->id_vendedor);
        
        $vendedor   = DB::table('users') ->where('id', $request->id_vendedor)->get();
        // dd($vendedor);
        $ARRAY=[];
        $TOTALES=[];
       
        $codigoAlterno      =null;
        $perfilasignado     =null; 
        $TasignadoPerfil    =null;
        $TvendidosPerfil    =null;
        $TsaldoPerfil      =null;
        $TasignadoTabrajdor =null;
        $TvendidoTrabrajador=null;
        $TsaldoTrabajador   =null;

 
        $tickets_asignados_det=DB::table ('tickets_asignados_det')  
        ->where('idtrabajador', $vendedor[0]->id)
        ->where('estado',1)
        ->get();   

        foreach ($tickets_asignados_det as  $ticketAsignados) {
             $codigoAlterno      =$ticketAsignados->codigo_alterno;
             $perfil=DB::table('perfiles')->where('idperfil',intval($ticketAsignados->idperfil))->get();  
             $perfilasignado     =$perfil[0]->name; 
             $TasignadoPerfil    =$ticketAsignados->cantidad;  
            //contamos los tickets vendidos 
             $ticket_venta=DB::table('ticket_venta')->where('id_tickets_asign',intval($ticketAsignados->item))->where('estado',1)->get();   
             if($perfil!=null){
                 $contadorVendidos=0;
                 foreach ($ticket_venta as  $ventas) {
                     $contadorVendidos=$contadorVendidos+$ventas->cantidad;
                 } 
                 $TvendidosPerfil = $contadorVendidos;
             }else{
                 $TvendidosPerfil =0;
             }
             $TsaldoPerfil =intval($TasignadoPerfil) - intval($TvendidosPerfil);
             if($TsaldoPerfil<0){
                $TsaldoPerfil =0;
             }
             if($TsaldoPerfil>$TasignadoPerfil){
                $TsaldoPerfil=$TasignadoPerfil;
             } 
            array_push($ARRAY,[
             'Vendedor'    =>  $vendedor[0]->nombre." ".$vendedor[0]->apellidos,
             'codigo'      =>  $codigoAlterno,
             'perfil'      => $perfilasignado, 
             'asignado'    => $TasignadoPerfil,
             'vendido'     => $TvendidosPerfil,
             'saldo'       => $TsaldoPerfil, 
            ]); 

            $TasignadoTabrajdor  += $TasignadoPerfil;
            $TvendidoTrabrajador += $TvendidosPerfil;
            $TsaldoTrabajador    += $TsaldoPerfil;
        }   

            array_push($TOTALES,[ 
             'Asignados'    => $TasignadoTabrajdor,
             'Vendido'     => $TvendidoTrabrajador,
             'Saldo'       => $TsaldoTrabajador, 
            ]); 
            // $collection = Collection::make($ARRAY); 
            // return response()->json($collection->toJson(),["pero"=>"lkmlk"]);
            return response()->json(array('array'=>$ARRAY,'totales'=>$TOTALES));

    } 


 
    
    public function ayuda(){
        $API = new routeros_api();
         $API->debug = false;
         $ARRAY_PROFILES=[];
          $ARRAY=[];

        $router = DB::table('router')->where('idrouter','R01')->get(); 
        foreach ($router as $rou) {
                if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {  
                      
                         $ARRAY_PROFILES = $API->comm("/ip/hotspot/user/profile/print");  
                        //    dd($ARRAY_PROFILES);  
              }  
            }
        foreach ($ARRAY_PROFILES as   $perfiles) {
            // dd( $perfiles['name']);
            //  dd( $perfiles);
            if($perfiles['name']=="5 HORAS MAX"){ 
                // dd('ingreso');
                    $tickets_asignados_det = DB::table('tickets_asignados_det')->where('idperfil',113)->where('estado',0)->get(); 
                    // dd($tickets_asignados_det);
                    foreach ($tickets_asignados_det as $key => $asignado) {

                         $ticket_venta = DB::table('ticket_venta')->where('id_tickets_asign',$asignado->item)->get();  
                         foreach ($ticket_venta as   $venta) {  
                                $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                            "name" => $venta->id_pin_hospot,
                                            "profile" =>  $perfiles['.id'],     //jala de porfile                               
                                            "limit-uptime" => $perfiles['session-timeout'],//jala de porfile  
                                        ));   
                            } 
                    } 

            } 
            if($perfiles['name']=="12 HORAS MAX"){
                   $tickets_asignados_det_12 = DB::table('tickets_asignados_det')->where('idperfil',114)->get(); 
                    foreach ($tickets_asignados_det_12 as $key => $asignado) {

                         $ticket_venta = DB::table('ticket_venta')->where('id_tickets_asign',$asignado->item)->where('estado',0)->get();  
                         foreach ($ticket_venta as   $venta) { 
                                // dd($venta->id_pin_hospot,$perfiles['.id'],$perfiles['session-timeout']);
                                $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                            "name" => $venta->id_pin_hospot,
                                            "profile" =>  $perfiles['.id'],     //jala de porfile                               
                                            "limit-uptime" => $perfiles['session-timeout'],//jala de porfile  
                                        ));   
                            } 
                    } 
                
            } 
            if($perfiles['name']=="1 DIA MAX"){
                $tickets_asignados_det_1 = DB::table('tickets_asignados_det')->where('idperfil',115)->get(); 
                    foreach ($tickets_asignados_det_1 as $key => $asignado) {

                         $ticket_venta = DB::table('ticket_venta')->where('id_tickets_asign',$asignado->item)->where('estado',0)->get();  
                         foreach ($ticket_venta as   $venta) { 
                                // dd($venta->id_pin_hospot,$perfiles['.id'],$perfiles['session-timeout']);
                                $ARRAY = $API->comm("/ip/hotspot/user/add", array(
                                            "name" => $venta->id_pin_hospot,
                                            "profile" =>  $perfiles['.id'],     //jala de porfile                               
                                            "limit-uptime" => $perfiles['session-timeout'],//jala de porfile  
                                        ));   
                            } 
                    } 
                
            }  
            
        }

        // dd( $idperfilasig,$idp); 
        dd('restauracion ok');
    } 











}
