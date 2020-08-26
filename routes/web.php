<?php

use Illuminate\Support\Facades\Route;



// aqui creamos la bbdd, lanzamos migrations y seeders
Route::get('/init', 	'InitController@init' );



Route::get('/', 'PostController@index' );
Route::get('/login', 	'UserController@login' );
Route::get('/register', 'UserController@create' );
Route::post('/user', 	'UserController@store' );


