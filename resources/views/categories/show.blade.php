@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-6">カテゴリ：{{ $category->name }}</h1>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($category->posts as $post)
      @if ($post->is_published)
        <x-post-card :post="$post" />
      @endif
    @endforeach
  </div>
@endsection

