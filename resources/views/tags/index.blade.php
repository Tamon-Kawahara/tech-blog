@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-6">タグ一覧</h1>

  <ul class="flex flex-wrap gap-3">
    @foreach ($tags as $tag)
      <li>
        <a href="{{ route('tags.show', $tag->slug) }}"
           class="inline-block px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 text-sm text-gray-700">
          #{{ $tag->name }}
        </a>
      </li>
    @endforeach
  </ul>
@endsection
