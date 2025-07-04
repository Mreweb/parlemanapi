<?php

namespace App\Http\Requests\SessionDeputyGovernor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SessionDeputyGovernorRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'session_president_id' => ['required'],
            'session_person_id' => ['required'],
            'session_gov_period_id' => ['required'],
            'session_parliament_period_id' => ['required'],
            'session_start_date' => ['required'],
            'session_end_date' => ['required'],
            'session_province_id' => ['required'],
            'session_description' => ['required'],
            'session_subject' => ['required'],
            'person_session_board_person_ids' => ['array']
        ];
    }
    public function messages(): array{
        return [ '*.required' => 'لطفا موارد الزامی را تکمیل کنید'];
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
