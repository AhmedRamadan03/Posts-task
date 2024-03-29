<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
        return view('home' , [
            'posts' => Post::with('comments')->latest()->get(),
            'post_id' => request()->post_id > 0? Post::find(request()->post_id) : new Post(),
        ]);
    }
}
