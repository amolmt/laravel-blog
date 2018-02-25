<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\user;
use App\Profile;
use App\Post;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $profile = DB::table('users')
                    ->join('profiles','users.id', '=', 'profiles.user_id')
                    ->select('users.*','profiles.*')
                    ->where(['profiles.user_id'=>$user_id])
                    ->first();
        $posts = Post::all();
        return view('home',['profile' => $profile, 'posts' => $posts]);
    }
}
