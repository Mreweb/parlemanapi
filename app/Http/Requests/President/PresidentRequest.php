<?php

namespace App\Http\Requests\President;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PresidentRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'president_name' => ['required', 'string'  , 'max:80' , 'min:3']
        ];
    }
    public function messages(): array{
        return [
            'province_name.required' => 'نام رئیس جمهور الزامی است',
            'province_name.min' => 'نام رئیس جمهور  باید بیشتر از 3 کاراکتر باشد',
            'province_name.max' => 'نام رئیس جمهور  باید کمتر از 255 کاراکتر باشد',
            'province_name.string' => 'نام رئیس جمهور باید حاوی کاراکتر باشد',
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "class"=> "red",
            "type"=> "Service.Error",
            'success' => false,
            'message' => 'عملیات با خطا مواجه شد',
            'errors' => $validator->errors()->all()
        ], 422));
    }
}
