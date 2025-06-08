<?php

namespace App\Http\Requests\Rules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RulesRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'rule_preparation' => ['required'],
            'rule_executive_branch' => ['required'],
            'rule_history' => ['required'],
            'rule_approve_date' => ['required'],
            'rule_president_notification_number' => ['required'],
            'rule_president_notification_date' => ['required'],
            'rule_person_id' => ['required'],
            'rule_president_id' => ['required'],
            'rule_gov_period_id' => ['required'],
            'rule_parliament_period_id' => ['required']
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
