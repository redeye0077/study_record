<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudyChallengesNewRequest extends FormRequest
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
            'target_hour' => 'required|integer|min:0',
            'target_minutes' => 'required|integer|min:0|max:59',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'integer' => ':attributeは整数で入力してください。',
            'min' => ':attributeは0以上で入力してください。',
            'max' => ':attributeは59以下で入力してください。',
        ];
    }

    public function attributes()
    {
        return [
            'target_hour' => '目標時間',
            'target_minutes' => '目標分',
        ];
    }
}
