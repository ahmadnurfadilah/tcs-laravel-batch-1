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
Route::get('/blog/{id}', 'BlogController@show'); //->middleware('auth');

Route::get('/admin', 'AdminController@index')->middleware('auth', 'admin');
Route::get('/admin/export-blog', 'AdminController@export')->middleware('admin');
Route::get('/admin/create-blog', 'AdminController@createBlog')->middleware('admin');
Route::post('/admin/create-blog', 'AdminController@storeBlog')->middleware('admin');
Route::get('/admin/edit-blog/{id}', 'AdminController@edit')->middleware('admin');
Route::post('/admin/edit-blog/{id}', 'AdminController@updateBlog')->middleware('admin');
Route::get('/admin/delete-blog/{id}', 'AdminController@deleteBlog')->middleware('admin');

Route::get('/contact', 'ContactController@index');
Route::post('/contact', 'ContactController@store');

// id
// name
// email
// title
// description
// DB::table('contacts')->insert([
//     'name' => $request->name,
//     'email' => $request->email,
//     'title' => $request->title,
//     'description' => $request->description,
// ]);

// Mail::to('admin@mycompany.com')->send(new SendBlogToAdmin());
