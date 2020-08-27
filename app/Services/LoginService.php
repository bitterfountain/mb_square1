<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Session;

class LoginService
{    
	var $password;
	var $username;


    public static function login(Request $request, $params, &$err=null, &$token=null)
    {
    	$token = Str::random(60);
        $token = md5(crypt($token,config('app.salt')));

    	$user  = User::select('users.*')
              			->where('users.email', $params->usuario )
              			->where('users.password', crypt( $params->clave, config('app.salt') ) )
				        ->first();

		if (!$user) {
			$err = "Email or password incorrect, user not found";
			return false;
		} else {
			session( [ 'username' => $user->name ] );			
			session( [ 'useremail' => $user->email ] );			

			$request->session()->put('usuario_actual', $user->id);
			$request->session()->put('username', $user->name);
			$request->session()->put('useremail', $user->email);

			$user->remember_token = $token;
			$user->save();
		}		
		
		return $user;					
    }


    public static function existTokenUser(Request $request, $usuario_logueado, $token_user)
    {
    	$user = User::select( 'users.*' )
    				  ->whereRaw( "users.remember_token = '" . $token_user ."'")
 					  ->where('users.email', $usuario_logueado )
                      ->first();   					 

		if ($user) 
		{			
			// obtengo user actual, si no existe devuelve el valor por defecto pasado (null)				
			$usuario_actual = session('usuario_actual');

			if (is_null($usuario_actual)) {
				$request->session()->put('usuario_actual', $user->id);
				$request->session()->put('username', $user->name);
				$request->session()->put('useremail', $user->email);

			}			

			return $user;
		} else {
			return false;			
		}

    }


    
}
