<?php

namespace App\Http\Controllers;

use App\PostModel;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts()
    {
        $posts = PostModel::orderBy('created_at', 'desc')->paginate(5);

        return view('post.list', compact('posts'));
    }

    public function getCreatePost()
    {
        return view('post.create');
    }

    public function createPost(Request $request)
    {
        $post = new PostModel();

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['slug'] = str_slug($data['title'], '-') . '-' . rand(0, 1000000000);

        $post->fill($data);
        $post->save();

        if ($post->id == null)
        {
            return redirect()->route('post.create')->with('alert-danger', 'There was an error!');
        }

        return redirect()->route('post.create')->with('alert-success', 'Post was successfully added!');
    }

    public function getPost($slug)
    {
        $post = PostModel::where('slug', $slug)->firstOrFail();

        $comments = $post->comments;

        return view('post.view', compact('post', 'comments'));
    }

    public function getEditPost($slug)
    {
        $post = PostModel::where([['slug', $slug], ['user_id', Auth::id()]])->firstOrFail();

        return view('post.edit', compact('post'));
    }

    public function editPost(Request $request, $slug)
    {
        $post = PostModel::where([['slug', $slug], ['user_id', Auth::id()]])->firstOrFail();

        $post->fill($request->all());
        $post->save();

        return redirect()->route('post.edit', ['slug' => $slug])->with('alert-success', 'Post was successfully edited!');
    }

    public function deletePost(Request $request)
    {
        $slug = $request->input('slug');

        $post = PostModel::where([['slug', $slug], ['user_id', Auth::id()]])->firstOrFail();

        $post->delete();

        return redirect()->route('user.posts')->with('alert-success', 'Post was successfully deleted!');
    }
}
