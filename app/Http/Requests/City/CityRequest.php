<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CityRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'city_name' => ['required', 'string'],
            'city_province_id' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'city_name.required' => 'نام شهر الزامی است',
            'city_name.string' => 'نام شهر باید حاوی کاراکتر باشد',
            'city_province_id.required' => 'شناسه استان الزامی است',
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
