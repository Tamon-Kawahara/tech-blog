@extends('layouts.app')

@section('title', '新規投稿')

@section('content')
    <h1>新規投稿</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
        </div>

        <div>
            <label for="body">本文</label>
            <textarea name="body" id="body" rows="10">{{ old('body') }}</textarea>
        </div>

        <div>
            <label for="category_id">カテゴリ</label>
            <select name="category_id">
                <option value="">-- 未選択 --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="eyecatch">アイキャッチ画像</label>
            <input type="file" name="eyecatch" id="eyecatch">
        </div>

        <div>
            <label>
                <input type="checkbox" name="is_published" {{ old('is_published') ? 'checked' : '' }}>
                公開する
            </label>
        </div>

        <button type="submit">投稿する</button>
    </form>
@endsection
