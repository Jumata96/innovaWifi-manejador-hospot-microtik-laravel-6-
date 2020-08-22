<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Storage;
use DB;
use Validator;
use Auth;
use Image;

class CarruselController extends Controller
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

        $carrusel = DB::table('carrusel')->where('app','INNOVAWIFI')->get();
        //dd($carrusel);

        return view('forms.carrusel.lstCarrusel', [
            'carrusel'	=> $carrusel,
            'valida'	=> $valida
		]);
    }

    public function create()
    {
       return view('forms.carrusel.addCarrusel');
    }

     public function store(Request $request)
    {
        $validatedData = $request->validate([
            'url_imagen'     => 'required|mimes:jpeg,bmp,png,jpg,mp4,mp4v,mpg4,mpeg,mpg',
        ]);

        $idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();
        $principal = 0;

        if($request->img_principal == 'on'){
            $principal = 1;
            DB::table('carrusel')->update(['img_principal' => 0]);
        }
        
        $file = $request->file('url_imagen');
        $extension = $file->getClientOriginalExtension();  

        if ($request->file('url_imagen')) {
            $url_imagen = Storage::disk('public')->put('images/carrusel', $request->file('url_imagen'));
        }


        DB::table('carrusel')
        ->insert([            
            'estado'            => 1,
            'app'               => 'INNOVAWIFI',
            'titulo'            => $request->titulo,
            'descripcion'       => $request->descripcion,            
            'alineacion'        => $request->alineacion,
            'padding_top'       => $request->padding_top,
            'url_imagen'        => isset($url_imagen) ? $url_imagen : '',       
            'extension'         => $extension, 
            'img_principal'     => $principal,
            'color'             => (empty($request->color))? 'grey-text text-lighten-3' : $request->color,
            'btn_estado'        => $request->btn_estado ? strval($request->btn_estado) : '0',
            'btn_color'         => $request->btn_color,
            'btn_idprod'        => str_pad($request->btn_idprod, 10, "0", STR_PAD_LEFT),
            'fecha_creacion'    => date('Y-m-d H:m:s')
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

        $carrusel = DB::table('carrusel')->where([
            'url_imagen'    => $url_imagen,
            'app'       => 'INNOVAWIFI'
        ])->get();

        
        $data['success'] = $carrusel;
        $data['path'] = $url_imagen;

        return $data;
    }

    public function update(Request $request)
    {
    	//dd($request);
    	$idusu = Auth::user()->id;
        $validacion = DB::table('validacion')->where('idusuario',$idusu)->get();
    	$principal = 0;


    	if($request->img_principal == 'on'){
    		$principal = 1;
    		DB::table('carrusel')->update(['img_principal' => 0]);
    	}
        
	    $file = $request->file('url_imagen');

	    if ($file !== null) {	 

            $file = $request->file('url_imagen');
            $extension = $file->getClientOriginalExtension();  

            if ($request->file('url_imagen')) {
                $url_imagen = Storage::disk('public')->put('images/carrusel', $request->file('url_imagen'));
            }


	        DB::table('carrusel')
	        ->where('id',$request->id)
	        ->update([      
	            'titulo'            => $request->titulo,
	            'descripcion'       => $request->descripcion,
	            'url_imagen'        => isset($url_imagen) ? $url_imagen : '',   
	            'alineacion'		=> $request->alineacion,
	            'padding_top'		=> $request->padding_top,	           
	            'extension'			=> $extension,
	            'img_principal'     => $principal,
                'color'             => (empty($request->color))? 'grey-text text-lighten-3' : $request->color,
                'btn_estado'        => $request->btn_estado ? strval($request->btn_estado) : '0',
                'btn_color'         => $request->btn_color,
                'btn_idprod'        => str_pad($request->btn_idprod, 10, "0", STR_PAD_LEFT),
                
	        ]);
	    }else{
	    	
	        DB::table('carrusel')
	        ->where('id',$request->id)
	        ->update([      
	            'titulo'            => $request->titulo,
	            'descripcion'       => $request->descripcion,
	        	'alineacion'		=> $request->alineacion,
	            'padding_top'		=> $request->padding_top,
	            'img_principal'     => $principal,
                'color'             => (empty($request->color))? 'grey-text text-lighten-3' : $request->color,
                'btn_estado'        => $request->btn_estado ? strval($request->btn_estado) : '0',
                'btn_color'         => $request->btn_color,
                'btn_idprod'        => str_pad($request->btn_idprod, 10, "0", STR_PAD_LEFT),
                
	        ]);
	    }

	    

        
        if (count($validacion) > 0) {           
            DB::table('validacion')
            ->where('idusuario',strval($idusu))
            ->update(['valor' => 2]);  
        }

        $carrusel = DB::table('carrusel')->where('id',$request->id)->get();

        
        $data['success'] = $carrusel;
	    //$data['path'] = 'images/carrusel/'.$fileName . '?' . uniqid();

	    return $data;
    }

    public function destroy(Request $request)
    {
    	//dd($request->id);
        DB::table('carrusel')
            ->where('id',$request->id)->delete();

        return response()->json();
    }

    public function show($id)
    {
        $carrusel = DB::table('carrusel')
                    ->where('id',$id)->get();

        return view('forms.carrusel.updCarrusel',['carrusel' => $carrusel]);
    }

    public function disabled(Request $request)
    {
        DB::table('carrusel')
            ->where('id',$request->id)
            ->update([
                'estado'    => 0
            ]);

        $carrusel = DB::table('carrusel')->where('id',$request->id)->get();
        $collection = Collection::make($carrusel);
                
        return response()->json($collection->toJson());   
    }

    public function habilitar(Request $request)
    {
        DB::table('carrusel')
            ->where('id',$request->id)
            ->update([
                'estado'    => 1
            ]);

        $carrusel = DB::table('carrusel')->where('id',$request->id)->get();
        $collection = Collection::make($carrusel);
                
        return response()->json($collection->toJson());   
    }

}
