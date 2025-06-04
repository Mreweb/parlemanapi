<?php

namespace App\Http\Requests\ParlemanPeriod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParlemanPeriodRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'period_title' => ['required', 'string'  , 'max:255' , 'min:3']
        ];
    }
    public function messages(): array{
        return [
            'period_title.required' => 'نام دوره مجلس الزامی است',
            'period_title.min' => 'نام دوره مجلس  باید بیشتر از 3 کاراکتر باشد',
            'period_title.max' => 'نام دوره مجلس  باید کمتر از 255 کاراکتر باشد',
            'period_title.string' => 'نام دوره باید حاوی کاراکتر باشد'
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
