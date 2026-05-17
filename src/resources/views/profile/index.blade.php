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
    <div class="c-tabs c-tabs--mypage">
        <div class="c-tabs__inner">
            <a href="{{ route('mypage', ['page' => 'sell']) }}" class="c-tabs__link {{ $page === 'sell' ? 'is-active' : '' }}">
                出品した商品
            </a>
            <a href="{{ route('mypage', ['page' => 'buy']) }}" class="c-tabs__link {{ $page === 'buy' ? 'is-active' : '' }}">
                購入した商品
            </a>
        </div>
    </div>

    {{-- 商品一覧表示 --}}
    <div class="item-grid">
        @forelse ($items as $item)
        @if ($item)
        <article class="c-item-card">
            <a href="{{ route('items.show', $item->id) }}" class="c-item-card__link">
                <div class="c-item-card__thumbnail-wrapper">
                    @php
                    $imageSrc = str_starts_with($item->image_url, 'http')
                    ? $item->image_url
                    : asset('storage/' . $item->image_url);
                    @endphp
                    <img src="{{ $imageSrc }}" alt="{{ $item->name }}" class="c-item-card__thumbnail">

                    @if ($item->order)
                    <div class="c-item-card__sold-badge"><span>SOLD</span></div>
                    @endif
                </div>
                <div class="c-item-card__body">
                    <p class="c-item-card__name">{{ $item->name }}</p>
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