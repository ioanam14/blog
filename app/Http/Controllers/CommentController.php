<?php

namespace App\Http\Controllers;

use App\PostModel;
use App\CommentModel;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request, $slug)
    {
        $comment = new CommentModel();

        $post = PostModel::where('slug', $slug)->firstOrFail();

        $data = [
            'comment' => $request->input('comment'),
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ];

        $comment->fill($data);
        $comment->save();

        return redirect()->route('post.view', ['slug' => $slug])->with('alert-success', 'Comment was successfully posted!');
    }

    public function editComment (Request $request)
    {
        $comment = CommentModel::where([['id', $request->input('comment_id')], ['user_id', Auth::id()]])->firstOrFail();
        
        $comment->fill($request->all());
        $comment->save();

        return redirect()->back()->with('alert-success', 'Comment was successfully edited!');
    }

    public function deleteComment (Request $request)
    {

    }
}
