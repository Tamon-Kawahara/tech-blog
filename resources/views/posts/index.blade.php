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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            @if ($post->is_published)
                <x-post-card :post="$post" />
            @endif
        @endforeach
    </div>

@endsection
