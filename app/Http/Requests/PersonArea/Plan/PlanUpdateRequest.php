<?php

namespace App\Http\Requests\PersonArea\Plan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PlanUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'plan_id' => ['required'],
            'plan_person_id' => ['required'],
            'plan_title' => ['required'],
            'plan_content' => ['required'],
            'plan_prev_title' => ['required'],
            'plan_date' => ['required'],
            'plan_president_id' => ['required'],
            'plan_gov_period_id' => ['required'],
            'plan_parliament_period_id' => ['required'],
            'plan_register_number' => ['required'],
            'plan_meeting' => ['required'],
            'plan_priority' => ['required'],
            'plan_prev_register_number' => ['required'],
            'plan_print_number' => ['required'],
            'plan_print_date' => ['required'],
            'plan_period' => ['required'],
            'plan_gov_opinion' => ['required'],
            'plan_gov_register_date' => ['required'],
            'plan_gov_register_number' => ['required'],
            'main_commission' => ['array'],
            'signatures' => ['array'],
            'suggest_resources' => ['array'],
            'sub_commission' => ['array'],
            'type' => ['array'],
            'bill_85_review' => ['array'],
            'deputy_actions' => ['array'],
            'guardian_council' => ['array'],
            'promote_law' => ['array'],
            'workflow_commission' => ['array'],
            'workflow_public_court' => ['array'],
            'silence' => ['array'],
            'refinement' => ['array'],
            'attachments' => ['array']
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
