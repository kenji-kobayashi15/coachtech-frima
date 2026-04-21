<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
</head>

<body>
    <header>
        <div class="header-left">
            <a href="{{ route('items.index') }}">
                {{-- ロゴ画像があればここに配置 --}}
                <img src="{{ asset('img/coachtech-logo.png') }}" alt="COACHTECH" style="height: 40px;">
            </a>
        </div>

        <div class="header-center">
            <!-- loginとregisterの時は表示させない -->
            @if (!Route::is('login') && !Route::is('register'))
            <form action="{{ route('items.index') }}" method="GET">
                <input type="text" name="keyword" placeholder="なにをお探しですか？">
            </form>
            @endif
        </div>

        <nav class="header-right">
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
                <li><a href="{{ route('items.create') }}">出品</a></li>
                @endauth
                @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>