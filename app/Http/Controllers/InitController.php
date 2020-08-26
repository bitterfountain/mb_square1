<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Artisan;

use App\User;

class InitController extends Controller
{

    public function init(Request $request) 
    {

		$result = "";

		try{
			
			// sino existe tabla users, da una excepcion
			$total = User::count();
	     	
	     	$result .= "\nTable users already exists with $total user. \n\nYour blog app is ready!";
	
		} catch (\Exception $e) {
	
			try{
				$dbname 		= config('app.db_database');
				$connection 	= config('app.db_connection');


				Artisan::call('migrate', array('--path' => 'database/migrations', '--force' => true));		     	
		     	$result .= "Migrations executed!\n";
				
				
				Artisan::call('db:seed');
		     	$result .= "Seeders executed!\n";
		     	
		     	$result .= "You Blog App is ready to use!\n";

		     	$result .= "\n Time: " . date('Y-m-d H:i:s');
				
			} catch (\Exception $e2) {
			 	$result = $e2->getMessage() . "\n";
			}

		}


		return view('init')->with(compact('result'));

    }

    public function create(Request $request) 
    {
    	 return view('create')->with(compact('modulos','modulo'));
    }


}
