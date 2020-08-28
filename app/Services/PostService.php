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

use GuzzleHttp\Client as ClientGuzzle;

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
        	$data['date'] 			= $request->input('date') . ' ' . date("H:i:s");
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



    /* funcion para llamar desde una tarea programada  */

	public function importPosts( Request $request )	
	{		
        $result = null;
        $client = new ClientGuzzle();

        $url_source = 'https://sq1-api-test.herokuapp.com/posts';
        $res = $client->request('GET', $url_source);

        if ( $res->getStatusCode() == 200 ) {
            $new_posts = $res->getBody();
            $new_posts = (object) json_decode($new_posts, true);
            $total = 0;                
            foreach ($new_posts->data as $new_post ) {
                $new_post = (object) $new_post;
                $post = new Post;
                $post->title        = $new_post->title;
                $post->description  = $new_post->description;
                $post->date         = $new_post->publication_date;
                $post->id_user      = 1; //admin
                if ( $post->save() ) {
                    $total++;
                }
            }
            $result = $total . ' new post imported from ' . $url_source . ".\n";
        } else {
            $result = 'Site ' . $url_source . " may have problems, system can`t get new posts.\n";
        }

        $request->session()->flash('import', $result);

        return $result;
	}

    public function myPost( Request $request )  
    {       

        if ( Session::has('useremail')  ) {
            $user = User::where('email', Session::get('useremail') )->first();
        } else {
            $user = false;
        }

        if (!$user) return null;

        $order_by = $request->session()->get('order_by');
        
        if ($request->has('order_by')) {
            $order_by = $request->input('order_by');
            $request->session()->put('order_by',$order_by);
        }

        if ( !isset($order_by) ) 
            $order_by = 'desc';


        $posts = Post::leftjoin('users','users.id','=','posts.id_user')
                     ->selectRaw('users.name, users.email, posts.*')
                     ->where('users.id', $user->id )
                     ->orderBy('date',$order_by)
                     ->paginate(5)->onEachSide(1);
        
        return $posts;      
    }


    public function index( Request $request )   
    {       
        $order_by = $request->session()->get('order_by');
        
        if ($request->has('order_by')) {
            $order_by = $request->input('order_by');
            $request->session()->put('order_by',$order_by);
        }

        if ( !isset($order_by) ) 
            $order_by = 'desc';

        $posts = Post::leftjoin('users','users.id','=','posts.id_user')
                     ->selectRaw('users.name, users.email, posts.*')
                     ->orderBy('date', $order_by)
                     ->paginate(5)->onEachSide(1);
        
        return $posts;      
    }


}
