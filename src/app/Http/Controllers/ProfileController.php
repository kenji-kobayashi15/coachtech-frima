<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $page = $request->query('page', 'sell');

        if ($page === 'buy') {
            // 【購入した商品】
            // 自分の注文(orders)に紐づく商品(item)をまとめて取得（Eager Loading）
            $items = $user->orders()->with('item')->get()->map(function ($order) {
                return $order->item;
            })
            ->filter();
        } else {
            // 【出品した商品】
            $items = $user->items;
        }

        // $user, $items, $page（現在のタブ判定用）をビューに渡す
        return view('profile.index', compact('user', 'items', 'page'));
    }

    public function edit()
    {
        // ログインしているユーザー自身を取得（これに付随するプロフィールも一緒に取れる）
        $user = Auth::user();

        // プロフィール情報も変数に入れておく（既存のコードに合わせて）
        $profile = $user->profile;

        // 両方を画面に渡す！
        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(ProfileRequest $request)
    {
        // 現在のユーザーを取得
        $user = Auth::user();

        // ユーザー名の更新
        $user->name = $request->name;
        $user->save();

        // 画像の保存処理
        $imagePath = $user->profile->image_path ?? null;

        if ($request->hasFile('image')) {
            // public/profiles フォルダに画像を保存し、そのパスを取得
            $imagePath = $request->file('image')->store('profiles', 'public');
        }

        // プロフィールの更新
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
                'image_path' => $imagePath,
            ]
        );

        // 【重要】リダイレクト先を編集画面（profile.edit）に戻す
        return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました。');
    }

    /**
     * PG07: 送付先住所変更画面を表示
     */
    public function editAddress($item_id)
    {
        /** @var \App\Models\User $user */ //
        $user = Auth::user();
        // プロフィールが未作成の場合に備え、Eager Loadしておく
        $user->load('profile');

        return view('purchase.address', compact('user', 'item_id'));
    }

    /**
     * 送付先住所の更新処理
     */
    public function updateAddress(Request $request, $item_id)
    {
        /** @var \App\Models\User $user */ //
        $user = Auth::user();

        // profilesテーブルを更新、または新規作成
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => $request->post_code,
                'address'   => $request->address,
                'building'  => $request->building,
            ]
        );

        // 更新後、その商品の購入画面に戻る
        return redirect()->route('purchase.create', ['item_id' => $item_id]);
    }
}
