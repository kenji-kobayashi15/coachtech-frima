@extends('layouts.app')

@section('content')
<div class="purchase-container">
    <div class="purchase-wrapper">
        {{-- 左側：商品情報と設定 --}}
        <div class="purchase-main">
            {{-- 商品確認 --}}
            <div class="item-summary">
                <div class="item-image-wrapper">
                    @php
                    $imageSrc = (isset($item->image_url) && strpos($item->image_url, 'http') === 0)
                    ? $item->image_url
                    : asset('storage/' . ($item->image_url ?? ''));
                    @endphp

                    @if($item->image_url)
                    <img src="{{ $imageSrc }}" class="item-image" alt="{{ $item->name }}">
                    @else
                    <div class="no-image">No Image</div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const methodSelect = document.querySelector('select[name="payment_method"]');
        const displayTarget = document.querySelector('.method-row td');

        methodSelect.addEventListener('change', function() {
            // 選択されたテキスト（「コンビニ払い」など）を取得
            const selectedText = methodSelect.options[methodSelect.selectedIndex].text;

            if (methodSelect.value === "") {
                displayTarget.textContent = '選択してください';
            } else {
                displayTarget.textContent = selectedText;
            }
        });
    });
</script>
@endsection