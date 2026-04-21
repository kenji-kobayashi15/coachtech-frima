@extends('layouts.app')

@section('content')
<p>登録していただいたメールアドレスに認証メールを送付しました。</p>
<p>メール認証を完了してください。</p>

{{-- 1. 中央の大きなボタン --}}
<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">
        認証はこちらから
    </button>
</form>

{{-- 2. 下のテキストリンク --}}
<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">
        認証メールを再送する
    </button>
</form>

{{-- 送信完了メッセージ --}}
@if (session('status') == 'verification-link-sent')
<p>新しい認証メールを送信しました。</p>
@endif
@endsection