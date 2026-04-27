@extends('layouts.app')

@section('content')
<div class="item-create-container">
    <h1 class="page-title">商品の出品</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="item-form">
        @csrf

        {{-- 商品画像 --}}
        <div class="form-group">
            <label class="form-label">商品画像</label>
            <div class="image-upload-box">
                <input type="file" name="image" class="file-input" onchange="previewImage(this);">
                <img id="preview" class="upload-preview">
                <p id="preview-text" class="upload-placeholder">クリックして画像を選択</p>
            </div>
        </div>

        <h2 class="section-subtitle">商品の詳細</h2>

        {{-- カテゴリー --}}
        <div class="form-group mt-medium">
            <label class="form-label">カテゴリー</label>
            <div class="category-group">
                @foreach($categories as $category)
                <label class="category-label">
                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                    {{ $category->name }}
                </label>
                @endforeach
            </div>
        </div>

        {{-- 商品の状態 --}}
        <div class="form-group">
            <label class="form-label">商品の状態</label>
            <select name="condition_id" class="form-select">
                <option value="">選択してください</option>
                @foreach($conditions as $condition)
                <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                @endforeach
            </select>
        </div>

        <h2 class="section-subtitle">商品名と説明</h2>

        {{-- 商品名 --}}
        <div class="form-group mt-medium">
            <label class="form-label">商品名</label>
            <input type="text" name="name" class="form-control">
        </div>

        {{-- 商品の説明 --}}
        <div class="form-group">
            <label class="form-label">商品の説明</label>
            <textarea name="description" class="form-textarea"></textarea>
        </div>

        {{-- 販売価格 --}}
        <div class="form-group mb-large">
            <label class="form-label">販売価格</label>
            <div class="price-input-wrapper">
                <span class="currency-unit">¥</span>
                <input type="number" name="price" class="form-control price-input">
            </div>
        </div>

        <button type="submit" class="btn-submit">
            出品する
        </button>
    </form>
</div>

<script>
    function previewImage(obj) {
        var fileReader = new FileReader();
        fileReader.onload = (function() {
            var preview = document.getElementById('preview');
            var text = document.getElementById('preview-text');
            preview.src = fileReader.result;
            preview.classList.add('is-active');
            text.classList.add('is-hidden');
        });
        fileReader.readAsDataURL(obj.files[0]);
    }
</script>
@endsection