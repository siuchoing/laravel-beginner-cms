<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::sortLatest();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        # Method 1
//        $post = $request->title;
//        $post = $request->content;
//        $post = Post::create([
//                    'title' => $request->title,
//                    'content' => $request->content,
//                    'user_id' => Auth::id()
//                ]);
//        return redirect('/posts');


//        # Method 2
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        Post::create($input);
        return redirect('/posts');

//        # Method 3
//        $post = new Post;
//        $post->title = $request->title;
//        $post->content = $request->content;
//        $post->user_id = Auth::id();
//        $post->save();
//        return redirect('/posts');
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::whereId($id)->delete();
        return redirect('/posts');
    }

    public function contact()
    {
        $user = ['Anthony', 'Sam', 'Tom'];
        return view('contact', 'user');
    }

    public function show_post($id, $name, $password) {
        //return view('post')->with('id', $id);
        return view('post', compact('id', 'name', 'password'));
    }
}
