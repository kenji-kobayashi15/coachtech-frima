<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <!-- 1. 基本設定 -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <!-- 2. 共通パーツ -->
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <!-- 3. バリデーション（エラー時用） -->
    <link rel="stylesheet" href="{{ asset('css/validation.css') }}">
    <!-- 4. 各画面固有 -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header class="auth-header">
        <div class="header-inner">
            <div class="header-logo">
                <a href="{{ route('items.index') }}">
                    <img src="{{ asset('img/coachtech-logo.png') }}" alt="COACHTECH">
                </a>
            </div>


            <div class="header-search">
                <!-- loginとregisterの時は表示させない -->
                @if (!Route::is('login') && !Route::is('register'))
                <form action="{{ route('items.index') }}" method="GET">
                    <input type="text" name="keyword" placeholder="なにをお探しですか？">
                </form>
                @endif
            </div>
            <nav class="header-nav">
                <ul>
                    @if (!Route::is('login') && !Route::is('register'))
                    @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">ログアウト</button>
                        </form>
                    </li>
                    <li><a href="{{ route('mypage') }}">マイページ</a></li>
                    <li><a href="{{ route('items.create') }}">出品</a></li>
                    @else
                    <li><a href="{{ route('login') }}">ログイン</a></li>
                    <li><a href="{{ route('register') }}">マイページ</a></li>
                    <li><a href="{{ route('items.create') }}" class="btn-sell">出品</a></li>
                    @endauth
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>