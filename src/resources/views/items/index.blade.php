@extends('layouts.app')

@section('content')
<div class="container">
    {{-- タブ切り替え部分 --}}
    <div class="tabs">
        <a href="{{ route('items.index') }}" class="{{ !request()->get('tab') ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('items.index', ['tab' => 'mylist']) }}" class="{{ request()->get('tab') == 'mylist' ? 'active' : '' }}">マイリスト</a>
    </div>

    <hr>

    {{-- 商品一覧表示エリア --}}
    <div class="item-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-top: 20px;">
        @forelse ($items as $item)
        <div class="item-card">
            <a href="{{ route('items.show', $item->id) }}" style="text-decoration: none; color: inherit;">
                <div class="item-image" style="position: relative;">
                    {{-- 商品画像 --}}
                    <div class="item-image">
                        @if (str_starts_with($item->image_path, 'http'))
                        {{-- シーダーのURL（https://...）の場合、そのまま表示 --}}
                        <img src="{{ $item->image_path }}" alt="{{ $item->name }}" style="width: 100%; aspect-ratio: 1/1; object-fit: cover;">
                        @else
                        {{-- 自分でアップロードした画像（ファイル名のみ）の場合、storageパスを通す --}}
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 100%; aspect-ratio: 1/1; object-fit: cover;">
                        @endif
                    </div>

                    {{-- Soldラベルの表示（購入履歴がある場合） --}}
                    @if ($item->is_sold) {{-- 後ほどOrderモデルとの関連で判定 --}}
                    <div class="sold-label" style="position: absolute; top: 0; left: 0; background: red; color: white; padding: 5px 10px;">
                        SOLD
                    </div>
                    @endif
                </div>
                <div class="item-info" style="margin-top: 8px;">
                    <p style="margin: 0; font-weight: bold;">{{ $item->name }}</p>
                </div>
            </a>
        </div>
        @empty
        <p>表示する商品がありません。</p>
        @endforelse
    </div>
</div>

<style>
    /* 簡易的なタブのデザイン */
    .tabs a {
        margin-right: 20px;
        text-decoration: none;
        color: #666;
        font-weight: bold;
        padding-bottom: 5px;
    }

    .tabs a.active {
        color: #ff4d4d;
        /* コーチテックの赤系イメージ */
        border-bottom: 2px solid #ff4d4d;
    }
</style>
@endsection