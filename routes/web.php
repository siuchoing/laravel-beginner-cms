<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Role;

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

/***********************************
 * Many to Many Relation for CRUD
 */

// Create Administrator Role
Route::get('/create', function(){
    $user = User::find(1);
    $role = new Role(['name'=>'Administrator']);
    $user->roles()->save($role);
});

// Read User's Role Name
Route::get('/read', function(){
    $user = User::findOrFail(1);
    foreach($user->roles as $role){
        echo $role->name;
    }
});

// Update User's Role Name
Route::get('/update', function(){
    $user = User::findOrFail(1);
    if($user->has('roles')){
        foreach($user->roles as $role){
            if($role->name == 'Administrator'){
                $role->name = "subscriber";
                $role->save();
            }
        }
    }
});

Route::get('/delete', function(){
    $user = User::findOrFail(5);
    foreach($user->roles as $role){
        $role->whereId(5)->delete();
    }
});



/****************************
 * Attaching, detaching and syncing
 */
// Attaching: To create a record in role_user table
Route::get('/attach', function(){
    $user = User::findOrFail(1);
    $user->roles()->attach(4);
});

// detaching: To force delete all User1's record in role_user table
Route::get('/detach', function(){
    $user = User::findOrFail(1);
    $user->roles()->detach();
});

// syncing: To force delete and all User1's records without role_id = [6,7],
//          and build new record(s) if the table have no record with role_id = [6,7],
//          then finally will have two records in table, one with role_id = 6, and one with role_id = 7

Route::get('/sync', function(){
    $user = User::findOrFail(1);
    $user->roles()->sync([6,7]);
});
