@extends('layouts.app')

@section('title', $post->title)

@section('content')
    {{-- 🔹 パンくずリスト --}}
    <nav class="text-sm text-gray-500 mb-4">
        <a href="{{ route('posts.index') }}" class="hover:underline">Home</a>
        @if ($post->category)
            <span class="mx-1">›</span>
            <a href="{{ route('categories.show', $post->category->slug) }}" class="hover:underline">
                {{ $post->category->name }}
            </a>
        @endif
        <span class="mx-1">›</span>
        <span>{{ $post->title }}</span>
    </nav>

    {{-- 🔹 記事本文 --}}
    <article>
        {{-- タイトル --}}
        <h1 class="text-3xl font-bold text-center mb-4">{{ $post->title }}</h1>

        {{-- 投稿日 --}}
        @if ($post->published_at)
            <p class="text-sm text-gray-500 text-center mb-6">
                投稿日：{{ $post->published_at->format('Y年n月j日') }}
            </p>
        @endif

        {{-- アイキャッチ画像 --}}
        @if ($post->eyecatch)
            <img src="{{ asset('storage/' . $post->eyecatch) }}" alt="アイキャッチ画像"
                class="w-full max-w-3xl mx-auto mb-8 rounded-xl shadow">
        @endif

        {{-- 本文 --}}
        <div class="prose max-w-none mb-10">
            {!! $post->body !!}
        </div>

        {{-- カテゴリ表示 --}}
        @if ($post->category)
            <div class="mb-4">
                <span class="text-sm text-gray-600">カテゴリ:</span>
                <a href="{{ route('categories.show', $post->category->slug) }}"
                    class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full hover:bg-blue-200 transition">
                    {{ $post->category->name }}
                </a>
            </div>
        @endif

        {{-- タグ表示 --}}
        @if ($post->tags->isNotEmpty())
            <div class="mb-6">
                <span class="text-sm text-gray-600">タグ:</span>
                @foreach ($post->tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}"
                        class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full mr-2 hover:bg-gray-200 transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- SNSシェアボタン --}}
        <div class="mt-10">
            <p class="text-sm text-gray-500 mb-2">この記事をシェアする</p>
            <div class="flex flex-wrap gap-3">
                <a href="#"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-600 transition">
                    Twitter
                </a>
                <a href="#"
                    class="inline-flex items-center px-4 py-2 bg-blue-700 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-800 transition">
                    Facebook
                </a>
                <a href="#" id="copy-button"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-gray-700 transition">
                    Copy Link
                </a>
                <span id="copy-message" class="ml-2 text-green-600 text-sm hidden">Copied!</span>
            </div>
        </div>
    </article>

    {{-- 著者情報 --}}
    <x-author-box />

    {{-- 関連記事 --}}
    @if ($relatedPosts->isNotEmpty())
        <section class="mt-16">
            <h2 class="text-xl font-bold mb-4">関連記事</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($relatedPosts as $relatedPost)
                    <x-post-card :post="$relatedPost" />
                @endforeach
            </div>
        </section>
    @endif
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyButton = document.getElementById('copy-button');
            const copyMessage = document.getElementById('copy-message');

            copyButton.addEventListener('click', function(e) {
                e.preventDefault();
                const url = window.location.href;

                navigator.clipboard.writeText(url)
                    .then(() => {
                        copyMessage.classList.remove('hidden');
                        setTimeout(() => {
                            copyMessage.classList.add('hidden');
                        }, 2000); // 2秒後にメッセージを非表示
                    })
                    .catch(err => {
                        alert('コピーに失敗しました: ' + err);
                    });
            });
        });
    </script>
@endpush
