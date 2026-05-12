@extends('layouts.app')

@section('content')
<div class="verify-email-container">
    <div class="verify-massage-group">
        <p>登録していただいたメールアドレスに認証メールを送付しました。</p>
        <p>メール認証を完了してください。</p>
    </div>

    {{-- 1. 中央の大きなボタン --}}
    <form method="POST" action="{{ route('verification.send') }}" class="verify-form-main">
        @csrf
        <button type="submit" class="verify-btn-main>
            認証はこちらから
        </button>
    </form>

    {{-- 2. 下のテキストリンク --}}
    <form method=" POST" action="{{ route('verification.send') }}" class="verify-form-resend">
            @csrf
            <button type="submit" class="verify-link-resend">
                認証メールを再送する
            </button>
    </form>

    {{-- 送信完了メッセージ --}}
    @if (session('status') == 'verification-link-sent')
    <p class="verify-status-alert">新しい認証メールを送信しました。</p>
    @endif
</div>
@endsection