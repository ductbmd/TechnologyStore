<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts/client');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('product','ProductController');
Route::resource('company','CompanyController');
Route::get('/index',['as'=>'client.index','uses'=>'ClientController@index']);
Route::get('client/product/{id}',['as'=>'client.product','uses'=>'ClientController@product']);
Route::get('client/checkout',['as'=>'client.checkout','uses'=>'ClientController@checkout']);
Route::get('client/viewcart',['as'=>'client.viewcart','uses'=>'ClientController@viewCart']);
Route::get('/add-to-cart/{id}',['as'=>'product.addtocart','uses'=>'ProductController@getAddToCart']);
