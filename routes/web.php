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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('/welcome', function () {
    return view('welcome');
});

// Passing Parameters
Route::get('/post/{id}/{name}', function($id, $name){
    return "This is post number ". $id . " " . $name;
});

// Naming Routes                                           [php artisan routes:list]
Route::get('admin/posts/example', array('as'=>'admin.home' ,function(){

    $url = route('admin.home');
    return "this url is ". $url;

}));

// Post
Route::get('/post/{id}', 'PostsController@index');
Route::resource('posts', 'PostsController');
Route::get('/contact', 'PostsController@contact');
Route::get('post/{id}/{name}/{password}', 'PostsController@show_post');

