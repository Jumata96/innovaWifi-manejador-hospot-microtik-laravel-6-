<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUser;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'usuario' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $usu = DB::table('users')->get();
        $id = count($usu) + 1;

        DB::table('validacion')->insert([
            'idusuario'     => $id,
            'valor'         => 0
        ]);

         $usuario = User::create([
            'id'            =>  $id,
            'nombre'        => $data['nombre'],
            'usuario'       => $data['usuario'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'estado'        => 1
        ]);       
        /*******Enviamos un mensaje al nuevo usuario***************/
            $newUser = DB::table('users')
                        ->select('id','nombre','apellidos','email', 'usuario')
                        ->where('id','=',$id)
                        ->get()
                        ->first();                  
                     
            Mail::to($newUser->email)->send(new WelcomeUser($newUser));
            return $usuario;           

    }
}
