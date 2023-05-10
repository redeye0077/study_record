<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsLoginIdRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/\A([a-zA-Z0-9])+\z/u|max:50|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'max' => ':attributeは50文字以下で入力してください。',
            'unique' => 'その:attributeは既に使用されています。',
            'regex' => ':attributeは英数字で入力してください。',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'ログインid',
        ];
    }
}
