<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facedes\input;
use Illuminate\Support\Collection as Collection;
use Illuminate\Http\Request;
use DB;
use Validator;
use Response;
use Carbon\Carbon;
use DateTime;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = DB::table('post')->get();

        return view('forms.pruebas.post', compact('post'));
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

    public function prueba(){

        $date = Carbon::now();
        $date = $date->format('d-m-Y');
        //$date = $date->setDateFrom(Carbon::parse('11-10-2018'));

        $fecha_pago = null;
        $noti = DB::table('notificaciones')->get();

        foreach ($noti as $val) {
            $fecha_pago = $val->fecha_pago;
        }

        $date = Carbon::createFromFormat('d/m/Y', '11/06/1990');

        $fecha = new DateTime();
        $fecha_pago = date_format(date_create($fecha_pago),'d/m/Y');
        $fecha = date_format($fecha,'d/m/Y');

        $router = DB::table('router')->where('idrouter','R01')->get();

                $API = new routeros_api();
                $API->debug = false;
                $ARRAY = null;

                foreach ($router as $rou) {
                    if ($API->connect($rou->ip , $rou->usuario , $rou->password, $rou->puerto )) {
                            $ARRAY = $API->comm("/ip/hotspot/user/print");

                            foreach ($ARRAY as $value) {
                                if ($value['name'] == 'CAMBIO') {
                                    $ARRAY = $API->comm("/ip/hotspot/user/set", array(
                                        "name" => 'OTRO',
                                        "password"  => '123',  
                                        "profile"   => 'Aviso 1M',  
                                        "server"    => 'hotspot1',
                                        ".id"       => $value['.id']
                                    ));     
                                    
                                }
                            }

                                

                        
                    }       
                } 

             //dd($ARRAY);

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
            DB::table('post')
            ->insert([
                'idempresa'         => '001',
                'estado'            => 1,
                'titulo'            => $request->titulo,
                'comentario'        => $request->comentario,
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

            $post = DB::table('vw_post')->get();
            $collection = Collection::make($post);
            
            return response()->json($collection->toJson());        
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


    public function ajaxRequest()

    {

        return view('forms.pruebas.otro');

    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function ajaxRequestPost(Request $req)

    {

        $input = request()->all();

        return response()->json(['success' => $req->name ]);
        //return \Response::json(['success'=>'Got Simple Ajax Request.']);

    }
}
