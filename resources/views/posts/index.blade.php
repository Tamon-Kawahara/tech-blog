@extends('layouts.app')

@section('title', '記事一覧')

@section('content')
    <h1>記事一覧</h1>

    {{-- 投稿一覧をループ --}}
    @foreach ($posts as $post)
        {{-- 公開済みの記事だけ表示 --}}
        @if ($post->is_published)
            <article>
                <h2>
                    {{-- 投稿詳細ページへのリンク（スラッグ使用） --}}
                    <a href="{{ route('posts.show', $post->slug) }}">
                        {{ $post->title }}
                    </a>
                </h2>

                {{-- 投稿日表示（null安全に format） --}}
                <p>投稿日: {{ optional($post->published_at)->format('Y/m/d') }}</p>

                {{-- アイキャッチ画像がある場合のみ表示 --}}
                @if ($post->eyecatch)
                    <img src="{{ asset('storage/' . $post->eyecatch) }}" alt="アイキャッチ画像" width="300">
                @endif

                {{-- 本文の冒頭だけを抜粋して表示 --}}
                <p>{{ Str::limit(strip_tags($post->body), 100, '...') }}</p>

                {{-- 🔒 ログイン中のユーザーだけ編集リンクを表示 --}}
                @auth
                    <p>
                        <a href="{{ route('posts.edit', $post->slug) }}">[ 編集する ]</a>
                    </p>
                @endauth

            </article>
        @endif
    @endforeach
@endsection
