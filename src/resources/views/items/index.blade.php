@extends('layouts.app')

@section('content')
<div class="home-container">
    {{-- タブ切り替え部分 --}}
    <div class="main-tabs">
        <a href="{{ route('items.index') }}" class="tab-link {{ !request()->get('tab') ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('items.index', ['tab' => 'mylist']) }}" class="tab-link {{ request()->get('tab') == 'mylist' ? 'active' : '' }}">マイリスト</a>
    </div>

    {{-- メッセージ表示部分 --}}
    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif

    {{-- 商品一覧表示エリア --}}
    <div class="item-grid">
        @forelse ($items as $item)
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
                    <div class="sold-badge">
                        <span>SOLD</span>
                    </div>
                    @endif
                </div>
                <div class="item-body">
                    <p class="item-name">{{ $item->name }}</p>
                </div>
            </a>
        </article>
        @empty
        <p class="empty-message">表示する商品がありません。</p>
        @endforelse
    </div>
</div>
@endsection