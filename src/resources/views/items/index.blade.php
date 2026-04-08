<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
</head>
<body>
    <h1>商品一覧</h1>
    @foreach ($items as $item)
        <div>
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" width="100">
            <p>{{ $item->name }}</p>
            @if ($item->is_sold)
                <p>Sold</p>
            @endif
        </div>
    @endforeach
</body>
</html>
