<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tech Blog')</title>
</head>
<body>
    <header>
        <h1>テックブログ</h1>
        <nav>
            <a href="/">ホーム</a> 
            <a href="/posts">記事一覧</a>
        </nav>
        <hr>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <hr>
        <p>&copy; 2025 Tamon</p>
    </footer>
</body>
</html>