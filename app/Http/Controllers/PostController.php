<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\UserService;

use App\Post;

use Session;

class PostController extends Controller
{
    public function __construct(PostService $postService)
    {
    	$this->postService = $postService;
    }

    public function index(Request $request) 
    {
        //dd( Session::get('username') );
        $user = $request->attributes->get('user');
        $route = 'index';

        

    	$data = $this->postService->index($request);

        $order_by = $request->session()->get('order_by');

        $total_post = Post::count();

    	return view('index')->with( compact('data','user','route','order_by','total_post') );
    }

    public function create() 
    {
        $date = date('Y-m-d');

    	return view('createPost')->with($date);
    }

    public function store(Request $request) 
    {
        return $this->postService->store($request);
    }

    public function myPost(Request $request) 
    {
        $route = 'mypost';


        $data = $this->postService->myPost($request);
        
        $order_by = $request->session()->get('order_by');
        
        $total_post = Post::where('id_user',$request->session()->get('usuario_actual'))->count();

        return view('index')->with( compact('data','route','order_by','total_post') );
    }
    
    public function importPosts(Request $request) 
    {
        $this->postService->importPosts($request);
        
        $order_by = $request->session()->get('order_by');
        $route    = 'index';
        $total_post = Post::count();

        $data = $this->postService->index($request);

        return redirect('/')->with( compact('data','route','order_by','total_post') );
    }    
    
}
