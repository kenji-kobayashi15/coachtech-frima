@extends('layouts.app')

@section('content')
<div class="item-detail-container">

    <div class="item-detail__main">
        {{-- 商品画像エリア --}}
        <div class="item-detail__left-col">
            @php
            $imageSrc = str_starts_with($item->image_url, 'http')
            ? $item->image_url
            : asset('storage/' . $item->image_url);
            @endphp
            <img src="{{ $imageSrc }}" alt="{{ $item->name }}" class="item-detail-img">
        </div>
        <div class="item-detail__right-col">
            {{-- 商品情報エリア --}}
            <div class="item-detail__title-box">
                <h1 class="item-detail__title">{{ $item->name }}</h1>
                <p class="item-detail__brand">{{ $item->brand }}</p>
                <p class="item-detail__price-large">
                    ¥<span class="price-number"> {{number_format($item->price) }}</span>（税込）
                </p>
                {{-- アクションエリア（いいね・購入） --}}
                <div class="item-detail__actions">
                    <div class="item-detail__status-group">
                        {{-- いいねエリア --}}
                        <div class="item-detail__like-item">
                            @auth
                            {{-- ログイン中：クリックで送信できるボタン形式 --}}
                            <form action="{{ route('items.like', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="item-detail__icon-btn">
                                    @if($item->likes->contains('user_id', Auth::id()))
                                    <img src=" {{ asset('img/icon-heart_logo_pink.png') }}" alt="いいね済み">
                                    @else
                                    <img src="{{ asset('img/icon-heart_logo.png') }}" alt="いいね">
                                    @endif
                                </button>
                            </form>
                            @else
                            {{-- 未ログイン：画像のみ表示 --}}
                            <img src="{{ asset('img/icon-heart_logo.png') }}" alt="いいね">
                            @endauth
                            <span class="item-like__count">{{ $item->likes->count() }}</span>
                        </div>
                        {{-- コメント件数エリア --}}
                        <div class="item-detail__comment-item">
                            <img src="{{ asset('img/icon-comment_logo.png') }}" alt="コメント数">
                            <span class="item-comments__count">{{ $item->comments->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- 購入ボタンエリア --}}
            <div class="item-detail__buy-wrapper">
                @auth
                @if(Auth::id() === $item->user_id)
                {{-- 1. ログインユーザーが出品者本人の場合 --}}
                <button class="c-btn-submit c-btn-submit--detail" disabled>自分が出品した商品です</button>
                @elseif($item->order)
                {{-- 2. 自分以外で、すでに売り切れている場合 --}}
                <button class="c-btn-submit c-btn-submit--detail" disabled>SOLD OUT</button>
                @else
                {{-- 3. 自分以外で、購入可能な場合 --}}
                <a href="{{ route('purchase.create', $item->id) }}" class="c-btn-submit c-btn-submit--detail">購入手続きへ</a> @endif
                @else
                {{-- 4. 未ログインの場合 --}}
                @if($item->order)
                <button class="c-btn-submit c-btn-submit--detail" disabled>SOLD OUT</button> @else
                <a href="{{ route('login') }}" class="c-btn-submit c-btn-submit--detail">ログインして購入</a> @endif
                @endauth
            </div>
            {{-- 商品の説明 --}}
            <div class="item-detail__section">
                <h3 class="item-detail__section-title">商品の説明</h3>
                <p class="item-detail__description-text">{{ $item->description }}</p>
            </div>
            {{-- 商品詳細情報 --}}
            <div class="item-detail__info-section">
                <h3 class="item-detail__info-title">商品の情報</h3>
                <div class="item-detail__info-list">
                    <div class="item-detail__meta-group">
                        <span class="item-detail__meta-label">カテゴリー</span>
                        <div class="item-detail__tag-container">
                            @foreach ($item->categories as $category)
                            <span class="item-detail__category-tag">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="item-detail__condition-group">
                        <span class="item-detail__condition-label">商品の状態</span>
                        <span class="item-detail__condition">{{ $item->condition->name }}</span>
                    </div>
                </div>
                {{-- コメントエリア --}}
                <section class="item-comment">
                    <h2 class="item-comment__title">コメント ({{ $item->comments->count() }})</h2>
                    <div class="item-comment__list">
                        @foreach ($item->comments as $comment)
                        <div class="item-comment__item">
                            <div class="item-comment__user-info">
                                <div class="item-comment__user-image">
                                    @if($comment->user->profile && $comment->user->profile->image_path)
                                    <img src="{{ asset('storage/' . $comment->user->profile->image_path) }}" alt="ユーザー画像">
                                    @else
                                    <div class="item-comment__default-avatar"></div>
                                    @endif
                                </div>
                                <p class="item-comment__user">{{ $comment->user->name }}</p>
                            </div>
                            <div class="item-comment__bubble">
                                <p class="item-comment__text">{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @auth
                    <form action="{{ route('items.comment', $item->id) }}" method="POST" class="item-comment__form">
                        @csrf
                        <label class="item-comment__label">商品へのコメント</label>
                        <textarea name="comment" class="c-form-control item-comment__textarea @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                        @error('comment')
                        <p class="item-comment__error">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="c-btn-submit c-btn-submit--detail c-btn-submit--comment">コメントを送信する</button>
                    </form>
                    @endauth
                </section>
            </div>
        </div>
    </div>
    @endsection