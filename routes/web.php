<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use App\Country;
use App\Photo;
use App\Tag;

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


/*
|--------------------------------------------------------------------------
| ELOQUENT
|--------------------------------------------------------------------------
*/
Route::get('/read', function(){
   $posts = Post::all();

   foreach($posts as $post) {
      return $post->title;
   }
});

Route::get('/find', function(){
   $post = Post::find(2);               // where id = 2
   return $post->title;

   /*
   $posts = Post::all();                // Display psot title, where id = 1
   foreach($posts as $post) {
     return $post->title;
   }
   */
});

Route::get('/findwhere', function(){
   $posts = Post::where('id', 2)
                ->orderBy('id', 'desc')
                ->take(1)
                ->get();
   return  $posts;
});

Route::get('/findmore', function(){
   // Find Post with id = 2, or return 404 page by ModelNotFoundException
   $post2 = Post::findOrFail(2);

   // Find Post with id = 1, or return 404 page by ModelNotFoundException
   $post1 = Post::where('id', '<', 50)->firstOrFail();

   return "First title: ". $post1->title."<br>Second Title: ".$post2->title;
});

Route::get('/basicinsert', function(){
   $post = new Post;
   $post->title = 'New Eloquent title insert';
   $post->content = 'Wow eloquent is really cool, look at this content';
   $post->save();
});

Route::get('/basicinsert2', function(){
   $post = Post::find(2);
   $post->title = 'New Eloquent title insert 2';
   $post->content = 'Wow eloquent is really cool, look at this content 2';
   $post->save();
});

Route::get('/create', function(){
   Post::create([
       'title'=>'the create method 2',
       'content'=>'WOW I\'am learning a lot with Edwin Diaz 2']);
});

Route::get('/update', function(){
   Post::where('id', 2)->where('is_admin', 0)->update([
       'title'=>'NEW PHP TITLE',
       'content'=>'I love my instructor Edwin']);
});

Route::get('/delete', function(){
   $post = Post::find(4);
   $post->delete();
});

Route::get('/delete2', function(){
   Post::destroy([4,5]);
   //   Post::where('is_admin', 0)->delete();
});

Route::get('/softdelete', function(){
   Post::find(10)->delete();
});

Route::get('/readsoftdelete', function(){
//   $post = Post::find(1);
//
//   return $post;

    // Current record
   $post = Post::withTrashed()->where('is_admin', 0)->get();

   return $post;

      $post = Post::onlyTrashed()->where('is_admin', 0 )->get();

   return $post;

});

Route::get('/readsoftdelete/1', function(){
    // Read All records with softdelete record
    $post = Post::withTrashed()->where('is_admin', 0)->get();

    return $post;
});

Route::get('/readsoftdelete/2', function(){
    // Read softdelete record only, where deleted_at !== null
    $post = Post::onlyTrashed()->where('is_admin', 0 )->get();

    return $post;
});

Route::get('/restore', function(){
   // Restore all record, including the softdelete records
   Post::withTrashed()->where('is_admin', 0)->restore();
});

Route::get('/forcedelete', function(){
    // Permanently delete softdelete records
    Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});



/*
|--------------------------------------------------------------------------
| ELOQUENT Relationships
|--------------------------------------------------------------------------
*/
// One to One relationship
Route::get('/user/{id}/post', function($id){
   return User::find($id)->post->content;
});

Route::get('/mypost/{id}/user', function($id){
    return Post::find($id)->user->name;
});


// One to Many relationship
Route::get('/myposts', function(){
   $user = User::find(1);
   foreach($user->posts as $post) {
      echo $post->title . "<br>";
   }
});




// Many to Many relationship
Route::get('/user/{id}/role', function($id){
    $user = User::find($id)->roles()->orderBy('id', 'desc')->get();
    return $user;
});

Route::get('/user/{id}/role/name', function($id){
    $user = User::find($id);
    foreach($user->roles as $role){
        return $role->name;
    }
});



// Accessing the intermediate table / pivot
Route::get('user/pivot', function(){
    // pivot refer to the relation between roles and users table {"user_id":1,"role_id":1}
    $user = User::find(1);
    foreach($user->roles as $role){
        //return $role->pivot;                      // {"user_id":1,"role_id":1,"created_at":"2020-03-04T12:05:00.000000Z"}
        return $role->pivot->created_at;            // "2020-03-04T12:05:00.000000Z"
    }
});

// Get posts in Country.php through hasManyThrough relation between Post and Country
Route::get('/user/country', function(){
  $country =  Country::find(4);                     // where country_id = 4
   foreach($country->posts as $post) {
       return $post->title;
   }
});


// Polymorphic Relations
Route::get('user/photos', function(){
    $user = User::find(1);
    foreach($user->photos as $photo) {
        return $photo->path;
    }
});

Route::get('post/{id}/photos', function($id){
    $post = Post::find($id);
    foreach($post->photos as $photo) {
        echo $photo->path . "<br>";
    }
});

// id=1, display user data; id=2, display post data
Route::get('photo/{id}/post', function($id){
    $photo =  Photo::findOrFail($id);
    return $photo->imageable;
});



// Polymorphic Many to Many
/*****************************************************
 * tag_id   * taggable_id   * post_id
 * 2        * 1             * 1
 * 3        * 2             * 2
 * 5        * 3             * 3
 */
Route::get('mypost/tag/{id}', function($id){
    //Works for Post
    $post = Post::find($id);
    dd($post->tags[0]);
    foreach($post->tags as $tag){
        echo $tag->name . "<br>";
    }
});

Route::get('/tag/post/{id}', function($id){         // id can try 2, 3, 5
    $tag = Tag::find($id);
    dd($tag->posts[0]);
    foreach($tag->posts as $post){
        return  $post->title;
    }
});

/*****************************************************
 * tag_id   * taggable_id   * video_id
 * 1        * 1             * 1
 * 4        * 2             * 2
 * 6        * 3             * 3
 */
Route::get('/tag/video/{id}', function($id){         // id can try 2, 3, 5
    $tag = Tag::find($id);
    foreach($tag->videos as $video){
        return  $video->title;
    }
});
