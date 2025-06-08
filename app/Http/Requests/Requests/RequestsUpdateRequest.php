<?php

namespace App\Http\Requests\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestsUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'request_id' => ['required'],
            'request_title' => ['required'],
            'request_date' => ['required'],
            'request_place' => ['required'],
            'request_phone' => ['required'],
            'request_description' => ['required'],
            'request_command' => ['required'],
            'request_serial' => ['required'],
            'request_person_id' => ['required'],
            'request_president_id' => ['required'],
            'request_gov_period_id' => ['required'],
            'request_parliament_period_id' => ['required']
        ];
    }
    public function messages(): array{
        return [ 'لطفا موارد الزامی را تکمیل کنید' ];
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
