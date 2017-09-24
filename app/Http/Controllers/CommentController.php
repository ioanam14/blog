<?php

namespace App\Http\Controllers;

use App\PostModel;
use App\CommentModel;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request, $slug)
    {
        $post = PostModel::where('slug', $slug)->firstOrFail();
        
        $data = [
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ];
        
        $comment = new CommentModel();
        $comment->fill($data);
        $comment->save();
        
        return redirect()->back()->with('alert-success', 'Comment was successfully added!');
    }
    
    public function editComment(Request $request)
    {
        $comment = CommentModel::where([['user_id', Auth::id()], ['id', $request->input('comment-id')]])->firstOrFail();
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with('alert-success', 'Comment was successfully edited!');
    }

    public function deleteComment(Request $request)
    {
        $comment = CommentModel::where([['user_id', Auth::id()], ['id', $request->input('comment-id')]])->firstOrFail();
        $comment->delete();
        
        return redirect()->back()->with('alert-success', 'Comment was successfully deleted!');
    }
}
