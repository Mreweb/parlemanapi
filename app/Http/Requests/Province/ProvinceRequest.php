<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProvinceRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'province_name' => ['required', 'string'  , 'max:80' , 'min:3', 'unique:province'],
        ];
    }

    public function messages(): array
    {
        return [
            'province_name.required' => 'نام استان الزامی است',
            'province_name.min' => 'نام استان باید بیشتر از 3 کاراکتر باشد',
            'province_name.max' => 'نام استان باید کمتر از 255 کاراکتر باشد',
            'province_name.unique' => 'نام استان تکراری است',
            'province_name.string' => 'نام استان باید حاوی کاراکتر باشد',
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
