<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id'   => 'required|exists:categories,id',
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'gender'        => 'required|integer|in:1,2,3',
            'email'         => 'required|email|max:255',
            'tel1'         => 'required|digits_between:1,5',
            'tel2'         => 'required|digits_between:1,5',
            'tel3'         => 'required|digits_between:1,5',
            'address'       => 'required|string|max:255',
            'building'      => 'nullable|string|max:255',
            'detail'        => 'required|string|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required'   => '姓を入力してください。',
            'first_name.required'  => '名を入力してください。',
            'gender.required'      => '性別を選択してください。',
            'gender.in'            => '無効な性別の値です。',
            'email.required'       => 'メールアドレスを入力してください。',
            'email.email'          => 'メールアドレスはメール形式で入力してください。',
            'tel1.required'       => '電話番号（市外局番）を入力してください。',
            'tel1.digits_between' => '電話番号（市外局番）は5桁までの数字で入力してください。',
            'tel2.required'       => '2枠目の電話番号を入力してください。',
            'tel2.digits_between' => '2枠目の電話番号は5桁までの数字で入力してください。',
            'tel3.required'       => '3枠目の電話番号を入力してください。',
            'tel3.digits_between' => '3枠目の電話番号は5桁までの数字で入力してください。',
            'address.required'     => '住所を入力してください。',
            'category_id.required' => 'お問い合わせの種類を選択してください。',
            'category_id.exists'   => '選択されたお問い合わせの種類は存在しません。',
            'detail.required'      => 'お問い合わせ内容を入力してください。',
            'detail.max'           => 'お問い合わせ内容は120文字以内で入力してください。',
        ];
    }
}