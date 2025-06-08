<?php

namespace App\Http\Requests\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestsUpdateTrackRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'row_id' => ['required'],
            'request_id' => ['required'],
            'request_commission_title' => ['required'],
            'request_subject_title' => ['required'],
            'request_subject_description' => ['required'],
            'request_subject_result' => ['required']
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
