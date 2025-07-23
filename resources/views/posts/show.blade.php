@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        <p>投稿日: {{ optional($post->published_at)->format('Y/m/d') }}</p>

        @if ($post->eyecatch)
            <img src="{{ asset('storage/' . $post->eyecatch) }}" alt="アイキャッチ画像" width="500">
        @endif

        <div>
            {!! nl2br(e($post->body)) !!}
        </div>

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
