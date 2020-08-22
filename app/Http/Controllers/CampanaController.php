<?php

namespace App\Http\Controllers;

use App\Mail\EnviarCampanaMail;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Cloudder;

class CampanaController extends Controller
{
    public function index()
    {
        $correos = DB::table('usuarios_hotspot')
            ->select('codigo', 'nombre', 'email')
            ->whereNotNull('email')
            ->get();
        return view('forms.campanas.index', ['correos' => $correos]);      
        
      /*  eval("eval(base64_decode('JGNvcnJlb3MgPSBEQjo6dGFibGUoJ3VzdWFyaW9zX2hvdHNwb3QnKQ0KICAgICAgICAgICAgLT5zZWxlY3QoJ2NvZGlnbycsICdub21icmUnLCAnZW1haWwnKQ0KICAgICAgICAgICAgLT53aGVyZU5vdE51bGwoJ2VtYWlsJykNCiAgICAgICAgICAgIC0+Z2V0KCk7DQogICAgICAgIHJldHVybiB2aWV3KCdmb3Jtcy5jYW1wYW5hcy5pbmRleCcsIFsnY29ycmVvcycgPT4gJGNvcnJlb3NdKTs='));");  */
    }   

    public function prueba()
    {
       $user = auth()->user();
       $enviado_por =  $user->nombre.' '.	$user->apellidos; 
       dd($enviado_por);
    }


     public function vistaOfuscarCodigo()
    {
       return view('forms.ofuscar.index');
    }

    public function ofuscarCodigo(Request $request)
    {
       $texto = $request->codigo; 
       $encriptado = base64_encode($texto);
       $desencriptado = base64_decode($encriptado);    

     //  dd($texto, $encriptado, $desencriptado);

        /* PARA REEMPLZAR LO CODIFICADO
            eval("eval(base64_decode('TEXTO CODIFICADO'));");

          EJEMPLO:
          eval("eval(base64_decode('JGNvcnJlb3MgPSBEQjo6dGFibGUoJ3VzdWFyaW9zX2hvdHNwb3QnKQ0KICAgICAgICAgICAgLT5zZWxlY3QoJ2NvZGlnbycsICdub21icmUnLCAnZW1haWwnKQ0KICAgICAgICAgICAgLT53aGVyZU5vdE51bGwoJ2VtYWlsJykNCiAgICAgICAgICAgIC0+Z2V0KCk7DQogICAgICAgIHJldHVybiB2aWV3KCdmb3Jtcy5jYW1wYW5hcy5pbmRleCcsIFsnY29ycmVvcycgPT4gJGNvcnJlb3NdKTs='));");

       */
       return view('forms.ofuscar.encriptado',['texto' => $texto, 'encriptado' => $encriptado]);
    }

    public function enviarCampana(Request $request)
    {
        $validatedData = $request->validate([
                'asunto'     => 'required',
                'correos'    => 'required',
                'contenido'  => 'required',
                'url_imagen' => 'required|mimes:jpeg,bmp,png,jpg,mp4,mp4v,mpg4,mpeg,mpg',
            ]);

        if ($request->file('url_imagen')) {           
            $lista_correos = $request->correos;
       		$lista_correos = implode(',', $lista_correos);
            $url_imagen = Storage::disk('public')->put('images/campanas', $request->file('url_imagen'));
           DB::table('campanas')
            ->insert([
                'destinatarios' => $lista_correos,
                'asunto'        => $request->asunto,
                'contenido'     => $request->contenido,
                'url_imagen'    => $url_imagen,
            ]);
            $file = $request->file('url_imagen');
            $extension = $file->getClientOriginalExtension();        

            if ($extension == 'jpeg' || $extension == 'bmp'|| $extension == 'png' || $extension == 'jpg')
            {Cloudder::upload($request->file('url_imagen'));
                $tipo = '1';
            }
            else
            {Cloudder::uploadVideo($request->file('url_imagen'));
                $tipo = '2';
            }
          
            $rpta = Cloudder::getResult();
            $url_imagen = $rpta['url']; 
            // return new EnviarCampanaMail($request, $url_imagen, $tipo);
            Mail::to($request->correos)->send(new EnviarCampanaMail($request, $url_imagen, $tipo));
            return redirect()->route('campana')->withSuccess('Campaña enviada!');       
        }         
    }

}
