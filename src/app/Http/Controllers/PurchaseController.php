<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * PG10: 商品購入画面を表示
     */
    public function create($item_id)
    {
        // 1. URLの {item_id} を元に、データベースから商品情報を取得
        $item = Item::findOrFail($item_id);

        // 2. 現在ログインしているユーザー情報を取得（プロフィール画像や住所表示のため）
        $user = Auth::user();

        // 3. 商品情報 ($item) と ユーザー情報 ($user) を購入画面に渡す
        return view('purchase.create', compact('item', 'user'));
    }

    /**
     * 購入処理の実装（後ほど）
     */
    public function store(Request $request, $item_id)
    {
        // ここに決済処理などを書いていきます
    }
}