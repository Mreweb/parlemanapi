<?php

namespace App\Http\Requests\Ministry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MinistryUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'ministry_id' => ['required'],
            'ministry_name' => ['required', 'string']
        ];
    }
    public function messages(): array{
        return [
            'ministry_id.required' => 'شناسه وزارتخانه الزامی است',
            'ministry_name.required' => 'نام وزارتخانه الزامی است',
            'ministry_name.string' => 'نام وزارتخانه باید حاوی کاراکتر باشد',
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
