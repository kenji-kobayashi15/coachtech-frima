@extends('layouts.app')

@section('content')
<div class="item-detail-container">

    <div class="item-detail-layout">
        {{-- 商品画像エリア --}}
        <div class="item-image-wrapper">
            @php
            $imageSrc = str_starts_with($item->image_url, 'http')
            ? $item->image_url
            : asset('storage/' . $item->image_url);
            @endphp
            <img src="{{ $imageSrc }}" alt="{{ $item->name }}" class="item-detail-img">
        </div>

        {{-- 商品情報エリア --}}
        <div class="item-info-wrapper">
            <h1 class="item-title">{{ $item->name }}</h1>
            <p class="item-brand">{{ $item->brand }}</p>
            <p class="item-price-large">¥{{ number_format($item->price) }}（税込）</p>

            {{-- アクションエリア（いいね・購入） --}}
            <div class="item-actions">
                <div class="like-section">
                    <p class="like-count">いいね数: {{ $item->likes->count() }}</p>
                    @auth
                    <form action="{{ route('items.like', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-like {{ $item->likes->contains('user_id', Auth::id()) ? 'is-liked' : '' }}">
                            {{ $item->likes->contains('user_id', Auth::id()) ? '★ いいね解除' : '☆ いいね' }}
                        </button>
                    </form>
                    @endauth
                </div>

                {{-- 購入ボタンエリア --}}
                <div class="action-button">
                    @auth
                    @if(Auth::id() === $item->user_id)
                    {{-- 1. ログインユーザーが出品者本人の場合 --}}
                    <button disabled>自分が出品した商品です</button>
                    @elseif($item->order)
                    {{-- 2. 自分以外で、すでに売り切れている場合 --}}
                    <button class="btn-sold-out" disabled>SOLD OUT</button>
                    @else
                    {{-- 3. 自分以外で、購入可能な場合 --}}
                    <a href="{{ route('purchase.create', $item->id) }}" class="btn-purchase">購入手続きへ</a>
                    @endif
                    @else
                    {{-- 4. 未ログインの場合 --}}
                    @if($item->order)
                    <button class="btn-sold-out" disabled>SOLD OUT</button>
                    @else
                    <a href="{{ route('login') }}" class="btn-purchase">ログインして購入</a>
                    @endif
                    @endauth
                </div>
            </div>

            <div class="detail-section">
                <h3 class="section-label">商品の説明</h3>
                <p class="description-text">{{ $item->description }}</p>
            </div>

            <div class="detail-section">
                <h3 class="section-label">商品の情報</h3>
                <div class="info-list">
                    <p><strong>カテゴリー:</strong>
                        @foreach ($item->categories as $category)
                        <span class="category-tag">{{ $category->name }}</span>@if (!$loop->last), @endif
                        @endforeach
                    </p>
                    <p><strong>商品の状態:</strong> <span class="condition-text">{{ $item->condition->name }}</span></p>
                </div>
            </div>
        </div>
    </div>

    {{-- コメントエリア --}}
    <section class="comment-section">
        <h2 class="comment-title">コメント ({{ $item->comments->count() }})</h2>

        <div class="comment-list">
            @foreach ($item->comments as $comment)
            <div class="comment-item">
                <p class="comment-user">{{ $comment->user->name }}</p>
                <p class="comment-content">{{ $comment->comment }}</p>
            </div>
            @endforeach
        </div>

        @auth
        <form action="{{ route('items.comment', $item->id) }}" method="POST" class="comment-form">
            @csrf
            <label class="form-label">商品へのコメント</label>
            <textarea name="comment" required class="form-textarea-small">{{ old('comment') }}</textarea>
            <button type="submit" class="btn-dark">コメントを送信する</button>
        </form>
        @endauth
    </section>
</div>
@endsection