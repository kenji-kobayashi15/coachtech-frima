<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * PG09: プロフィール画面（マイページ）を表示
     */
    public function index()
    {
        return view('profile.index');
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
        $imageUrl = $user->profile->image_url ?? null;

        if ($request->hasFile('image')) {
            // public/profiles フォルダに画像を保存し、そのパスを取得
            $imageUrl = $request->file('image')->store('profiles', 'public');
        }

        // プロフィールの更新
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
                'image_url' => $imageUrl,
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
        // 購入画面から渡ってきた $item_id を保持したままビューを返します
        return view('purchase.address', compact('item_id'));
    }

    /**
     * 送付先住所の更新処理
     */
    public function updateAddress(Request $request, $item_id)
    {
        // ここに住所更新のロジックを後ほど実装します
        // 更新後は購入画面に戻るなどの処理を予定
    }
}
