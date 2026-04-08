<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
        );

        return redirect()->route('profile.edit')->with('success', 'プロフィールを更新しました。');
    }
}
