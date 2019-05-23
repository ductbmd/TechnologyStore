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
Route::resource('CompanyController','CompanyController');
Route::get('/index',['as'=>'client.index','uses'=>'ClientController@index']);
Route::get('client/product/{id}',['as'=>'client.product','uses'=>'ClientController@product']);
Route::get('client/laptop/{id}',['as'=>'client.laptop','uses'=>'ClientController@laptop']);
Route::get('client/checkout',['as'=>'client.checkout','uses'=>'ClientController@checkout']);
Route::get('client/viewcart',['as'=>'client.viewcart','uses'=>'ClientController@viewCart']);
Route::get('client/store',['as'=>'client.store','uses'=>'ClientController@storeProduct']);
Route::get('/add-to-cart/{id}',['as'=>'product.addtocart','uses'=>'ProductController@getAddToCart']);
Route::get('/sub-to-cart/{id}',['as'=>'product.subtocart','uses'=>'ProductController@getSubToCart']);
Route::get('/add-laptop-to-cart/{id}',['as'=>'laptop.addtocart','uses'=>'LaptopController@getAddToCart']);
Route::get('/sub-laptop-to-cart/{id}',['as'=>'laptop.subtocart','uses'=>'LaptopController@getSubToCart']);