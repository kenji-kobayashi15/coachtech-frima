<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        // ここを true
        return true;
    }

    public function rules()
    {
        return [
            'name'      => ['required'],
            'post_code' => ['required', 'regex:/^\d{3}-\d{4}$/'], // ハイフンあり8文字の正規表現
            'address'   => ['required'],
            'image'     => ['nullable', 'image', 'mimes:jpeg,png'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'お名前を入力してください',
            'post_code.required' => '郵便番号を入力してください',
            'post_code.regex'    => '郵便番号はハイフンを含んだ8文字で入力してください',
            'address.required'   => '住所を入力してください',
            'image.image'        => '指定したファイルが画像ではありません',
            'image.mimes'        => '指定したファイルが画像ではありません', // jpeg, png以外もこの文言にする
        ];
    }
}
