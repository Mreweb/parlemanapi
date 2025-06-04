<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProvinceUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'province_id' => ['required'],
            'province_name' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'province_name.required' => 'نام استان الزامی است',
            'province_name.string' => 'نام استان باید حاوی کاراکتر باشد',
            'province_id.required' => 'شناسه استان الزامی است',
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
