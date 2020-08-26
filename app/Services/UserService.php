<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Storage;
use DB;
use Mail;

use App\Mail\Welcome;

use App\User;

class UserService 
{    
	function __construct()
	{

	}	



	public function store( Request $request )	
	{		
        // validate
        // read more on validation at http://laravel.com/docs/validation
		$languages = config('translatable.locales');
        
        $rules = array();

        $rules['name'] 					=  'required|min:2';
        $rules['email'] 				=  'required|email';
        $rules['password'] 				=  'required|confirmed|min:3';
       	
 		
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        } else {

        	$data = [];
        	$data['name'] = $request->input('name');
        	$data['email'] = $request->input('email');
        	$data['password'] = crypt($request->input('password'), config('app.salt') );
        	$data['created_at'] = date('Y-m-d H:i:s');
 			
 			$user = User::create($data);
            
            if ($user->id) {
            	self::sendWelcomeEmail($user,$request->input('password'));
            	$request->session()->flash('message', 'New user created! The system just sent an email to '. $request->input('email') .' with your access data.');
            } else {            	
            	$request->session()->flash('message', 'Problem creating user, try again later.');
            }

            
            return redirect('register');

        }
		
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
