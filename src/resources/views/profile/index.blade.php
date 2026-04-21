@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px; margin: 0 auto; padding: 20px;">
    {{-- ユーザー情報セクション --}}
    <div class="profile-header" style="display: flex; align-items: center; gap: 20px; margin-bottom: 40px;">
        <div class="user-icon" style="width: 80px; height: 80px; border-radius: 50%; background: #ccc; overflow: hidden;">
            {{-- 本来はユーザーのプロフィール画像を表示 --}}
            <img src="{{ asset('storage/' . ($user->profile->image_path ?? 'default-icon.png')) }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <h1 style="font-size: 24px;">{{ Auth::user()->name }}</h1>
        <a href="{{ route('profile.edit') }}" style="margin-left: auto; padding: 5px 15px; border: 1px solid #ff4d4d; color: #ff4d4d; text-decoration: none; border-radius: 5px;">プロフィールを編集</a>
    </div>

    {{-- タブ切り替え --}}
    <div class="tabs" style="margin-bottom: 20px;">
        <a href="?tab=sell" style="margin-right: 20px; text-decoration: none; color: {{ request('tab') != 'buy' ? '#ff4d4d' : '#666' }}; font-weight: bold; border-bottom: {{ request('tab') != 'buy' ? '2px solid #ff4d4d' : 'none' }};">出品した商品</a>
        <a href="?tab=buy" style="text-decoration: none; color: {{ request('tab') == 'buy' ? '#ff4d4d' : '#666' }}; font-weight: bold; border-bottom: {{ request('tab') == 'buy' ? '2px solid #ff4d4d' : 'none' }};">購入した商品</a>
    </div>

    {{-- 商品一覧表示 --}}
    <div class="item-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 20px;">
        {{-- ここにコントローラーから渡された商品を表示（ループ処理は後ほど実装） --}}
        <p style="color: #999;">該当する商品がありません</p>
    </div>
</div>
@endsection