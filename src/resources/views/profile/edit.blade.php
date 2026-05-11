@extends('layouts.app')

@section('content')
<div class="profile-edit-container">
    <h1 class="page-title">プロフィール設定</h1>

    {{-- 成功メッセージ --}}
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form" novalidate>
        @csrf
        @method('PATCH')

        {{-- プロフィール画像設定 --}}
        <div class="profile-image-section">
            <div class="profile-image-flex">
                <div class="image-preview-wrapper">
                    @php
                    $imagePath = ($user->profile && $user->profile->image_path)
                    ? asset('storage/' . $user->profile->image_path)
                    : asset('storage/default-icon.png');
                    @endphp
                    <img src="{{ $imagePath }}" id="preview" class="image-preview">
                </div>
                <label class="btn-outline-primary">
                    画像を選択する
                    <input type="file" name="image" class="file-input" onchange="previewImage(this);">
                </label>
            </div>
            {{-- 画像のエラー表示を追加 --}}
            @error('image')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- ユーザー名 --}}
        <div class="form-group">
            <label class="form-label">ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 郵便番号 --}}
        <div class="form-group">
            <label class="form-label">郵便番号</label>
            <input type="text" name="post_code" value="{{ old('post_code', $profile->post_code ?? '') }}" class="form-control">
            @error('post_code')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>


        {{-- 住所 --}}
        <div class="form-group">
            <label class="form-label">住所</label>
            <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" class="form-control">
            @error('address')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 建物名 --}}
        <div class="form-group mb-large">
            <label class="form-label">建物名</label>
            <input type="text" name="building" value="{{ old('building', $profile->building ?? '') }}" class="form-control">
        </div>

        <button type="submit" class="btn-submit">更新する</button>
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