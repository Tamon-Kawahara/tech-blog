<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query()->where('is_published', true);

        if ($request->filled('search')) {
            $keyword = $request->input('search');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('body', 'like', "%{$keyword}%");
            });
        }

        $posts = $query->orderByDesc('published_at')->get();

        return view('posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'eyecatch' => 'nullable|image|max:2048',
            'tags' => 'array', // ← 追加
            'tags.*' => 'exists:tags,id', // ← 追加
        ]);

        // 🔽 slugを生成し、日本語対応として空だったらランダム文字列にする
        $slug = \Illuminate\Support\Str::slug($validated['title']);
        if (empty($slug)) {
            $slug = \Illuminate\Support\Str::random(8); // ★← ここで対応！
        }

        $eyecatchPath = $request->file('eyecatch')?->store('eyecatches', 'public');

        // 🔽 slugは上で生成した変数を使うように変更！
        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'body' => $validated['body'],
            'category_id' => $validated['category_id'] ?? null,
            'is_published' => $request->has('is_published'),
            'published_at' => $request->has('is_published') ? now() : null,
            'eyecatch' => $eyecatchPath,
        ]);

        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('posts.index')->with('success', '記事を投稿しました！');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // 公開済みでない場合は404
        abort_unless($post->is_published, 404);

        // 🔽関連記事を追加（カテゴリが一致、かつ自分以外、公開済み）
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'eyecatch' => 'nullable|image|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $slug = Str::slug($validated['title']);
        if (empty($slug)) {
            $slug = Str::random(8);
        }
        $eyecatchPath = $request->file('eyecatch')?->store('eyecatches', 'public');

        $post->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'body' => $validated['body'],
            'category_id' => $validated['category_id'] ?? null,
            'is_published' => $request->has('is_published'),
            'published_at' => $request->has('is_published') ? now() : null,
            'eyecatch' => $eyecatchPath ?? $post->eyecatch,
        ]);

        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('posts.index')->with('success', '記事を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail(); // ← null対策に firstOrFail
        $post->delete();

        return redirect()->route('posts.index')->with('success', '記事を削除しました！');
    }
}
