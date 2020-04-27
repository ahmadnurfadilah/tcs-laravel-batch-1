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

// Route::get('/hello', function() {
//     return "Hello, ini laravel";
// });

// Route::get('/user', function() {
//     return "Hello, ini halaman user";
// });

// Route::redirect('/page-1', 'page-2');

// Route::view('/testing', 'welcome');

// Route::get('/blog/{id}', function() {
//     return 'asdasd';
// });

Route::get('hello', 'HelloController@index');
Route::get('hello/{name}', 'HelloController@show');