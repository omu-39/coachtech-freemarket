<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required|max:255',
            'image' => 'required|mimes:jpeg,png',
            'categories' => 'required',
            'status' => 'required|in:0,1,2,3',
            'price' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '商品名を入力してください',
            'description.required' => '商品の説明を入力してください',
            'description.max' => '商品の説明は255文字以内で入力してください',
            'image.required' => '商品の写真を選択してください',
            'categories.required' => 'カテゴリーを選択してください',
            'status.required' => 'ステータスを選択してください',
            'price.required' => '価格を入力してください',
            'price.integer' => '価格は半角で入力してください',
            'price.min' => '価格は0円以上で入力してください',
        ];
    }
}
