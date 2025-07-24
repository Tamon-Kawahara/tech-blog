@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('content')
    <h1>お問い合わせ</h1>

    {{-- 成功メッセージ --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('contact.store') }}">
        @csrf

        <div>
            <label for="name">お名前</label><br>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="email">メールアドレス（任意）</label><br>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div>
            <label for="message">お問い合わせ内容</label><br>
            <textarea name="message" id="message" rows="5" required>{{ old('message') }}</textarea>
        </div>

        <button type="submit">送信</button>
    </form>
@endsection
