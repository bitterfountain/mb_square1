<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Storage;
use DB;
use Mail;
use Validator;

use App\Mail\Welcome;

use App\User;

class UserService 
{    
	function __construct()
	{

	}	



	public function store( Request $request )	
	{		
        $validator  = false;
        $error      = false;
        // validate
        // read more on validation at http://laravel.com/docs/validation
       
        $rules = array();

        $rules['name'] 					=  'required|min:2';
        $rules['email'] 				=  'required|email';
        $rules['password'] 				=  'required|confirmed|min:3';
       	
 		
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
        } else {

        	$data = [];
        	$data['name'] = $request->input('name');
        	$data['email'] = $request->input('email');
        	$data['password'] = crypt($request->input('password'), config('app.salt') );
        	$data['created_at'] = date('Y-m-d H:i:s');

            try {             		
 			    $user = User::create($data);
                $validator = null;
            } catch (\Exception $e)  {
                $error = true;
                $errorCode  = $e->errorInfo[1];
                if($errorCode == 1062){
                    $result = "Duplicate email, the entered email exists in database, please, choose other email.";
                } else {
                    $result = $e->getMessage();
                }
            }
            
            if (!$error) 
            {
                if ($user->id) {
                	self::sendWelcomeEmail($user,$request->input('password'));
                	$result = 'New user created! The system just sent an email to '. $request->input('email') .' with your access data.';
                    $error  = false;
                } else {            	
                	$result = 'Problem creating user, try again later.';
                    $error  = true;
                }
            }
            

        }
        
        return json_encode([
            "error"         => $error,
            "validator"     => $validator,
            "response"      => $result,
        ]);
		
	}

    

	public static function sendWelcomeEmail($user, $clave)
	{
		$base 		= config('app.url');		
		$email_from = 'no-reply@square1_testblog.com';

		$link 		= $base."/login";
		$subject 	= "Welcome to " .  config('app.name');

		$data =  [
			"clave" 		=> $clave,
			"link" 			=> $link,
			"name" 			=> $user->name,
			"email" 		=> $user->email,
			"email_from" 	=> $email_from,
			"subject" 		=> $subject,
			"reply_to" 		=> $email_from,
			"reply_to_name"	=>  config('app.name') . " - No Reply",
		];

    	Mail::to($user->email)->send( new Welcome($data) );


	}	



}
