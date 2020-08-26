<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\UserService;

class PostController extends Controller
{
    public function __construct(PostService $postService)
    {
    	$this->postService = $postService;
    }

    public function index(Request $request) 
    {
    	$data = $this->postService->index($request);

    	return view('index')->with( compact('data') );
    }

    public function create() 
    {
    	$date = date('Y-m-d');
    	return view('newPost', compact($date) );
    }


}
