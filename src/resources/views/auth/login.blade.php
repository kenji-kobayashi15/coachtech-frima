<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <h1>ログイン</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">ログイン情報を記憶する</label>
        </div>

        <div>
            <button type="submit">ログイン</button>
        </div>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                パスワードを忘れた場合
            </a>
        @endif
    </form>
    <p><a href="{{ route('register') }}">会員登録はこちら</a></p>
</body>
</html>
