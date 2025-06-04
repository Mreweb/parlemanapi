<?php

namespace App\Http\Requests\GovPeriod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GovPeriodRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'gov_period_name' => ['required', 'string'  , 'max:255' , 'min:3']
        ];
    }
    public function messages(): array{
        return [
            'gov_period_name.required' => 'نام دوره ریاست جمهوری الزامی است',
            'gov_period_name.min' => 'نام دوره ریاست جمهوری باید بیشتر از 3 کاراکتر باشد',
            'gov_period_name.max' => 'نام دوره ریاست جمهوری باید کمتر از 255 کاراکتر باشد',
            'gov_period_name.string' => 'نام دوره ریاست جمهوری باید حاوی کاراکتر باشد'
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
