<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;
use Image;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valida = 0;

        //-- Validación para mostrar mensajes al realizar un CRUD
        $validacion = DB::table('validacion')
                        ->select('valor')
                        ->where('idusuario',Auth::user()->id)->get();

        foreach ($validacion as $val) {
            $valida = $val->valor;
        }
        if ($valida > 0) {
            DB::table('validacion')
            ->where('idusuario',strval(Auth::user()->id))
            ->update(['valor' => 0]);
        }

        //--

        $empresa = DB::table('empresa')->get();

        return view('forms.empresa.lstEmpresa', [
                    'empresa'   => $empresa,
                    'valida'     => $valida
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_documento = DB::table('documento')->where('estado',1)->get();
        $parametros = DB::table('parametros')->where('tipo_parametro','CLIENTES')->get();
        
        return view('forms.empresa.mntEmpresa',[
            'tipo_documento'    => $tipo_documento,
            'parametros'        => $parametros
        ]);
    }

    public function create2()
    {
        $tipo_documento = DB::table('documento')->where('estado',1)->get();
        $parametros = DB::table('parametros')->where('tipo_parametro','CLIENTES')->get();
        
        return view('forms.empresa.mntEmpresa2',[
            'tipo_documento'    => $tipo_documento,
            'parametros'        => $parametros
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        $rules = array(     
            'idempresa'     => 'required|min:3',
            'razon_social'  => 'required',
            'direccion'     => 'required',
            'iddocumento'   => 'required|',
            'DNI1'          => 'required|string|min:8',
            'representante1'=> 'required|string|max:30',
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');            
            return response()->json($var);
        }

        $file = $request->file('imagenURL');
        //dd($request);     

        if ($file != null) {
            $extension = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $path = public_path('images/'.$fileName);
            //dd( $fileName);
            Image::make($file)->save($path);


            //$empresa = \count(DB::table('empresa')->get()+1);
            DB::table('empresa')
            ->insert([
                'idempresa'         => $request->idempresa,
                'idusuario'         => Auth::user()->id,
                'estado'            => 1,
                'nombre'            => $request->razon_social,
                'direccion'         => $request->direccion,
                'RUC'               => $request->RUC,
                'referencia'        => $request->refrencia,
                'DNI1'              => $request->DNI1,
                'representante1'    => $request->representante1,
                'razon_social'      => $request->razon_social,
                'telefono'          => $request->telefono,
                'iddocumento'       => $request->iddocumento,
                'url_imagen'        => 'images/'.$fileName,
                'imagen'            => $fileName,
                'marca'             => $request->marca,
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

        }else{
            
            DB::table('empresa')
            ->insert([
                'idempresa'         => $request->idempresa,
                'idusuario'         => Auth::user()->id,
                'estado'            => 1,
                'nombre'            => $request->razon_social,
                'direccion'         => $request->direccion,
                'RUC'               => $request->RUC,
                'referencia'        => $request->refrencia,
                'DNI1'              => $request->DNI1,
                'representante1'    => $request->representante1,
                'razon_social'      => $request->razon_social,
                'telefono'          => $request->telefono,
                'iddocumento'       => $request->iddocumento,
                'marca'             => $request->marca,
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);
        }       

        
        if (count($validacion) === 0) {
            DB::table('validacion')
            ->insert([
                'idusuario' => $idusu,
                'valor'     => 1
            ]);
        }else{
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 1]);
            
        }

        $tabla = DB::table('producto')->where('codigo',$request->codigo)->get();        
        $data['success'] = $tabla;

        return $data;
    }

    public function store2(Request $request)
    {
        //dd($request);   
        $rules = array(            
            'idempresa'     => 'required',
            'razon_social'  => 'required',
            'direccion'     => 'required',
            'RUC'           => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }          

        DB::table('empresa')
            ->insert([
                'idempresa'         => $request->idempresa,
                'estado'            => 1,
                'nombre'            => $request->razon_social,
                'direccion'         => $request->direccion,
                'RUC'               => $request->RUC,
                'referencia'        => $request->refrencia,
                'DNI1'              => $request->DNI1,
                'representante1'    => $request->representante1,
                'razon_social'      => $request->razon_social,
                'telefono'          => $request->telefono,
                'iddocumento'       => $request->iddocumento,
                'tipo'              => 'CLIE',
                'principal'         => 1,
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);    

        return response()->json(array('valor'=> 'CONFORME'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = DB::table('empresa')
                    ->where('idempresa',$id)->get();
        $tipo_documento = DB::table('documento')->where('estado',1)->get();
        $parametros = DB::table('parametros')->where('tipo_parametro','CLIENTES')->get();

        return view('forms.empresa.edtEmpresa',[
            'empresa'       => $empresa,
            'tipo_documento'=> $tipo_documento,
            'parametros'    => $parametros
        ]);
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
    public function update(Request $request)
    {
        //dd($request);
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();
        
        $rules = array(     
            'idempresa'     => 'required|min:3',
            'razon_social'  => 'required',
            'direccion'     => 'required',
            'iddocumento'   => 'required|',
            'DNI1'          => 'required|string|min:8',
            'representante1'=> 'required|string|max:30',
        );           

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');
            //return response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return response()->json($var);
        }   

        $file = $request->file('imagenURL');
        //dd($request);     

        if ($file != null) {
            $extension = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $path = public_path('images/'.$fileName);
            //dd( $fileName);
            Image::make($file)->save($path);

            DB::table('empresa')
            ->where('idempresa',strval($request->idempresa))
            ->update([
                'nombre'            => $request->razon_social,
                'direccion'         => $request->direccion,
                'RUC'               => $request->RUC,
                'referencia'        => $request->refrencia,
                'DNI1'              => $request->DNI1,
                'representante1'    => $request->representante1,
            //    'DNI2'              => $request->DNI2,
            //    'representante2'    => $request->representante2,
                'razon_social'      => $request->razon_social,
                'telefono'          => $request->telefono,
                'documento1'        => $request->documento1,
            //    'documento2'        =>  $request->documento2,
                'url_imagen'        => 'images/'.$fileName,
                'imagen'            => $fileName,
                'marca'             => $request->marca,
                'fecha_creacion'    => date('Y-m-d h:m:s')
            ]);

        }else{
            
             DB::table('empresa')
            ->where('idempresa',strval($request->idempresa))
            ->update([
                'direccion'         => $request->direccion,
                'RUC'               => $request->RUC,
                'referencia'        => $request->refrencia,
                'DNI1'              => $request->DNI1,
                'representante1'    => $request->representante1,
            //    'DNI2'              => $request->DNI2,
            //    'representante2'    => $request->representante2,
                'razon_social'      => $request->razon_social,
                'telefono'          => $request->telefono,
                'documento1'        => $request->documento1,
                'marca'             => $request->marca,
            //    'documento2'        =>  $request->documento2     
            ]);
        }   

        if (count($validacion) > 0) {           
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 2]);  
        }    


        $tabla = DB::table('producto')->where('codigo',$request->codigo)->get();        
        $data['success'] = $tabla;

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        if (count($validacion) === 0) {
            DB::table('validacion')
            ->insert([
                'idusuario' => $idusu,
                'valor'     => 3
            ]);
        }else{
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 3]);
            
        }

        DB::table('empresa')
            ->where('idempresa',$id)->delete();

        return redirect('/empresa');
    }

    public function verificarID(Request $request)
    {
        //dd($request);
        $empresa = DB::table('empresa')->where('idempresa', $request->codigo)->get();

        if(count($empresa) > 0){
            return response()->json(array('errors'=> 'EXISTE'));
        }
        
        $collection = Collection::make($empresa);
                
        return response()->json($collection->toJson());   
    }
}
