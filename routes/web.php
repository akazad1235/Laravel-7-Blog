<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'siteController@home')->name('home');
Route::get('viewpost', 'siteController@viewpost');

//register
Route::get('registerForm', 'AuthController@registerForm')->name('registerForm');
Route::post('register', 'AuthController@register')->name('register');

//login
Route::get('loginForm', 'AuthController@loginForm')->name('loginForm');
Route::post('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');

//for admin code here
Route::group(['middleware'=> 'auth'], function(){
	Route::get('admin', 'Admin\adminController@admin')->name('admin');
	

	Route::prefix('categories')->name('categories.')->group(function(){

		Route::get('/', 'admin\categoryController@index')->name('index');
		Route::get('/addcategory', 'admin\categoryController@create')->name('create');
		Route::post('/store', 'admin\categoryController@store')->name('store');
		Route::delete('/delete/{id}', 'admin\categoryController@destroy')->name('delete');
		Route::get('/edit/{id}/{name}/{status}','admin\categoryController@edit')->name('edit');
		Route::put('/update/{id}','admin\categoryController@update')->name('update');
		
	});

});

// post code here

Route::group(['middleware' => 'auth'], function(){

	Route::prefix('post')->name('post.')->group(function(){
		Route::get('/', 'admin\postController@index')->name('index');
		Route::get('/addpost', 'admin\postController@create')->name('create');
		Route::post('/store', 'admin\postController@store')->name('store');

		Route::get('/edit/{id}','admin\postController@edit')->name('edit');
		Route::put('/update/{id}','admin\postController@update')->name('update');
		Route::delete('/delete/{id}', 'admin\postController@destroy')->name('delete');

	});
});


