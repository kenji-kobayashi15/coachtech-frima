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
                    <img src="{{ $imageSrc }}" class="c-img-cover" alt="{{ $item->name }}">
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
                {{-- form="purchase-form" 属性により、離れた場所のformと紐づいています --}}
                <select name="payment_method" form="purchase-form" class="form-select c-form-control--select">
                    <option value="">選択してください</option>
                    <option value="konbini">コンビニ払い</option>
                    <option value="card">カード支払い</option>
                </select>
            </div>

            {{-- 配送先 --}}
            <div class="setting-section">
                <div class="section-header">
                    <h3 class="section-title">配送先</h3>
                    <a href="{{ route('purchase.address', $item->id) }}" class="c-link-text">変更する</a>
                </div>
                <div class="address-display">
                    <p>〒 {{ $user->profile->post_code ?? '未設定' }}</p>
                    <p>{{ $user->profile->address ?? '未設定' }} {{ $user->profile->building ?? '' }}</p>
                </div>
            </div>
        </div>

        {{-- 右側：決済確認エリア --}}
        <div class="purchase-sidebar">
            <div class="purchase-summary-box">
                <table class="summary-table">
                    <tr class="summary-item-row">
                        <th>商品代金</th>
                        <td class="table-value">¥{{ number_format($item->price) }}</td>
                    </tr>

                    <tr class="summary-method-row">
                        <th>支払い方法</th>
                        {{-- ここを書き換えます --}}
                        <td class="table-value js-payment-method">選択してください</td>
                    </tr>
                </table>

                <form id="purchase-form" action="{{ route('purchase.store', $item->id) }}" method="POST">
                    @csrf
                    {{-- サーバーに値を送るための隠し入力 --}}
                    <input type="hidden" name="payment_method_value" id="hidden-payment-method">
                    <button type="submit" class="c-btn-submit c-btn-submit--purchase">購入する</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const methodSelect = document.querySelector('select[name="payment_method"]');
        const displayTarget = document.querySelector('.js-payment-method');
        const hiddenInput = document.getElementById('hidden-payment-method');

        if (methodSelect && displayTarget) {
            methodSelect.addEventListener('change', function() {

                const selectedText = methodSelect.options[methodSelect.selectedIndex].text;

                if (methodSelect.value === "") {
                    displayTarget.textContent = '選択してください';
                    if (hiddenInput) hiddenInput.value = "";
                } else {
                    displayTarget.textContent = selectedText;

                    // 隠し入力値セット
                    if (hiddenInput) {
                        hiddenInput.value = methodSelect.value;
                    }
                }
            });
        }
    });
</script>
@endsection