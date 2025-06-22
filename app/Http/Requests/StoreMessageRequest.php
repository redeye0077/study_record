<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
    public function rules()
    {
        return [
            'message' => 'required|string|max:100',
        ];
    }

     public function messages()
    {
        return [
            'required' => ':attributeは必須です。',
            'max' => ':attributeは100文字以内で入力してください。',
        ];
    }
}
