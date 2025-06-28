<?php

namespace App\Http\Requests\RuleFortyFive;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RuleFortyFiveUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'rule_forty_five_id' => ['required'],
            'rule_forty_five_president_id' => ['required'],
            'rule_forty_five_person_id' => ['required'],
            'rule_forty_five_gov_period_id' => ['required'],
            'rule_forty_five_parliament_period_id' => ['required'],
            'rule_forty_five_meeting' => ['required'],
            'rule_forty_five_register_number' => ['required'],
            'rule_forty_five_subject' => ['required'],
            'rule_forty_five_summary' => ['required'],
            'rule_forty_five_worksheet_id' => ['required'],
            'rule_forty_five_commission_id' => ['required'],
            'rule_forty_five_commission_result' => ['required'],
            'rule_forty_five_commission_content' => ['required'],
            'rule_forty_five_public_court_date' => ['required'],
            'rule_forty_five_public_parliament_session_number' => ['required'],
            'rule_forty_five_public_parliament_check_result' => ['required'],
            'rule_forty_five_public_parliament_content' => ['required'],
            'rule_forty_five_ministry_id' => ['required'],
            'rule_forty_five_summary_content' => ['required'],
            'rule_forty_five_signatures_person_ids' => ['array']
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
