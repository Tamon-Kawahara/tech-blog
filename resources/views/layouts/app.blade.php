<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Tech Blog') }}</title>

    <!-- Google Fonts: Figtree -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    {{-- ナビゲーション --}}
    @include('layouts.navigation')

    {{-- ヘッダー（必要ならページタイトルを表示） --}}
    @hasSection('header')
        <header class="bg-white shadow">
            <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>
    @endif

    {{-- メインコンテンツ --}}
    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- メインコンテンツ --}}
            <div class="w-full lg:w-2/3">
                @yield('content')
            </div>

            {{-- サイドバー（プロフィール表示など） --}}
            <aside class="w-full lg:w-1/3">
                @include('components.sidebar') {{-- まだなければ仮作成でOK --}}
            </aside>
        </div>
    </main>


    {{-- フッター（必要なら追加OK） --}}

    <footer class="bg-white border-t mt-10 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Tech Blog. All rights reserved.
    </footer>
    @stack('scripts')
</body>

</html>
