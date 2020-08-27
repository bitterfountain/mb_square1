<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\UserService;

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

    	$data = $this->postService->index($request);

    	return view('index')->with( compact('data') );
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
        $data = $this->postService->myPost($request);
        return view('index')->with( compact('data') );
    }
}
