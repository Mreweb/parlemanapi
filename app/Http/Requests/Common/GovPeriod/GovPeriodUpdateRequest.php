<?php

namespace App\Http\Requests\GovPeriod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GovPeriodUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'gov_period_name' => ['required', 'string'],
            'gov_period_id' => ['required']
        ];
    }
    public function messages(): array{
        return [
            'gov_period_id.required' => 'شناسه دوره ریاست جمهوری الزامی است',
            'gov_period_name.required' => 'نام دوره ریاست جمهوری الزامی است',
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
