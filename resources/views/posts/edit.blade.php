@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
    <h1>投稿編集</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
        </div>

        <div>
            <label for="body">本文</label>
            <textarea name="body" id="body" rows="10">{{ old('body', $post->body) }}</textarea>
        </div>

        <div>
            <label for="category_id">カテゴリ</label>
            <select name="category_id" id="category_id">
                <option value="">-- 未選択 --</option>
                {{-- 後でカテゴリ選択肢を渡す前提 --}}
            </select>
        </div>

        <div>
            <label for="eyecatch">アイキャッチ画像</label>
            <input type="file" name="eyecatch" id="eyecatch">
            @if ($post->eyecatch)
                <div>
                    <p>現在の画像：</p>
                    <img src="{{ asset('storage/' . $post->eyecatch) }}" alt="アイキャッチ" width="300">
                </div>
            @endif
        </div>

        <div>
            <label>
                <input type="checkbox" name="is_published" {{ $post->is_published ? 'checked' : '' }}>
                公開する
            </label>
        </div>

        <button type="submit">更新する</button>
    </form>
@endsection
