<?php

use Illuminate\Support\Facades\Route;



// aqui creamos la bbdd, lanzamos migrations y seeders
Route::get('/init', 	'InitController@init' );


Route::post('/login', 	'AccessController@login');
Route::post('/logout',	'AccessController@logout');


Route::get('/', 'PostController@index' );

Route::get('/login', 	'UserController@login' );   
Route::get('/register', 'UserController@register' );

Route::get('/mypost', 	 'PostController@myPost' )->middleware('check.access');
Route::get('/newpost', 	 'PostController@create' )->middleware('check.access');
Route::post('/savepost', 'PostController@store' )->middleware('check.access');

Route::get('/importposts', 'PostController@importPosts' )->middleware('check.access');

Route::post('/user', 	'UserController@store' );


