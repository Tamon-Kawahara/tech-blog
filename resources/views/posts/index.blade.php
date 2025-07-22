@extends('layouts.app')

@section('title', '記事一覧')

@section('content')
    <h1>記事一覧</h1>

    @foreach ($posts as $post)
        @if ($post->is_published)
            <article>
                <h2>
                    <a href="{{ route('posts.show', $post->slug) }}">
                        {{ $post->title }}
                    </a>
                </h2>
                <p>投稿日: {{ optional($post->published_at)->format('Y/m/d') }}</p>
                @if ($post->eyecatch)
                    <img src="{{ asset('storage/' . $post->eyecatch) }}" alt="アイキャッチ画像" width="300">
                @endif
                <p>{{ Str::limit(strip_tags($post->body), 100, '...') }}</p>
            </article>
        @endif
    @endforeach
@endsection
