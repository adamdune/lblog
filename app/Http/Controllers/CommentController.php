<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->input('post_id');
        $comment->save();

        return redirect("/posts/$comment->post_id#comment-$comment->id")->with('success', 'Comment Posted');
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = Comment::findOrFail($id);

        if (auth()->user()->id !== $comment->user_id){
            return redirect("/posts/$comment->post_id#comment-$id")->with('error', 'Unauthorized Edit');
        }

        $comment->comment = $request->input('comment');
        $comment->edited = true;
        $comment->save();

        return redirect("/posts/$comment->post_id#comment-$id")->with('success', 'Comment Updated');
    }
    
    public function  destroy($id){
        $comment = Comment::findOrFail($id);

        if (auth()->user()->id !== $comment->user_id){
            return redirect("/posts/$comment->post_id")->with('error', 'Unauthorized Deletion');
        }

        $comment->delete();

        return redirect("/posts/$comment->post_id")->with('success', 'Comment Deleted');
    }
}
