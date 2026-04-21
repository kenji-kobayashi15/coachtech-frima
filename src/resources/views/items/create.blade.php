@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="font-size: 24px; text-align: center; margin-bottom: 30px;">商品の出品</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品画像 --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">商品画像</label>
            <div style="border: 2px dashed #ccc; padding: 20px; text-align: center; position: relative;">
                <input type="file" name="image" style="width: 100%; height: 100%; cursor: pointer;" onchange="previewImage(this);">
                <img id="preview" style="max-width: 100%; margin-top: 10px; display: none;">
                <p id="preview-text" style="color: #666;">クリックして画像を選択</p>
            </div>
        </div>

        <h2 style="font-size: 18px; border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-top: 30px;">商品の詳細</h2>

        {{-- カテゴリー --}}
        <div style="margin-top: 20px; margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">カテゴリー</label>
            {{-- 本来は @foreach でマスタから回しますが、まずは代表的なものを配置 --}}
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <select name="category_id" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    <option value="">選択してください</option>
                    {{-- ここにマスタから取得したカテゴリーが並ぶ予定 --}}
                </select>
            </div>
        </div>

        {{-- 商品の状態 --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">商品の状態</label>
            <select name="condition_id" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                <option value="">選択してください</option>
                {{-- ここにマスタから取得した状態が並ぶ予定 --}}
            </select>
        </div>

        <h2 style="font-size: 18px; border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-top: 30px;">商品名と説明</h2>

        {{-- 商品名 --}}
        <div style="margin-top: 20px; margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">商品名</label>
            <input type="text" name="name" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        {{-- 商品の説明 --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">商品の説明</label>
            <textarea name="description" style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
        </div>

        {{-- 販売価格 --}}
        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">販売価格</label>
            <div style="position: relative;">
                <span style="position: absolute; left: 10px; top: 10px;">¥</span>
                <input type="number" name="price" style="width: 100%; padding: 10px 10px 10px 30px; border: 1px solid #ccc; border-radius: 5px;">
            </div>
        </div>

        <button type="submit" style="width: 100%; padding: 15px; background: #ff4d4d; color: #fff; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
            出品する
        </button>
    </form>
</div>

<script>
    function previewImage(obj) {
        var fileReader = new FileReader();
        fileReader.onload = (function() {
            document.getElementById('preview').src = fileReader.result;
            document.getElementById('preview').style.display = 'block';
            document.getElementById('preview-text').style.display = 'none';
        });
        fileReader.readAsDataURL(obj.files[0]);
    }
</script>
@endsection