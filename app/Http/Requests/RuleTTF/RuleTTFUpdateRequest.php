<?php

namespace App\Http\Requests\RuleTTF;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RuleTTFUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'rule_ttf_id' => ['required'],
            'rule_ttf_person_id' => ['required'],
            'rule_ttf_president_id' => ['required'],
            'rule_ttf_gov_period_id' => ['required'],
            'rule_ttf_parliament_period_id' => ['required'],
            'rule_ttf_meeting' => ['required'],
            'rule_ttf_register_number' => ['required'],
            'rule_ttf_subject' => ['required'],
            'rule_ttf_summary' => ['required'],
            'rule_ttf_worksheet_id' => ['required'],
            'rule_ttf_commission_id' => ['required'],
            'rule_ttf_commission_result' => ['required'],
            'rule_ttf_public_court_date' => ['required'],
            'rule_ttf_public_parliament_session_number' => ['required'],
            'rule_ttf_public_parliament_check_result' => ['required'],
            'rule_ttf_ministry_id' => ['required'],
            'rule_ttf_summary_content' => ['required'],
            'rule_ttf_signatures_person_ids' => ['array']
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
