<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;


class CommentController extends Controller
{
    
    public function delete($id)
    {
        $comment = Comment::find($id);
        
        if(Gate::allows('comment-delete', $comment)){
            $comment->delete();
            return back()->with('info','An Article Deleted');
        }

        return back()->with('info','Unauthorize to delete');
    }

    public function create()
    {
        $validator = validator(request()->all(),[
           'content' => 'required',
           'article_id' => 'required' 
        ]);

        if($validator->fails()){
            return back()->withErrors($validator); 
        }

        $comment = new Comment();
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back()->with('info','A new Comment added');
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit',[
            'comment' => $comment
        ]);
    }

    public function update($id)
    {
        $comment = Comment::find($id);
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        if(Gate::allows('comment-delete', $comment)){
            $comment->save();
            redirect("/articles/detail/$comment->article_id");
        }
        return redirect("/articles/detail/$comment->article_id");
    }
}   
