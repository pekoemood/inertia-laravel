<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::query()
                    ->with('user')
                    ->latest()
                    ->cursorPaginate(10);
        return Inertia::render('Post/Index', compact('posts'));
    }

    public function show(Post $post): Response
    {
        $post = $post->load('user');
        return Inertia::render('Post/Show', compact('post'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['string', 'max:255', 'required'],
            'body' => ['string', 'required'],
        ]);

        $request->user()->posts()->create($request->validated());

        return redirect()->route('post.index');
    }
}
