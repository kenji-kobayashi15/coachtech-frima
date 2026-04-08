<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }}</title>
</head>
<body>
    <h1>{{ $item->name }}</h1>
    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" width="300">
    <p>ブランド名: {{ $item->brand }}</p>
    <p>価格: ¥{{ number_format($item->price) }}</p>
    <p>説明: {{ $item->description }}</p>
    <p>いいね数: {{ $item->likes->count() }}</p>
    <p>コメント数: {{ $item->comments->count() }}</p>
    
    <h2>コメント</h2>
    @foreach ($item->comments as $comment)
        <div>
            <p>{{ $comment->user->name }}: {{ $comment->content }}</p>
        </div>
    @endforeach
</body>
</html>
