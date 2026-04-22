@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h1 class="page-title">会員登録</h1>

    {{-- novalidateを追加して、ブラウザ標準ではなくLaravelのバリデーションメッセージを優先させます --}}
    <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
        @csrf

        {{-- ユーザー名 --}}
        <div class="form-group">
            <label for="name" class="form-label">ユーザー名</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control">
            @error('name')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <label for="email" class="form-label">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control">
            @error('email')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード --}}
        <div class="form-group">
            <label for="password" class="form-label">パスワード</label>
            <input id="password" type="password" name="password" class="form-control">
            @error('password')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- 確認用パスワード --}}
        <div class="form-group">
            <label for="password_confirmation" class="form-label">確認用パスワード</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
            {{-- passwordの確認不一致エラーは通常'password'キーに紐付きますが、UIとしてここにも出すことが可能です --}}
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">登録する</button>
        </div>
    </form>

    <div class="auth-footer">
        <a href="{{ route('login') }}" class="auth-link">ログインはこちら</a>
    </div>
</div>
@endsection