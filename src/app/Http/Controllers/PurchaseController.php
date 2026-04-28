<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class PurchaseController extends Controller
{
    /**
     * PG10: 商品購入画面を表示
     */
    public function create($item_id)
    {
        // 1. URLの {item_id} を元に、データベースから商品情報を取得
        $item = Item::findOrFail($item_id);

        // 出品者本人が購入画面に来た場合、詳細画面に戻す
        if ($item->user_id === Auth::id()) {
            return redirect()->route('items.show', $item->id);
        }

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
        $user = Auth::user();
        $item = Item::findOrFail($item_id);

        // 支払い方法が選択されているか確認
        if (!$request->payment_method) {
            return back()->with('error', '支払い方法を選択してください');
        }

        // すでに売れていないかチェック
        if ($item->order) {
            return back()->with('error', 'この商品はすでに売り切れています');
        }

        // 注文情報の保存
        Order::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'payment_method' => $request->payment_method,
            'post_code' => $user->profile->post_code,
            'address' => $user->profile->address,
            'building' => $user->profile->building,
        ]);

        // 購入完了後、商品一覧へ戻る
        return redirect()->route('items.index')->with('success', '購入が完了しました');
    }
}