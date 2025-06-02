<?php

namespace App\Http\Requests\Ministry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MinistryRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }



    public function rules(): array{
        return [
            'ministry_name' => ['required', 'string']
        ];
    }
    public function messages(): array{
        return [
            'ministry_name.required' => 'نام وزارتخانه الزامی است',
            'ministry_name.string' => 'نام وزارتخانه باید حاوی کاراکتر باشد',
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
