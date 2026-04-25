<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
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
        return view('items.create');
    }

    // 商品情報を保存する（実際の保存処理は後ほど実装）
    public function store(Request $request)
    {
        // ここにバリデーションや保存処理を書いていきます
    }
}
