<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection as Collection;
use DB;
use Validator;
use Auth;

class UsuarioController extends Controller
{
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

        $usuarios = DB::table('users')
        ->whereIn('idtipo',['ADM','VEN'] )
        ->get();

        return view('forms.usuarios.lstUsuarios', [
                    'usuarios'   => $usuarios,
                    'valida'     => $valida
                ]);
    }

    public function create()
    {

        $empresa = DB::table('empresa')->where('estado',1)->get();
        $zonas  =DB::table('zonas')->get();
        $tipo_documento = DB::table('documento')
            ->select('iddocumento', 'descripcion', 'dsc_corta')
            ->where('estado', '1')
            ->get();

        return view('forms.usuarios.addUsuario',[
            'empresa'           => $empresa,
            'tipo_documento'    => $tipo_documento,
            'zonas'             =>$zonas
        ]); 
    }

    public function store(Request $request)
    {
        $puntoVenta=null;
        
        if($request->idtipo=='VEN'){
            $puntoVenta= $request->zonas;

            $rules = array(     
                'idempresa'     => 'required',
                'iddocumento'   => 'required',
                'iddocumento'   => 'required',
                'zonas'         => 'required',
                'nro_documento' => 'required',
                'nombre'        => 'required',
                'apellidos'     => 'required',
                'usuario'       => 'required|string|max:255',
                'email'         => 'required|string|email|max:255|unique:users',
                'password'      => 'required|string|min:6|confirmed',
            );

        }else{
            $rules = array(     
                'idempresa'     => 'required',
                'iddocumento'   => 'required',
                'nro_documento' => 'required',
                'nombre'        => 'required',
                'apellidos'     => 'required',
                'usuario'       => 'required|string|max:255',
                'email'         => 'required|string|email|max:255|unique:users',
                'password'      => 'required|string|min:6|confirmed',
            );

        }
        

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');            
            return response()->json($var);
        }

       

        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        //$id = count(DB::table('users')->get()) + 1;
        DB::table('users')
            ->insert([
                'idempresa'         => $request->idempresa,
                'nombre'            => $request->nombre,
                'apellidos'         => $request->apellidos,
                'idtipo'            => $request->idtipo,
                'estado'            => 1,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'usuario'           => $request->usuario,
                'iddocumento'       => $request->iddocumento,
                'nro_documento'     => $request->nro_documento,
                'cargo'             => $request->cargo,
                'avatar'            => null,
                'telefono'          => $request->telefono,
                'glosa'             => $request->glosa,
                'idusuario'         => Auth::user()->id,
                'idZona'            =>$puntoVenta,
                'created_at'        => date('Y-m-d h:m:s')
            ]); 

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

        return redirect('/usuarios');
    }

    public function verificarID(Request $request)
    {
        //dd($request);
        $usuario = DB::table('users')->where('nro_documento', $request->codigo)->get();

        if(count($usuario) > 0){
            return response()->json(array('errors'=> 'EXISTE'));
        }
        
        $collection = Collection::make($usuario);
                
        return response()->json($collection->toJson());   
    }

    public function verificarUsuario(Request $request)
    {
        //dd($request);
        $usuario = DB::table('users')->where('usuario', $request->codigo)->get();

        if(count($usuario) > 0){
            return response()->json(array('errors'=> 'EXISTE'));
        }
        
        $collection = Collection::make($usuario);
                
        return response()->json($collection->toJson());   
    }


    public function show($id)
    {
        $usuario = DB::table('users')
                    ->where('id',$id)->get();
        $empresa = DB::table('empresa')->where('estado',1)->get();
        $zonas  =DB::table('zonas')->get();
        $tipo_documento = DB::table('documento')
                ->select('iddocumento', 'descripcion', 'dsc_corta')
                ->where('estado', '1')
                ->get(); 
        return view('forms.usuarios.updUsuario',[
            'usuario'           => $usuario,
            'empresa'           => $empresa,
            'tipo_documento'    => $tipo_documento,
            'zonas'             => $zonas
        ]);
    }


     public function update(Request $request)
    {        $puntoVenta=null;

        if($request->idtipo=='VEN'){
            $puntoVenta= $request->zonas; 

        } 

        DB::table('users')
        ->where('id',strval($request->id))
        ->update([
            'idempresa'         => $request->idempresa,
                'nombre'            => $request->nombre,
                'apellidos'         => $request->apellidos,
                'idtipo'            => $request->idtipo,
                'estado'            => 1,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'usuario'           => $request->usuario,
                'iddocumento'       => $request->iddocumento,
                'nro_documento'     => $request->nro_documento,
                'cargo'             => $request->cargo,
                'avatar'            => null,
                'telefono'          => $request->telefono,
                'glosa'             => $request->glosa,
                'idusuario'         => Auth::user()->id,
                'idZona'            =>$puntoVenta,
                'created_at'        => date('Y-m-d h:m:s') 
        ]);

        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();

        if (count($validacion) > 0) {           
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 2]);  
        }

        return redirect('/usuarios');
    }

    public function destroy($id)
    {        
    	//dd($id);
        DB::table('users')
            ->where('id',$id)->delete();

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

        return redirect('/usuarios');
    }


    public function disabled(Request $request)
    {
        DB::table('users')
            ->where('id',$request->id)
            ->update([
                'estado'    => 0
            ]);

        $users = DB::table('users')->where('id',$request->id)->get();
        $collection = Collection::make($users);
                
        return response()->json($collection->toJson());   
    }

    public function habilitar(Request $request)
    {
        DB::table('users')
            ->where('id',strval($request->id))
            ->update([
                'estado'    => 1
            ]);

        $users = DB::table('users')->where('id',$request->id)->get();
        $collection = Collection::make($users);
                
        return response()->json($collection->toJson());   
    }

    public function updContra(Request $request)
    {        
        //dd($request);
        $rules = array(     
            'contra'    => 'required',
            'contra2'   => 'required',
            'contra3'   => 'required'
        );

        $validator = Validator::make ( $request->all(), $rules );

        if ($validator->fails()){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'error');            
            return response()->json($var);
        }

        $contra = null;
        $user = DB::table('users')->where('id',strval($request->id))->get();

        foreach ($user as $val) {
            $contra = $val->password;
        }

        if(!Hash::check($request->contra, $contra)){
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'BAD_CONTRA');
            return response()->json($var);
        }

        if ($request->contra2 != $request->contra3) {
            $var = $validator->getMessageBag()->toarray();
            array_push($var, 'BAD_CONTRA2');
            return response()->json($var);
        }

        DB::table('users')
        ->where('id',strval($request->id))
        ->update([
            'password'  => Hash::make($request->contra2),
        ]);

        $tipo = DB::table('tipo')->get();

        $collection = Collection::make($tipo);
                
        return response()->json($collection->toJson());   
    }


}
