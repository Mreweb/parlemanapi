<?php

namespace App\Http\Requests\Person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PersonRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }


    public function rules(): array{
        return [
            'person_name' => ['required', 'string'],
            'person_last_name' => ['required', 'string'],
            'person_national_code' => ['required', 'string'],
            'person_phone' => ['required', 'string'],
            'person_gender' => ['required', 'string'],
            'person_province_id' => ['required'],
            'username' => ['required', 'string'],
            'password' => ['string']
        ];
    }

    public function messages(): array{
        return ['تکمیل موارد ستازه دار الزامی است'];
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
