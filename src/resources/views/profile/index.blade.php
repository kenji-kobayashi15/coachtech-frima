@extends('layouts.app')

@section('content')
<div class="mypage-container">
    {{-- ユーザー情報セクション --}}
    <div class="profile-header">
        <div class="user-icon-wrapper">
            @php
            $imagePath = (Auth::user()->profile && Auth::user()->profile->image_path)
            ? asset('storage/' . Auth::user()->profile->image_path)
            : asset('storage/default-icon.png');
            @endphp
            <img src="{{ $imagePath }}" class="user-icon-img">
        </div>
        <h1 class="user-name">{{ Auth::user()->name }}</h1>
        <a href="{{ route('profile.edit') }}" class="btn-outline-primary edit-profile-btn">プロフィールを編集</a>
    </div>

    {{-- タブ切り替え --}}
    <div class="profile-tabs">
        <a href="?tab=sell" class="tab-item {{ request('tab') != 'buy' ? 'active' : '' }}">
            出品した商品
        </a>
        <a href="?tab=buy" class="tab-item {{ request('tab') == 'buy' ? 'active' : '' }}">
            購入した商品
        </a>
    </div>

    {{-- 商品一覧表示 --}}
    <div class="item-grid">
        {{-- ループ処理が入る想定 --}}
        <p class="empty-message">該当する商品がありません</p>
    </div>
</div>
@endsection