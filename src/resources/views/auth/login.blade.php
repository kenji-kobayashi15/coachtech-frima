@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h1 class="page-title">ログイン</h1>

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
            @error('email')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">パスワード</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group-checkbox">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-checkbox">
            <label for="remember" class="checkbox-label">ログイン情報を記憶する</label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">ログインする</button>
        </div>
    </form>

    <div class="auth-footer">
        <a href="{{ route('register') }}" class="auth-link">会員登録はこちら</a>
    </div>
</div>
@endsection