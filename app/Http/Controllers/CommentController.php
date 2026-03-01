<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => ['string', 'required'],
        ]);

        $comment = $post->comments()->make(['body' => $request->body]);
        $comment->user()->associate($request->user());
        $comment->save();

        return redirect()->route('post.show', $post);
    }

}
