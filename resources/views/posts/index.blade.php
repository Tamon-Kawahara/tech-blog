@extends('layouts.app')

@section('title', '記事一覧')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">最新の投稿一覧</h1>
@endsection

@section('content')
    <h1>記事一覧</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- 検索フォーム --}}
    <form method="GET" action="{{ route('posts.index') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="検索ワードを入力">
        <button type="submit">検索</button>
    </form>

    @if (request('search'))
        <p>検索結果：「{{ request('search') }}」</p>
    @endif

    @if ($posts->isEmpty())
        @if (request('search'))
            <p>「{{ request('search') }}」に一致する投稿は見つかりませんでした。</p>
        @else
            <p>現在、公開されている投稿はありません。</p>
        @endif
    @else
        {{-- 投稿一覧のループ --}}
        @foreach ($posts as $post)
            {{-- 各投稿の表示 --}}
        @endforeach
    @endif


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

                {{-- カテゴリ表示 --}}
                @if ($post->category)
                    <p>カテゴリ:
                        <a href="{{ route('categories.show', $post->category->slug) }}">
                            {{ $post->category->name }}
                        </a>
                    </p>
                @endif

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

                    <!-- 編集ボタンの横などに -->
                    <form action="{{ route('posts.destroy', $post->slug) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>

                @endauth

            </article>
        @endif
    @endforeach
@endsection
