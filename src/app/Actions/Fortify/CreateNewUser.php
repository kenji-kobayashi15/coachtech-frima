<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // 1. RegisterRequestで定義したルールとメッセージを取得
        $registerRequest = app(\App\Http\Requests\RegisterRequest::class);

        // 2. ValidatorにRequestのルールとメッセージを適用
        Validator::make($input, $registerRequest->rules(), $registerRequest->messages())->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // プロフィールの作成
        Profile::create([
            'user_id' => $user->id,
            'post_code' => '',
            'address' => '',
        ]);

        return $user;
    }
}
