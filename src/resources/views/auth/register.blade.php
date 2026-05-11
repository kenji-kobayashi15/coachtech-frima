@extends('layouts.app')

@section('page-class', 'register-page')

@section('content')
<div class="auth-container register-page">
    <div class="auth-content">
        <h1 class="page-title">会員登録</h1>

        <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
            @csrf

            {{-- ユーザー名 --}}
            <div class="form-group register-group--name">
                <label for="name" class="form-label">ユーザー名</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control register-input--name
            @error('name') is-invalid @enderror">
                @error('name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- メールアドレス --}}
            <div class="form-group register-group--email">
                <label for="email" class="form-label register-label--email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control register-input--email @error('email') is-invalid @enderror">
                @error('email')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group register-group--password">
                <label for="password" class="form-label register-label--password">パスワード</label>
                <input id="password" type="password" name="password" class="form-control register-input--password @error('password') is-invalid @enderror">
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- 確認用パスワード --}}
            <div class="form-group register-group--password-confirmation">
                <label for="password_confirmation" class="form-label register-label--password-confirmation">確認用パスワード</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control register-input--password-confirmation @error('password') is-invalid @enderror">
            </div>

            <div class=" form-actions">
                <button type="submit" class="register-btn-submit">登録する</button>
            </div>
        </form>

        <div class="auth-footer">
            <a href="{{ route('login') }}" class="register-link">ログインはこちら</a>
        </div>
    </div>
</div>
@endsection