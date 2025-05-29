<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsernameRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'username' => ['required'],
            'password' => ['required'],
            'captcha_id' => ['required'],
            'captcha_code' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'نام کاربری الزامی است',
            'password.required' => 'رمز عبور الزامی است',
            'captcha_id.required' => 'شناسه کد امنیتی الزامی است',
            'captcha_code.required' => 'کد امنیتی الزامی است',
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
