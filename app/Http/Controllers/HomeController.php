<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function showLocalSession(Request $request) {
        //return $request->session()->all();

        // local session
        $request->session()->put(['edwin'=>'master instructor']);
        return $request->session()->get('edwin');
    }

    public function showGlobalSession(Request $request) {
        // Global session
        session(['peter'=>'student']);  //最常用

        // Clean a session
        $request->session()->forget('edwin');

        // Clean all sessions
        $request->session()->flush();

        // Display session
        return session('peter');
        //return $request->session()->all();
    }


    public function cleanSession(Request $request) {

        $request->session()->flash('peter', 'Peter is a man');
        $request->session()->flash('mary', 'Mary is a girl');

        // Clean a session
        $request->session()->forget('mary');

        // Clean all sessions
        $request->session()->flush();
        return $request->session()->all();
    }

    // Session data stored until next http request, and then will be deleted.
    public function getFlashData(Request $request) {
        $request->session()->flash('message', 'Post has been created');
        return $request->session()->get('message');
    }

    // Session data stored until next http request, and then will be deleted.
    public function keepFlashDataToNextRequest(Request $request) {
        $request->session()->flash('message', 'Post has been created');

        // keep storing all of the flash data for an additional request
        $request->session()->reflash();

        // keep storing specific flash data for an additional request
        $request->session()->keep(['message']);

        return $request->session()->all();
    }

}
