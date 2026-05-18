@extends('layouts.app')

@section('content')
<div class="item-create-container">
    <h1 class="sell-page-title">商品の出品</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="item-form">
        @csrf

        {{-- 商品画像 --}}
        <div class="img-form-group">
            <label class="item-img-label">商品画像</label>
            <div class="image-upload-box @error('image') is-invalid @enderror">
                <label>
                    <img id="preview" class="upload-preview">
                    <p id="preview-text" class="upload-placeholder">画像を選択する</p>
                    <input type="file" name="image" class="file-input" onchange="previewImage(this);">
                </label>
            </div>
            @error('image')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="category-form-section">
            <h2 class="section-subtitle">商品の詳細</h2>
            {{-- カテゴリー --}}
            <div class="form-group mt-medium">
                <label class="category-label-title">カテゴリー</label>
                <div class="category-group @error('category_ids') is-invalid @enderror">
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
            <div class="condition-form-group">
                <label class="condition-label">商品の状態</label>
                <select name="condition_id" class="item-select-box @error('condition_id') is-invalid @enderror">
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

        <div class="detail-item-section">
            <h2 class="item-subtitle">商品名と説明</h2>
        </div>

        {{-- 商品名 --}}
        <div class="form-group mt-medium">
            <label class="item-name-label">商品名</label>
            <input type="text" name="name" value="{{ old('name') }}" class=" item-input-field @error('name') is-invalid @enderror ">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- ブランド名 --}}
        <div class="form-group mt-medium">
            <label class="brand-label">ブランド</label>
            <input type="text" name="brand" value="{{ old('brand') }}" class="item-input-field @error('bland') is-invalid @enderror">
            @error('brand')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 商品の説明 --}}
        <div class="detail-group">
            <label class="detail-label">商品の説明</label>
            <textarea name="description" class="detail-textarea @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 販売価格 --}}
        <div class="form-group mb-large">
            <label class="price-label">販売価格</label>
            <div class="price-input-wrapper">
                <span class="currency-unit">¥</span>
                <input type="number" name="price" value="{{ old('price') }}" class="form-control price-input @error('price') is-invalid @enderror ">
                @error('price')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="sell-btn-submit">
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