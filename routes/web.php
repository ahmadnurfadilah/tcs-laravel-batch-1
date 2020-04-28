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


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/blog', 'BlogController@index'); //->middleware('auth');

Route::get('/admin', 'AdminController@index')->middleware('auth');
Route::get('/admin/create-blog', 'AdminController@createBlog')->middleware('auth');
Route::post('/admin/create-blog', 'AdminController@storeBlog')->middleware('auth');
