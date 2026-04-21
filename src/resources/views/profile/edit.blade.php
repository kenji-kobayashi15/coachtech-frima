@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <h1 style="font-size: 24px; text-align: center; margin-bottom: 30px;">プロフィール設定</h1>

    {{-- 成功メッセージの表示 --}}
    @if (session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb; text-align: center; font-weight: bold;">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- 更新処理なのでPUTメソッド --}}

        @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- プロフィール画像設定 --}}
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 30px;">
            <div style="width: 100px; height: 100px; border-radius: 50%; background: #ccc; overflow: hidden;">
                <!-- <img src="{{ asset('storage/' . ($user->profile->image_path ?? 'default-icon.png')) }}" id="preview" style="width: 100%; height: 100%; object-fit: cover;"> -->
                <img src="" id="preview" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <label style="padding: 5px 15px; border: 1px solid #ff4d4d; color: #ff4d4d; border-radius: 5px; cursor: pointer;">
                画像を選択する
                <input type="file" name="image" style="display: none;" onchange="previewImage(this);">
            </label>
        </div>

        {{-- ユーザー名 --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        {{-- 郵便番号 --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">郵便番号</label>
            <input type="text" name="post_code" value="{{ old('post_code', $profile->post_code ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        {{-- 住所 --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">住所</label>
            <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        {{-- 建物名 --}}
        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">建物名</label>
            <input type="text" name="building" value="{{ old('building', $profile->building ?? '') }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        </div>

        <button type="submit" style="width: 100%; padding: 15px; background: #ff4d4d; color: #fff; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">更新する</button>
    </form>
</div>

<script>
    function previewImage(obj) {
        var fileReader = new FileReader();
        fileReader.onload = (function() {
            document.getElementById('preview').src = fileReader.result;
        });
        fileReader.readAsDataURL(obj.files[0]);
    }
</script>
@endsection