@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="font-size: 24px; text-align: center; margin-bottom: 30px;">住所の変更</h1>

    <form action="{{ route('purchase.address.update', $item_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">郵便番号</label>
            <input type="text" name="post_code" value="{{ old('post_code', $user->profile->post_code ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">住所</label>
            <input type="text" name="address" value="{{ old('address', $user->profile->address ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">建物名</label>
            <input type="text" name="building" value="{{ old('building', $user->profile->building ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <button type="submit" style="width: 100%; padding: 15px; background: #ff4d4d; color: #fff; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
            更新する
        </button>
    </form>
</div>
@endsection