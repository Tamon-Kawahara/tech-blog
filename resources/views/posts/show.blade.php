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
    </article>
@endsection
