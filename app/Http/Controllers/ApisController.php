<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;  

class ApisController extends Controller
{
    //

    public function ImprimirFichasTrabajador($id){ 
        //dd($id);
        $datosTabla=[];  
          $ARRAY=[];  
        $tickets_asignados_det=DB::table ('tickets_asignados_det')->where('item', $id)->get();  
        
         $ticket_venta=DB::table ('ticket_venta')->where('id_tickets_asign', $id)->get();  
         $perfiles=DB::table ('perfiles')->where('idperfil', $tickets_asignados_det[0]->idperfil)->get();  
      
        $i=0;
        foreach ($ticket_venta as $value) { 
           // $i+=1;
            array_push($ARRAY,[ 
                      'codigo'              =>$value->codigo,
                      'id_tickets_asign'    =>$value->id_tickets_asign,
                      'cantidad'            =>$value->cantidad,
                      'precio'              =>$perfiles[0]->precio,
                      'idperfil'            =>$value->idperfil,
                      'estado'              =>$value->estado,
                      'time_pin_hospot'     =>$value->time_pin_hospot.":00",
                      'id_pin_hospot'       =>$value->id_pin_hospot,
                      'color'               =>$perfiles[0]->perfil_color,
                      'costo'              =>$perfiles[0]->precio,
                ]);  
             //dd($ARRAY,$perfiles[0]);
           /* if($i==5){
                array_push($ARRAY,$datosTabla); 
                 $datosTabla=[];
                  $i=0;

            }*/ 
        } 
        /*
        $pdf = PDF::loadView('forms.comprobante.cliente.lstTicketsPerfilAsigPer', 
        compact('tickets_asignados_det','ticket_venta','ARRAY')); 
         $pdf -> setPaper ( 'Legal' , 'landscape' ); 
        return $pdf->download('imprimir.pdf');*/
          return response()->json($ARRAY);

 
   } 
}
