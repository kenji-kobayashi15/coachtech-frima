<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール設定</title>
</head>
<body>
    <h1>プロフィール設定</h1>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="image">プロフィール画像</label>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <label for="name">ユーザー名</label>
            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}">
        </div>
        <div>
            <label for="post_code">郵便番号</label>
            <input type="text" name="post_code" id="post_code" value="{{ old('post_code', $profile->post_code ?? '') }}">
        </div>
        <div>
            <label for="address">住所</label>
            <input type="text" name="address" id="address" value="{{ old('address', $profile->address ?? '') }}">
        </div>
        <div>
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" value="{{ old('building', $profile->building ?? '') }}">
        </div>
        <button type="submit">更新する</button>
    </form>
</body>
</html>
