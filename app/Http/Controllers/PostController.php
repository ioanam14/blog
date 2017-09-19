<?php

namespace App\Http\Controllers;

use App\PostModel;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getCreatePost()
    {
        return view('post.create');
    }

    public function postCreatePost(Request $request)
    {
        $post = new PostModel();

        $data = $request->all();
        $data['user_id'] = Auth::id();

        $post->fill($data);
        $post->save();

        if ($post->id == null)
        {
            return redirect()->route('post.create')->with('alert-danger', 'There was an error!');
        }

        return redirect()->route('post.create')->with('alert-success', 'Post was successful added!');
    }
}
