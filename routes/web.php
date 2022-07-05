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


/**
 * Rota para criar as permissions e os usuarios com elas:
 */
//Route::get('/permission', 'PermissionController@Permission');  


/**
 * Rotas publicas, todos podem acessar: User, Admin, Guest.
 */
Route::get('/products/{id}', 'ProductsController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


/**
 * Rotas para pessoas logadas. 
 */
 Route::group(['middleware' => 'auth'], function() {
   Route::get('/carrinho', 'ProductsController@carrinho');
   Route::post('/products_carrinho/join', 'ProductsController@join');
 });


 /**
 * Rotas para pessoas com a role admin.
 */
Route::group(['middleware' => 'role:admin'], function() {

  //CRUD de produtos:
   Route::get('/create_produtcs', 'ProductsController@create');
   Route::post('/create_produtcs/create', 'ProductsController@store');
   Route::get('/create_produtcs/{id}/edit', 'ProductsController@edit');
   Route::put('/create_produtcs/{produto}', 'ProductsController@update');
   Route::delete('/manage_products/delete/{id}', "ProductsController@destroy");


   //Manage de de produtos:
   Route::get('/manage_products', 'ProductsController@index');
   Route::get('/manage_products/list', 'ProductsController@list');
   

   //Manage de users:
   Route::get('/manage_users/list', 'ProductsController@userlist');
   Route::get('/manage_users', function (){
      return view('userlist');
   });
   Route::get('/manage_users/change_role_permission/{id}', 'ProductsController@change_role_permission');
   Route::delete('/manage_users/delete_user/{id}', "ProductsController@delete_user");
  

 });







