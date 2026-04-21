@extends('layouts.app')

@section('content')
<div class="item-detail-container" style="max-width: 1000px; margin: 0 auto; padding: 20px;">

    <div class="item-main-content" style="display: flex; gap: 40px; margin-bottom: 40px;">
        {{-- 商品画像エリア --}}
        <div class="item-image-section" style="flex: 1;">
            @if (str_starts_with($item->image_path, 'http'))
            <img src="{{ $item->image_path }}" alt="{{ $item->name }}" style="width: 100%; height: auto; object-fit: contain;">
            @else
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 100%; height: auto; object-fit: contain;">
            @endif
        </div>

        {{-- 商品情報エリア --}}
        <div class="item-info-section" style="flex: 1;">
            <h1 style="font-size: 24px; margin-bottom: 10px;">{{ $item->name }}</h1>
            <p style="color: #666;">{{ $item->brand }}</p>
            <p style="font-size: 20px; font-weight: bold; margin: 20px 0;">¥{{ number_format($item->price) }}（税込）</p>

            {{-- いいねボタン --}}
            <div class="like-section" style="margin-bottom: 20px;">
                <p>いいね数: {{ $item->likes->count() }}</p>
                @auth
                <form action="{{ route('items.like', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="padding: 5px 15px; cursor: pointer;">
                        {{ $item->likes->contains('user_id', Auth::id()) ? '★ いいね解除' : '☆ いいね' }}
                    </button>
                </form>
                @endauth
            </div>

            {{-- 購入ボタン --}}
            <a href="{{ route('purchase.create', $item->id) }}" style="display: inline-block; background: #ff4d4d; color: #fff; padding: 10px 30px; text-decoration: none; border-radius: 5px;">購入手続きへ</a>

            <div style="margin-top: 30px;">
                <h3>商品の説明</h3>
                <p style="line-height: 1.6;">{{ $item->description }}</p>
            </div>

            <div style="margin-top: 30px;">
                <h3>商品の情報</h3>
                <p><strong>カテゴリー:</strong>
                    @foreach ($item->categories as $category)
                    {{ $category->name }}@if (!$loop->last), @endif
                    @endforeach
                </p>
                <p><strong>商品の状態:</strong> {{ $item->condition->name }}</p>
            </div>
        </div>
    </div>

    <hr>

    {{-- コメントエリア --}}
    <div class="comment-section" style="margin-top: 40px;">
        <h2>コメント ({{ $item->comments->count() }})</h2>

        @foreach ($item->comments as $comment)
        <div class="comment-item" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            <p style="font-weight: bold; margin-bottom: 5px;">{{ $comment->user->name }}</p>
            <p style="margin: 0;">{{ $comment->content }}</p>
        </div>
        @endforeach

        @auth
        <form action="{{ route('items.comment', $item->id) }}" method="POST" style="margin-top: 20px;">
            @csrf
            <p>商品へのコメント</p>
            <textarea name="content" required style="width: 100%; height: 100px; padding: 10px;"></textarea>
            <button type="submit" style="margin-top: 10px; padding: 10px 20px; background: #333; color: #fff; border: none; cursor: pointer;">コメントを送信する</button>
        </form>
        @endauth
    </div>
</div>
@endsection