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
            'hour' => 'required|numeric|between:0,23',
            'minutes' => 'required|numeric|between:0,59',
            'subject' => 'required|string|max:50',
            'date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'numeric' => ':attributeは数字で入力してください。',
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
            'hour' => '時間',
            'minutes' => '分',
            'subject' => '科目',
            'date' => '日付',
        ];
    }
}
