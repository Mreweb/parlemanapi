<?php

namespace App\Http\Requests\Person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PersonFractionRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }


    public function rules(): array{
        return [
            'person_id' => ['required'],
            'fraction_id' => ['required'],
        ];
    }

    public function messages(): array{
        return [
            'person_id.required' => 'شناسه فرد الزامی است',
            'fraction_id.required' => 'شناسه فراکسیون الزامی است'
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
