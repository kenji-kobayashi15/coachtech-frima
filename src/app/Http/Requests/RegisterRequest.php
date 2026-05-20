<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * リクエストの実行権限（今回は全員許可）
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:20'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * カスタムエラーメッセージ
     */
    public function messages(): array
    {
        return [
            'required'           => ':attributeを入力してください',
            'name.max'          => 'お名前は20文字以内で入力して下さい',
            'email.email'       => 'メールアドレスはメール形式で入力してください',
            'email.unique'       => 'このメールアドレスはすでに登録されています。',
            'password.min'      => 'パスワードは8文字以上で入力してください',
            'password.confirmed' => 'パスワードと一致しません',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'     => 'お名前',
            'email'    => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
