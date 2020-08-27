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


    public function login() 
    {
    	return view('login');
    }
  
    public function loginAccess() 
    {
        return $this->userService->loginAccess($request);   
    }

    public function register() 
    {
        return view('register');
    }

    //via ajax
    public function store(Request $request) 
    {
    	return $this->userService->store($request);
    }
   

}
