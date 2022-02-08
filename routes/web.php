<?php

use Illuminate\Support\Facades\Route;
use App\Products;
use App\User;
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


Auth::routes();

Route::get('/products/{id}', 'ProductsController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {
    
   Route::get('/welcome', "HomeController@welcome");
   
  
  Route::get('/carrinho', function () {

   return view('carrinho', ['produtos'=>Auth()->user()->pedidos]);
  });

  Route::post('/products_carrinho/join', 'ProductsController@join');

 

});


Route::group(['middleware' => 'role:admin'], function() {

   Route::get('/create_produtcs', 'ProductsController@create');
   Route::post('/create_produtcs/create', 'ProductsController@store');
   Route::get('/create_produtcs/{id}/edit', 'ProductsController@edit');
   Route::put('/create_produtcs/{produto}', 'ProductsController@update');
   Route::get('/manage_products', 'ProductsController@index');
   Route::get('/manage_products/list', 'ProductsController@list');
   Route::get('/manage_users/list', 'ProductsController@userlist');
   Route::get('/manage_users', function (){
      return view('userlist');
   });
   Route::get('/manage_users/change_role_permission/{id}', 'ProductsController@change_role_permission');
   Route::delete('/manage_users/delete_user/{id}', "ProductsController@delete_user");
   Route::delete('/manage_products/delete/{id}', "ProductsController@destroy");

   
   

 
 });

 Route::group(['middleware' => 'role:user'], function() {

    Route::get('/manager', function() {
 
       return 'Welcome manager';
       
    });
 
 });






