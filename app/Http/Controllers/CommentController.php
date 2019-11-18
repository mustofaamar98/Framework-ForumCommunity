<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Comment;
Use App\Forum;
Use Auth;

class CommentController extends Controller
{
    public function addComment(Request $request, Forum $forum)
    {
        $comment = New Comment;
        $comment->user_id = Auth::user()->id;
        $comment->content = $request->content;

        $forum->comments()->save($comment);

        return back()->withInfo('Komentar Terkirim');
    
    }
    public function replyComment(Request $request, Comment $comment)
    {
        $reply = New Comment;
        $reply->user_id = Auth::user()->id;
        $reply->content = $request->content;

        $comment->comments()->save($reply);

        return back()->withInfo('Komentar balasan Terkirim');
    }
}
