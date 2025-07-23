@extends('layouts.app')

@section('content')
    <h1>タグ: {{ $tag->name }}</h1>

    @foreach ($posts as $post)
        <div>
            <h2><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h2>
            <p>{{ Str::limit($post->body, 100) }}</p>
        </div>
    @endforeach

    {{ $posts->links() }}
@endsection
