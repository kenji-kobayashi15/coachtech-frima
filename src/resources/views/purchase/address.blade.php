@extends('layouts.app')

@section('content')
<div class="address-edit-container">
    <h1 class="page-title">住所の変更</h1>

    <form action="{{ route('purchase.address.update', $item_id) }}" method="POST" class="address-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">郵便番号</label>
            <input type="text" name="post_code" value="{{ old('post_code', $user->profile->post_code ?? '') }}" class="form-control">
        </div>

        <div class="form-group">
            <label class="form-label">住所</label>
            <input type="text" name="address" value="{{ old('address', $user->profile->address ?? '') }}" class="form-control">
        </div>

        <div class="form-group mb-large">
            <label class="form-label">建物名</label>
            <input type="text" name="building" value="{{ old('building', $user->profile->building ?? '') }}" class="form-control">
        </div>

        <button type="submit" class="btn-submit">
            更新する
        </button>
    </form>
</div>
@endsection