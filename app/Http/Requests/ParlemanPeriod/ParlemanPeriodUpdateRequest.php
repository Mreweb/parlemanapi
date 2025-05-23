<?php

namespace App\Http\Requests\ParlemanPeriod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ParlemanPeriodUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'period_title' => ['required', 'string'],
            'period_id' => ['required'],
        ];
    }
    public function messages(): array{
        return [
            'period_id.required' => 'شناسه دوره الزامی است',
            'period_title.required' => 'نام دوره الزامی است',
            'period_title.string' => 'نام دوره باید حاوی کاراکتر باشد'
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
