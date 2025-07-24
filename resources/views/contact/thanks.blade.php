@extends('layouts.app')

@section('title', '送信完了')

@section('content')
    <h1>お問い合わせありがとうございます！</h1>
    <p>お問い合わせ内容を受け付けました。</p>

    <a href="{{ route('posts.index') }}">
        <button>ホームに戻る</button>
    </a>
@endsection
