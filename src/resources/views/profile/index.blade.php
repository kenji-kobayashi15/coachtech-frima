@extends('layouts.app')

@section('content')
<div class="mypage-container">
    {{-- ユーザー情報セクション --}}
    <div class="profile-header">
        <div class="user-icon-wrapper">
            @php
            $imagePath = ($user->profile && $user->profile->image_path)
            ? asset('storage/' . $user->profile->image_path)
            : asset('storage/default-icon.png');
            @endphp
            <img src="{{ $imagePath }}" class="user-icon-img" alt="ユーザーアイコン">
        </div>
        <h1 class="user-name">{{ $user->name }}</h1>
        <a href="{{ route('profile.edit') }}" class="btn-outline-primary edit-profile-btn">プロフィールを編集</a>
    </div>

    {{-- タブ切り替え --}}
    <div class="profile-tabs">
        <div class="tabs-inner">
            <a href="{{ route('mypage', ['page' => 'sell']) }}" class="tab-item {{ $page === 'sell' ? 'is-active' : '' }}">
                出品した商品
            </a>
            <a href="{{ route('mypage', ['page' => 'buy']) }}" class="tab-item {{ $page === 'buy' ? 'is-active' : '' }}">
                購入した商品
            </a>
        </div>
    </div>

    {{-- 商品一覧表示 --}}
    <div class="item-grid">
        @forelse ($items as $item)
        @if ($item)
        <article class="item-card">
            <a href="{{ route('items.show', $item->id) }}" class="item-link">
                <div class="item-thumbnail-wrapper">
                    @php
                    $imageSrc = str_starts_with($item->image_url, 'http')
                    ? $item->image_url
                    : asset('storage/' . $item->image_url);
                    @endphp
                    <img src="{{ $imageSrc }}" alt="{{ $item->name }}" class="item-thumbnail">

                    @if ($item->order)
                    <div class="sold-badge"><span>SOLD</span></div>
                    @endif
                </div>
                <div class="item-body">
                    <p class="item-name">{{ $item->name }}</p>
                </div>
            </a>
        </article>
        @endif
        @empty
        <p class="empty-message">該当する商品がありません</p>
        @endforelse
    </div>
</div>
@endsection