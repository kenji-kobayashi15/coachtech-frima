@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 20px;">
    <div style="display: flex; gap: 50px;">
        {{-- 左側：商品情報と設定 --}}
        <div style="flex: 2;">
            {{-- 商品確認 --}}
            <div style="display: flex; gap: 20px; padding-bottom: 20px; border-bottom: 1px solid #ccc;">
                <div style="width: 150px;">
                    @if (str_starts_with($item->image_path, 'http'))
                    <img src="{{ $item->image_path }}" style="width: 100%;">
                    @else
                    <img src="{{ asset('storage/' . $item->image_path) }}" style="width: 100%;">
                    @endif
                </div>
                <div>
                    <h2 style="font-size: 20px;">{{ $item->name }}</h2>
                    <p style="font-weight: bold;">¥{{ number_format($item->price) }}</p>
                </div>
            </div>

            {{-- 支払い方法 --}}
            <div style="margin-top: 30px;">
                <h3 style="font-size: 18px;">支払い方法</h3>
                <select name="payment_method" form="purchase-form" style="width: 100%; padding: 10px; margin-top: 10px;">
                    <option value="">選択してください</option>
                    <option value="konbini">コンビニ払い</option>
                    <option value="card">カード支払い</option>
                </select>
            </div>

            {{-- 配送先 --}}
            <div style="margin-top: 30px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 18px;">配送先</h3>
                    <a href="{{ route('purchase.address', $item->id) }}" style="color: #007bff; text-decoration: none;">変更する</a>
                </div>
                <p style="margin-top: 10px;">
                    〒 {{ $user->profile->post_code ?? '未設定' }}<br>
                    {{ $user->profile->address ?? '未設定' }} {{ $user->profile->building ?? '' }}
                </p>
            </div>
        </div>

        {{-- 右側：決済確認エリア --}}
        <div style="flex: 1; border: 1px solid #ccc; padding: 20px; height: fit-content;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 10px 0;">商品代金</td>
                    <td style="text-align: right;">¥{{ number_format($item->price) }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #ccc;">
                    <td style="padding: 10px 0;">支払い金額</td>
                    <td style="text-align: right;">¥{{ number_format($item->price) }}</td>
                </tr>
                <tr>
                    <td style="padding: 10px 0;">支払い方法</td>
                    <td style="text-align: right; font-size: 0.9em; color: #666;">選択してください</td>
                </tr>
            </table>

            <form id="purchase-form" action="{{ route('purchase.store', $item->id) }}" method="POST">
                @csrf
                <button type="submit" style="width: 100%; margin-top: 20px; padding: 15px; background: #ff4d4d; color: #fff; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
                    購入する
                </button>
            </form>
        </div>
    </div>
</div>
@endsection