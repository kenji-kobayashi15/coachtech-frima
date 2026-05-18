@extends('layouts.app')

@section('page-class', 'login-page')

@section('content')
<div class="auth-container login-page">
    <div class="auth-content login-content">
        <h1 class="page-title">ログイン</h1>

        <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
            @csrf

            <div class="form-group">
                <label for="email" class="form-label login-label--email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus class="c-form-control login-input--email @error('email') is-invalid @enderror">
                @error('email')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label login-label--password">パスワード</label>
                <input id="password" type="password" name="password" autocomplete="current-password" class="c-form-control login-input--password @error('email') is-invalid @enderror">
                @error('password')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions login-form-actions">
                <button type="submit" class="c-btn-submit c-btn-submit--auth">ログインする</button>
            </div>
        </form>

        <div class="auth-footer">
            <a href="{{ route('register') }}" class="c-auth-link">会員登録はこちら</a>
        </div>
    </div>
</div>
@endsection