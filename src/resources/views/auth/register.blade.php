@extends('layouts.app')
@section('content')
    <h1>会員登録</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus>
            @error('name')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" autocomplete="new-password">
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">パスワード（確認用）</label>
            <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password">
        </div>

        <div>
            <button type="submit">登録</button>
        </div>
    </form>
    <p><a href="{{ route('login') }}">ログインはこちら</a></p>
@endsection