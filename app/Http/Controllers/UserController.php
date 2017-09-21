<?php

namespace App\Http\Controllers;

use App\PostModel;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getPosts()
    {
        $user = User::find(Auth::id());

        if($user != null)
        {
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('post.list', compact('posts'));
    }
}
