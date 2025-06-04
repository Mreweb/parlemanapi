<?php

namespace App\Http\Requests\Fraction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FractionRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'fraction_name' => ['required', 'string'  , 'max:255' , 'min:3']
        ];
    }
    public function messages(): array{
        return [
            'fraction_name.required' => 'نام فراکسیون الزامی است',
            'fraction_name.min' => 'نام فراکسیون باید بیشتر از 3 کاراکتر باشد',
            'fraction_name.max' => 'نام فراکسیون باید کمتر از 255 کاراکتر باشد',
            'fraction_name.string' => 'نام فراکسیون باید حاوی کاراکتر باشد',
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
