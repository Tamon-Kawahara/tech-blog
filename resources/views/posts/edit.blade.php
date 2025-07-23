@extends('layouts.app')

@section('title', '投稿を編集')

@section('content')
    <h1>投稿を編集</h1>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 編集フォーム --}}
    <form action="{{ route('posts.update', $post->slug) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>タイトル</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        </div>

        <div>
            <label>本文</label>
            <textarea name="body" rows="5" required>{{ old('body', $post->body) }}</textarea>
        </div>

        <div>
            <label>カテゴリ</label>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>
                <input type="checkbox" name="is_published" value="1"
                    {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                公開する
            </label>
        </div>

        <button type="submit">更新する</button>
    </form>
@endsection
