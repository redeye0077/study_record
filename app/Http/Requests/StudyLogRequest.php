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
            'hour' => 'bail|required|integer|min:0|max:23',
            'minutes' => 'bail|required|integer|min:0|max:59',
            'subject' => 'bail|required|string|max:50',
            'date' => 'bail|required|date',
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
            'hour.min' => '学習時間は0以上で入力してください',
            'hour.max' => '学習時間は23以下で入力してください',
            'minutes.min' => '学習分は0以上で入力してください',
            'minutes.max' => '学習分は59以下で入力してください',
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
