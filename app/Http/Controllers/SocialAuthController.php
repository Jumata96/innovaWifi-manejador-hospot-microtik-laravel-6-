<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUser;
use Carbon\Carbon;
use Auth;
use DB;
use App\User;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        //add($provider);
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user(); 
        //dd($social_user);
        // Comprobamos si el usuario ya existe
        if($provider == 'google'){
            if (!$user = DB::table('usuarios_hotspot')->where('email', $social_user->email)->first()) { 
              
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = DB::table('usuarios_hotspot')
                ->insert([
                    'idempresa'         => '001',
                    'codigo'            => $social_user->id,
                    'ip'                => $_SERVER["REMOTE_ADDR"],
                    'nombre'            => $social_user->name,
                    'genero'            => $social_user->user['gender'],
                    'email'             => $social_user->email,
                    'avatar'            => $social_user->avatar,
                    'avatar_original'    => $social_user->avatar_original,
                    'usuario'           => $social_user->id,
                    'social_login'      => $provider,
                    'nickname'          => $social_user->nickname,

                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'estado'            => 1
                ]);
                /*******Enviamos un mensaje al nuevo usuario***************/
                $newUser = DB::table('usuarios_hotspot')
                            ->select('codigo','nombre','email', 'usuario')
                            ->where('codigo','=',$social_user->id)
                            ->get()
                            ->first();                  
                         
                Mail::to($newUser->email)->send(new WelcomeUser($newUser));
            }
        }

        if($provider == 'twitter'){
            if (!$user = DB::table('usuarios_hotspot')->where('email', $social_user->email)->first()) { 
              
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = DB::table('usuarios_hotspot')
                ->insert([
                    'idempresa'         => '001',
                    'codigo'            => $social_user->id,
                    'ip'                => $_SERVER["REMOTE_ADDR"],
                    'nombre'            => $social_user->name,
                //    'genero'            => $social_user->user['gender'],
                    'email'             => $social_user->email,
                    'avatar'            => $social_user->avatar,
                    'avatar_original'    => $social_user->avatar_original,
                    'usuario'           => $social_user->id,
                    'social_login'      => $provider,
                    'nickname'          => $social_user->nickname,

                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'estado'            => 1
                ]);
                /*******Enviamos un mensaje al nuevo usuario***************/
                $newUser = DB::table('usuarios_hotspot')
                            ->select('codigo','nombre','email', 'usuario')
                            ->where('codigo','=',$social_user->id)
                            ->get()
                            ->first();                  
                         
                Mail::to($newUser->email)->send(new WelcomeUser($newUser));
            }
        }

        if($provider == 'facebook'){
            if (!$user = DB::table('usuarios_hotspot')->where('email', $social_user->email)->first()) { 
               
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = DB::table('usuarios_hotspot')
                ->insert([
                    'idempresa'         => '001',
                    'codigo'            => $social_user->id,
                    'ip'                => $_SERVER["REMOTE_ADDR"],
                    'nombre'            => $social_user->name,
                    'email'             => $social_user->email,
                    'avatar'            => $social_user->avatar,
                    'avatar_original'    => $social_user->avatar_original,
                    'usuario'           => $social_user->id,
                    'social_login'      => $provider,
                    'nickname'          => $social_user->nickname,
                    'ciudad_nacimiento' => $social_user['location']['name'],
                    'ciudad_radica'     => $social_user['hometown']['name'],
                    'fecha_nacimiento'  => Carbon::createFromFormat('d/m/Y', $social_user['birthday']),

                    'fecha_creacion'    => date('Y-m-d h:m:s'),
                    'estado'            => 1
                ]);
                /*******Enviamos un mensaje al nuevo usuario***************/
                $newUser = DB::table('usuarios_hotspot')
                            ->select('codigo','nombre','email', 'usuario')
                            ->where('codigo','=',$social_user->id)
                            ->get()
                            ->first();                  
                         
                Mail::to($newUser->email)->send(new WelcomeUser($newUser));
            }
        }
    
            
 			$user = DB::table('usuarios_hotspot')->where('email', $social_user->email)->first();
 			//dd($user);

            return $this->authAndRedirect($user,1); // Login y redirección
      
    }
 
    // Login y redirección
    public function authAndRedirect($user)
    {
        //dd($user);
        Auth::login($user);

        return redirect('/home');
    }
}
