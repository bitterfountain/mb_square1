<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Storage;
use DB;
use Mail;
use Session;
use Validator;

use App\User;
use App\Post;

class PostService 
{    
	function __construct()
	{

	}	



	public function store( Request $request )	
	{		 
        $error = false;
        $validator = false;

        if ( Session::has('useremail')  ) {
            $user = User::where('email', Session::get('useremail') )->first();
        } else {
            $user = false;
        }

        if (!$user) {
            return json_encode([
                "error"         => 1,
                "validator"     => 0,
                "response"      => "No user logged found, try to login again",
            ]);               
        }

        $rules = array();

        $rules['title'] 				=  'required|min:2';
        $rules['description'] 			=  'required|min:10';
        $rules['date'] 					=  'required|date';
       	
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
        	$data['title'] 			= $request->input('title');
        	$data['description'] 	= $request->input('description');
        	$data['date'] 			= $request->input('date');
        	$data['id_user'] 		= $user->id;
 			
 			$post = Post::create($data);
            
            if ($post->id) {
            	$result = 'New post created! ID: #' . $post->id;
            } else {            	
                $result = 'Problem creating post, something went bad.';
            }
        }

        
        return json_encode([
            "error"         => $error,
            "validator"     => $validator,
            "response"      => $result,
        ]);        
		
	}




	public function myPost( Request $request )	
	{		

        if ( Session::has('useremail')  ) {
            $user = User::where('email', Session::get('useremail') )->first();
        } else {
            $user = false;
        }

        if (!$user) return null;

    	$posts = Post::leftjoin('users','users.id','=','posts.id_user')
					 ->selectRaw('users.name, users.email, posts.*')
                     ->where('users.id', $user->id )
					 ->orderBy('date','desc')
					 ->paginate(5);
        
        return $posts;  	
	}


    public function index( Request $request )   
    {       
        
        $posts = Post::leftjoin('users','users.id','=','posts.id_user')
                     ->selectRaw('users.name, users.email, posts.*')
                     ->orderBy('date','desc')
                     ->paginate(5);
        
        return $posts;      
    }


}
