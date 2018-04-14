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
Route::post('/forgetpassword/{verification_code}','AuthController@resetpass');

Route::get('/product/{id}', "ProductController@find");
Route::get('/most_featured',"ProductController@most_featured");
Route::get('/new_release',"ProductController@new_release");

Route::post('/invoice', "InvoiceController@register");
Route::get('/invoice', "InvoiceController@all");
Route::get('/invoice/{id}', "InvoiceController@find");
Route::delete('/invoice/{id}', "InvoiceController@delete");
Route::put('/invoice/{id}', "InvoiceController@updateData");

Route::get('/getcarousel',"CarouselController@getAll");
Route::get('/getfeatureds','FeaturedController@getAll');

Route::post('invoice',"InvoiceController@register");

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::put('editprofile', 'AuthController@EditProfile');
    Route::get('getname', 'AuthController@getName');
    Route::get('getuser', 'AuthController@getUser');
    Route::post('addtocart/{id}', 'OrderController@addToCart');
});
