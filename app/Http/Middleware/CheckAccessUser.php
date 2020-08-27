<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use App\Services\LoginService;
use App\user;
use Illuminate\Support\Facades\Hash;
use Session;

class CheckAccessUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token_user   = $request->cookie('_userToken');
        $userLogged   = $request->cookie('_userLogged');

        if (!is_null($token_user) && strlen($token_user)>0) 
        {
            /* 
                Comprobamos si existe la cookie de autenticación en la bbdd y
                Devuelve el primer user que encuentra con el token dado o false si no encuentra 
                ningún user.
            */
            $user = LoginService::existTokenUser($request, $userLogged, $token_user);
            if ( $user !== false ) {
                // agregamos el user como atributo del request para tenerlo disponible en los controladores                
                $request->attributes->add(['user' => $user]);
                return $next($request);
            } else {
                return apiResponseError("La cookie de autenticación no es válida. Necesita loguearse de nuevo. $token_user");
            }
        } else {
            return apiResponseError( "No existe cookie de autenticación, necesita iniciar sesión de nuevo.");
        }

    }
}
