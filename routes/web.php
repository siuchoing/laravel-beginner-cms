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



/*
|--------------------------------------------------------------------------
| DATABASE Raw SQL Queries
|--------------------------------------------------------------------------
*/
Route::get('rawSQL/insert', function(){
   DB::insert('insert into posts(title, content) values(?, ?)', [
       'Laravel is awesome with Edwin',
       'Laravel is the best thing that has happened to PHP, PERIOD'
   ]);
});

Route::get('rawSQL/read', function() {
   $results = DB::select('select * from posts where id = ?', [1]);
   //return var_dump($results);
   foreach($results as $post){
      return $post->title;
   }
});

Route::get('rawSQL/update', function(){
   $updated = DB::update('update posts set title = "Update title" where id = ?', [1]);
   return $updated;
});

Route::get('rawSQL/delete', function(){
   $deleted = DB::delete('delete from posts where id = ?', [1]);
   return $deleted;
});


