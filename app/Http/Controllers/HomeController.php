<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {
        // Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $post = Post::whereIn('user_id', $ids)->latest()->paginate(3);
        $user = auth()->user();
        return view('home',[
            'post' => $post,
            'user' => $user,
        ]);
    }
}
