@extends('layouts.app')

@section('content')
  <div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">タグ一覧</h1>

    <ul class="flex flex-wrap gap-3">
      @foreach ($tags as $tag)
        <li>
          <a href="{{ route('tags.show', $tag->slug) }}"
             class="inline-block px-4 py-2 bg-blue-100 text-blue-800 text-sm font-medium rounded-full hover:bg-blue-200 transition">
            #{{ $tag->name }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
@endsection
