<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
    	$this->userService = $userService;
    }


    public function register() 
    {
    	return view('register');
    }

    public function store(Request $request) 
    {
    	$result = $this->userService->store($request);

    	return view('register');   	
    }



}
