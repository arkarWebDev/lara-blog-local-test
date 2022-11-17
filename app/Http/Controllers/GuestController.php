<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Post $post,User $user){
        $posts = $post->latest('id')->paginate(10)->withQueryString();
        $users = $user->latest('id')->paginate(5)->withQueryString();
        return view('guest.index',compact('posts','users'));
    }
}