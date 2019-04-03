<?php

namespace App\Http\Controllers;

use App\Post;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'about']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        return view('index')->with('posts', $posts);
    }

    public function dashboard()
    {
        $posts = Post::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard')->with('posts', $posts);
    }

    public function about()
    {
        return view('about');
    }
}
