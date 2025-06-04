<?php

namespace App\Http\Requests\Fraction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FractionUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'fraction_id' => ['required'],
            'fraction_name' => ['required', 'string']
        ];
    }
    public function messages(): array{
        return [
            'fraction_id.required' => 'شناسه فراکسیون الزامی است',
            'fraction_name.required' => 'نام فراکسیون الزامی است',
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
