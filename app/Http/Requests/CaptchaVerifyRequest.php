<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CaptchaVerifyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'captcha_id' => ['required', 'string'],
            'captcha_code' => ['required'],
            'otc' => ['required' , 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'captcha_id.required' => 'شناسه کد امنیتی الزامی است',
            'captcha_code.required' => 'کد امنیتی الزامی است',
            'otc.required' => 'کپچا یکبار مصرف الزامی است',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "class"=> "red",
            "type"=> "Service.Error",
            'success' => false,
            'message' => 'لطفا موارد الزامی را تکمیل کنید',
            'errors' => $validator->errors()
        ], 422));
    }
}
