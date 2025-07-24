@props(['post'])

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <img src="{{ asset('storage/' . ($post->eyecatch ?? 'placeholder.jpg')) }}" alt="アイキャッチ画像"
        class="w-full h-48 object-cover" />
    <div class="p-4">
        <h2 class="text-lg font-bold mb-2">
            <a href="{{ route('posts.show', $post->slug) }}" class="hover:underline">
                {{ $post->title }}
            </a>
        </h2>
        <p class="text-sm text-gray-600 mb-2">
            カテゴリ: {{ $post->category->name ?? '未分類' }}
        </p>
        <p class="text-gray-700 text-sm line-clamp-3">
            {{ Str::limit(strip_tags($post->body), 100) }}
        </p>
    </div>
</div>
