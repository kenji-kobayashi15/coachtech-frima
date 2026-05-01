<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|string|max:255',
            'brand'        => 'nullable|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|integer|min:1',
            'condition_id' => 'required|exists:conditions,id',
            'category_ids' => 'required|array',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',//
        ];
    }

    public function messages()
    {
        return [
            'image.required'        => '商品画像を選択してください',
            'image.mimes'           => '指定したファイルが画像ではありません',
            'category_ids.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'name.required'         => '商品名を入力してください',
            'description.required'  => '商品の説明を入力してください',
            'description.max'       => '商品の説明は255文字以内で入力してください',
            'price.required'        => '販売価格を入力してください',
            'price.integer'         => '数値で入力してください',
            'price.min'             => '0円以上の金額を入力してください',
        ];
    }
}