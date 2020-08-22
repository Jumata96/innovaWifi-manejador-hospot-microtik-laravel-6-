<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Response;
use Carbon\Carbon;
use DateTime;
use Auth;

class ComprobanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function codigo(){
        $key = '';

        $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789\|@#!$%&/()=?¿";
        //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
        $length = 10;
        $max = strlen($caracteres) - 1;

        for ($i=0;$i<$length;$i++) {
            $key .= substr($caracteres, rand(0, $max), 1);
        }

        return $key;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCliente(Request $request)
    {
         $rules = array(            
            'fecha_emision'          => 'required',
            'fecha_vencimiento'     => 'required',
            'precio_unitario'            => 'required',
            'descripcion'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          
        else {
            $fecha = Carbon::now(); 

            $key = '';

            $caracteres = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789\|@#!$%&/()=?¿";
            //aquí podemos incluir incluso caracteres especiales pero cuidado con las ‘ y “ y algunos otros
            $length = 10;
            $max = strlen($caracteres) - 1;

            for ($i=0;$i<$length;$i++) {
                $key .= substr($caracteres, rand(0, $max), 1);
            }

            $tabla = DB::table('factura')->get();
            $cont = count($tabla)+1;

           
            DB::table('factura')
            ->insert([  
                'codigo'            => $key,
                'idempresa'         => '001',
                'idestado'          => 'EM',
                'periodo'           => $fecha,
                'fecha_emision'     => Carbon::createFromFormat('d/m/Y',$request->fecha_emision),
                'fecha_vencimiento' => Carbon::createFromFormat('d/m/Y',$request->fecha_vencimiento),
                'idcliente'         => $request->idcliente,
                'formulario'        => 'COMPROBANTE_CLIENTE_ADDCOMPROBANTE',
                'idusuario'         => (int) Auth::user()->id,
                'idmoneda'          => 'PEN',  
                'idforma_pago'      => 'CON',  
                'iddocumento'       => 'BOL',       
                'serie'             => '0001',  
                'numero'            => '000000'.$cont, 
                'subtotal'          => $request->subtotal,  
                'descuento'         => $request->descuento,  
                'subtotal_neto'     => $request->subtotal_neto,  
                'impuesto'          => $request->impuesto,   
                'total'             => $request->total, 
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            
            $comprobante = DB::table('factura')->where('codigo',$key)->get();
            $collection = Collection::make($comprobante);
            
            return response()->json($collection->toJson());   
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
