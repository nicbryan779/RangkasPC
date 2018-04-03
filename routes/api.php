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
Route::post('/login', "UserController@login");
Route::post('/changepassword/{id}',"UserController@changepassword");

Route::get('/register/confirm/{token}/{id}', 'UserController@confirmEmail');
Route::get('/forgetpassword/{id}','UserController@forgotpassword');
Route::post('/forgetpassword/{token}/{id}', 'UserController@newpass');

Route::post('/product', "ProductController@register");
Route::get('/product', "ProductController@all");
Route::get('/product/{id}', "ProductController@find");
Route::delete('/product/{id}', "ProductController@delete");
Route::put('/product/{id}', "ProductController@updateData");
Route::post('/updateimg/{id}', "ProductController@updateImg");

Route::post('/invoice', "InvoiceController@register");
Route::get('/invoice', "InvoiceController@all");
Route::get('/invoice/{id}', "InvoiceController@find");
Route::delete('/invoice/{id}', "InvoiceController@delete");
Route::put('/invoice/{id}', "InvoiceController@updateData");

Route::post('/admin', "AdminController@register");
Route::get('/admin', "AdminController@all");
Route::get('/admin/{id}', "AdminController@find");
Route::delete('/admin/{id}', "AdminController@delete");
Route::put('/admin/{id}', "AdminController@updateData");
Route::post('/adminlogin',"AdminController@login");
Route::post('/adminchangepass/{id}',"AdminController@changepassword");

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
    });
});
