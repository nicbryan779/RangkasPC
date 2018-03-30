<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/user', "UserController@register");
Route::get('/user', "UserController@all");
Route::get('/user/{id}', "UserController@find");
Route::delete('/user/{id}', "UserController@delete");
Route::put('/user/{id}', "UserController@updateData");

Route::post('/product', "ProductController@register");
Route::get('/product', "ProductController@all");
Route::get('/product/{id}', "ProductController@find");
Route::delete('/product/{id}', "ProductController@delete");
Route::put('/product/{id}', "ProductController@updateData");
