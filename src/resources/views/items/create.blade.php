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
                <p id="preview-text" class="upload-placeholder">画像を選択する</p>
            </div>
            @error('image')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-section">
            <h2 class="section-subtitle">商品の詳細</h2>
            {{-- カテゴリー --}}
            <div class="form-group mt-medium">
                <label class="form-label">カテゴリー</label>
                <div class="category-group">
                    @foreach($categories as $category)
                    <label class="category-label">
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" {{ (is_array(old('category_ids')) && in_array($category->id, old('category_ids'))) ? 'checked' : '' }}>
                        {{ $category->name }}
                    </label>
                    @endforeach
                </div>
                @error('category_ids')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            {{-- 商品の状態 --}}
            <div class="form-group">
                <label class="form-label">商品の状態</label>
                <select name="condition_id" class="form-select">
                    <option value="">選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>{{ $condition->name }}</option>
                    @endforeach
                </select>
                @error('condition_id')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-section">
            <h2 class="section-subtitle">商品名と説明</h2>
        </div>

        {{-- 商品名 --}}
        <div class="form-group mt-medium">
            <label class="form-label">商品名</label>
            <input type="text" name="name" value="{{ old('name') }}" class=" form-control">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- ブランド名 --}}
        <div class="form-group mt-medium">
            <label class="form-label">ブランド</label>
            <input type="text" name="brand" value="{{ old('brand') }}" class="form-control">
            @error('brand')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品の説明 --}}
        <div class="form-group">
            <label class="form-label">商品の説明</label>
            <textarea name="description" class="form-textarea">{{ old('description') }}</textarea>
            @error('description')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 販売価格 --}}
        <div class="form-group mb-large">
            <label class="form-label">販売価格</label>
            <div class="price-input-wrapper">
                <span class="currency-unit">¥</span>
                <input type="number" name="price" value="{{ old('price') }}" class="form-control price-input">
                @error('price')
                <p class="error-message">{{ $message }}</p>
                @enderror
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