@extends('layouts.app')

@section('content')
<div class="purchase-container">
    <div class="purchase-wrapper">
        {{-- 左側：商品情報と設定 --}}
        <div class="purchase-main">
            {{-- 商品確認 --}}
            <div class="item-summary">
                <div class="item-image-wrapper">
                    @if (str_starts_with($item->image_path, 'http'))
                    <img src="{{ $item->image_path }}" class="item-image">
                    @else
                    <img src="{{ asset('storage/' . $item->image_path) }}" class="item-image">
                    @endif
                </div>
                <div class="item-info">
                    <h2 class="item-name">{{ $item->name }}</h2>
                    <p class="item-price">¥{{ number_format($item->price) }}</p>
                </div>
            </div>

            {{-- 支払い方法 --}}
            <div class="setting-section">
                <h3 class="section-title">支払い方法</h3>
                <select name="payment_method" form="purchase-form" class="form-select">
                    <option value="">選択してください</option>
                    <option value="konbini">コンビニ払い</option>
                    <option value="card">カード支払い</option>
                </select>
            </div>

            {{-- 配送先 --}}
            <div class="setting-section">
                <div class="section-header">
                    <h3 class="section-title">配送先</h3>
                    <a href="{{ route('purchase.address', $item->id) }}" class="link-edit">変更する</a>
                </div>
                <div class="address-display">
                    <p>〒 {{ $user->profile->post_code ?? '未設定' }}</p>
                    <p>{{ $user->profile->address ?? '未設定' }} {{ $user->profile->building ?? '' }}</p>
                </div>
            </div>
        </div>

        {{-- 右側：決済確認エリア --}}
        <div class="purchase-sidebar">
            <table class="summary-table">
                <tr>
                    <th>商品代金</th>
                    <td>¥{{ number_format($item->price) }}</td>
                </tr>
                <tr class="total-row">
                    <th>支払い金額</th>
                    <td>¥{{ number_format($item->price) }}</td>
                </tr>
                <tr class="method-row">
                    <th>支払い方法</th>
                    <td>選択してください</td>
                </tr>
            </table>

            <form id="purchase-form" action="{{ route('purchase.store', $item->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-submit">
                    購入する
                </button>
            </form>
        </div>
    </div>
</div>
@endsection