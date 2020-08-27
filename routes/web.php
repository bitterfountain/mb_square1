<?php

use Illuminate\Support\Facades\Route;



// aqui creamos la bbdd, lanzamos migrations y seeders
Route::get('/init', 	'InitController@init' );


Route::post('/login', 	'AccessController@login');
Route::post('/logout',	'AccessController@logout');


Route::get('/', 'PostController@index' );

Route::get('/login', 	'UserController@login' );   
Route::get('/register', 'UserController@register' );

Route::get('/mypost', 	 'PostController@myPost' ); 
Route::get('/newpost', 	 'PostController@create' ); 
Route::post('/savepost', 'PostController@store' ); 

Route::post('/user', 	'UserController@store' );


