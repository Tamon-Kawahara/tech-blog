<form method="GET" action="{{ route('posts.index') }}" class="flex space-x-2">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="検索ワードを入力"
        class="flex-1 px-3 py-2 border rounded"
    >
    <button type="submit"
        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
        検索
    </button>
</form>

@if (request('search'))
    <p class="text-sm text-gray-600 mt-2">検索結果：「{{ request('search') }}」</p>
@endif
