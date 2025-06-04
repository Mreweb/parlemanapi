<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CityUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'city_id' => ['required' , 'numeric' , 'exists:city,city_id'] ,
            'city_name' => ['required', 'string'  , 'max:255' , 'min:3'] ,
            'city_province_id' => ['required' , 'numeric']
        ];
    }

    public function messages(): array{
        return [
            'city_id.exists' => 'شناسه شهر یافت نشد',
            'city_name.required' => 'نام شهر الزامی است',
            'city_name.min' => 'نام شهر باید بیشتر از 3 کاراکتر باشد',
            'city_name.max' => 'نام شهر باید کمتر از 255 کاراکتر باشد',
            'city_name.string' => 'نام شهر فقط حاوی کاراکتر باشد',
            'city_province_id.required' => 'شناسه استان الزامی است',
            'city_province_id.numeric' => 'شناسه استان باید عدد باشد',
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
