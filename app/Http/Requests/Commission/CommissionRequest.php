<?php

namespace App\Http\Requests\Commission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommissionRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'commission_name' => ['required', 'string']
        ];
    }
    public function messages(): array{
        return [
            'commission_name.required' => 'نام کمیسیون الزامی است',
            'commission_name.string' => 'نام کمیسیون باید حاوی کاراکتر باشد',
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
