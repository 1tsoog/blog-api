<?php

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Example
//Route::middleware('auth:api')->post('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/post', 'API\PostController@getPosts')->name('api.getPosts');
Route::post('/post', 'API\PostController@createPost')->name('api.createPost');
Route::get('/post/{id}', 'API\PostController@showPost')->name('api.showPost');
Route::put('/post/{id}', 'API\PostController@updatePost')->name('api.updatePost');
Route::delete('/post/{id}', 'API\PostController@deletePost')->name('api.deletePost');