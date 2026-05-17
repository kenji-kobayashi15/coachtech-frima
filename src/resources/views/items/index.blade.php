@extends('layouts.app')

@section('content')
    {{-- タブ切り替え部分 --}}
    <div class="c-tabs">
        <div class="c-tabs__inner">
        <a href="{{ route('items.index') }}" class="c-tabs__link {{ !request()->get('tab') ? 'is-active' : '' }}">おすすめ</a>
        <a href="{{ route('items.index', ['tab' => 'mylist']) }}" class="c-tabs__link {{ request()->get('tab') == 'mylist' ? 'is-active' : '' }}">マイリスト</a>
        </div>
    </div>
<div class="home-container">
    {{-- メッセージ表示部分 --}}
    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    {{-- 商品一覧表示エリア --}}
    <div class="item-grid">
        @forelse ($items as $item)
        <article class="c-item-card">
            <a href="{{ route('items.show', $item->id) }}" class="c-item-link">
                <div class="c-item-card__thumbnail-wrapper">
                    @php
                    $imageSrc = str_starts_with($item->image_url, 'http')
                    ? $item->image_url
                    : asset('storage/' . $item->image_url);
                    @endphp
                    <img src="{{ $imageSrc }}" alt="{{ $item->name }}" class="c-item-card__thumbnail">

                    @if ($item->order)
                    <div class="c-item-card__sold-badge">
                        <span>SOLD</span>
                    </div>
                    @endif
                </div>
                <div class="c-item-card__body">
                    <p class="c-item-card__name">{{ $item->name }}</p>
                </div>
            </a>
        </article>
        @empty
        <p class="empty-message">表示する商品がありません。</p>
        @endforelse
    </div>
</div>
@endsection