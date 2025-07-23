@extends('layouts.app')

@section('content')
    <h2>{{ $category->name }} の記事一覧</h2>

    @foreach ($posts as $post)
        <div>
            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
        </div>
    @endforeach

    {{ $posts->links() }}
@endsection
