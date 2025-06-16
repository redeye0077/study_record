<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudyLogRequest extends FormRequest
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
            'hour' => 'required|integer|between:0,23',
            'minutes' => 'required|integer|between:0,59',
            'subject' => 'required|string|max:50',
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'integer' => ':attributeは整数で入力してください。',
            'string' => ':attributeは文字で入力してください。',
            'max' => ':attributeは50文字以内で入力してください。',
            'date' => ':attributeは日付で入力してください。',
            'between' => ':attributeは0以上23以下で入力してください。',
            'between' => ':attributeは0以上59以下で入力してください。',
        ];
    }

    public function attributes()
    {
        return [
            'hour' => '学習時間',
            'minutes' => '学習分',
            'subject' => '学習内容',
            'date' => '日付',
        ];
    }
}
