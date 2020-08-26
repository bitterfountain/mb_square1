<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Storage;
use DB;
use Mail;

use App\User;
use App\Post;

class PostService 
{    
	function __construct()
	{

	}	



	public function store( Request $request )	
	{		      
        $rules = array();

        $rules['title'] 				=  'required|min:2';
        $rules['description'] 			=  'required|min:10';
        $rules['date'] 					=  'required|date';
       	
 		
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('new_post')
                        ->withErrors($validator)
                        ->withInput();
        } else {

        	$data = [];
        	$data['title'] 			= $request->input('title');
        	$data['description'] 	= $request->input('description');
        	$data['date'] 			= $request->input('date');
        	$data['id_user'] 		= $request->user()->id;
 			
 			$post = Post::create($data);
            
            if ($post->id) {
            	$request->session()->flash('message', 'New post created! ID: #' . $post->id);
            } else {            	
            	$request->session()->flash('message', 'Problem creating post, something went bad.');
            }

            
            return redirect('/');

        }
		
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
