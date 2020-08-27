<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoginService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;

class AccessController extends Controller
{

    public function __construct()
    {
        
    }

    public function login(Request $request)
    {
        $errMsg = '';
        $user = false;
        $token = null;
        $cookies = null;


        $rules = array();

        $rules['email']                 =  'required|email';
        $rules['password']              =  'required|min:3';
                
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $arr_error = array();
            $errores = $validator->messages()->getMessages();
            foreach ($errores as $key => $value) {
                     $arr_error[] = $key.": ".array_values($value)[0];
            } 

            $result     = $arr_error;
            $error      = true;
            $validator  = true;

        
            return json_encode([
                "error"         => $error,
                "validator"     => $validator,
                "response"      => $result,
            ]);

        } else {        
            
            $data = new \Stdclass;
            $data->usuario = $request->input('email');;
            $data->clave   = $request->input('password');
            
            $token_user       = $request->cookie('_userToken');
            $usuario_logueado   = $request->cookie('_userLogged');

            // Comprobamos si existe la cookie de autenticación en la bbdd
            if (!is_null($token_user) && !is_null($usuario_logueado) && strlen($token_user)>0) {
                $user = LoginService::existTokenUser($request, $usuario_logueado, $token_user);
            } 

            // Si no existe token no trae useres, en tal caso hacemos un nuevo login y creamos de nuevo el token
            if (!$user) {

                //trae un objeto con los useres y el token
                $user = LoginService::login($request, $data, $errMsg, $token);

                if ($user !== false) {
                    $cookies = [];
                    $cookies[0] = cookie('_userToken', $token, 1440);
                    $cookies[1] = cookie('_userLogged', $data->usuario, 1440);
                }
            }
            
            if (!$user) {
                return apiResponseError($errMsg,'response');
            } else {              
                return apiResponse($user, $cookies);
            }
        }
    }



    public function logout(Request $request)
    {
        /*
        Session::flush();
        Session::regenerate();
        */

        $cookie[0] = \Cookie::forget('_userToken');
        $cookie[1] = \Cookie::forget('_userLogged');

        $request->session()->forget(['username', 'useremail', 'usuario_actual']);

        //al devolver la respuesta con los nuevos valores de las cookies, estas se eliminan
        return apiResponse("Su sesión se ha cerrado correctamente.",$cookie);
    }


}
