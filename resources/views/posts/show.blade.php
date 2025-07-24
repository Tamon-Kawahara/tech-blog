@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ route('posts.index') }}" class="hover:underline">Home</a>
        @if ($post->category)
            <span class="mx-1">›</span>
            <a href="{{ route('categories.show', $post->category->slug) }}" class="hover:underline">
                {{ $post->category->name }}
            </a>
        @endif
        <span class="mx-1">›</span>
        <span>{{ $post->title }}</span>
    </nav>
    <article>
        <h1>{{ $post->title }}</h1>
        @if ($post->published_at)
            <p class="text-sm text-gray-500 mb-4">
                投稿日：{{ $post->published_at->format('Y年n月j日') }}
            </p>
        @endif

        @if ($post->eyecatch)
            <img src="{{ asset('storage/' . $post->eyecatch) }}" alt="アイキャッチ画像" width="500">
        @endif

        <div class="prose max-w-none">
            {!! $post->body !!}
        </div>

        {{-- 🔽カテゴリの表示 --}}
        @if ($post->category)
            <div style="margin-top: 1em;">
                <strong>カテゴリ:</strong>
                <a href="{{ route('categories.show', $post->category->slug) }}">
                    {{ $post->category->name }}
                </a>
            </div>
        @endif


        {{-- 🔽タグの表示 --}}
        @if ($post->tags->isNotEmpty())
            <div style="margin-top: 1em;">
                <strong>タグ:</strong>
                @foreach ($post->tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}" style="margin-right: 5px;">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </article>
@endsection
