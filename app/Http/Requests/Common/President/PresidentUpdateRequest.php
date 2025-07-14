<?php

namespace App\Http\Requests\President;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PresidentUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'president_id' => ['required'],
            'president_name' => ['required', 'string']
        ];
    }
    public function messages(): array{
        return [
            'president_id.required' => 'شناسه رئیس جمهور الزامی است',
            'province_name.required' => 'نام رئیس جمهور الزامی است',
            'province_name.string' => 'نام رئیس جمهور باید حاوی کاراکتر باشد',
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
