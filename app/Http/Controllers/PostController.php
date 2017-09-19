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

        print '<pre>';
        print_r($request->all());
        print '</pre>';
        die();
    }
}
