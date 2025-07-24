@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">#{{ $category->name }} カテゴリの記事</h1>
        <p class="text-gray-600 mb-6">全{{ $posts->count() }}件</p>
        <div class="grid gap-6 md:grid-cols-2">
            @foreach ($category->posts as $post)
                @if ($post->is_published)
                    <x-post-card :post="$post" />
                @endif
            @endforeach
        </div>
    </div>
@endsection
