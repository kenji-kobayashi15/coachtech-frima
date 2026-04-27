<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('order')->get();
        return view('items.index', compact('items'));
    }

    public function show($item_id)
    {
        $item = Item::with(['comments.user', 'likes', 'categories', 'condition'])->findOrFail($item_id);
        return view('items.show', compact('item'));
    }

    // 商品出品画面を表示する
    public function create()
    {
        $categories = Category::all();

        // 全ての商品の状態も取得
        $conditions = Condition::all();

        return view('items.create', compact('categories', 'conditions'));
    }

    // 商品情報を保存
    public function store(ItemRequest $request)
    {
        // 1. 画像の保存
        $imagePath = $request->file('image')->store('item_images', 'public');

        // 2. 商品の保存
        $item = Item::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'condition_id' => $request->condition_id,
            'image_url' => $imagePath,
        ]);

        // 3. カテゴリの紐付け（中間テーブル）
        $item->categories()->attach($request->category_ids);

        // 4. 一覧へリダイレクト
        return redirect()->route('items.index')->with('success', '商品を出品しました！');
    }

}
