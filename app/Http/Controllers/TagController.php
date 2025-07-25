<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('posts')
            ->orderByDesc('posts_count')
            ->get();
        return view('tags.index', compact('tags'));
    }

    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->where('is_published', true)->orderByDesc('published_at')->paginate(10);

        return view('tags.show', compact('tag', 'posts'));
    }
}
