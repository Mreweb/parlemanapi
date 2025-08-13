<?php

namespace App\Http\Requests\PersonArea\Enactment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EnactmentUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'enactment_id' => ['required'],
            'enactment_person_id' => ['required'],
            'enactment_title' => ['required'],
            'enactment_content' => ['required'],
            'enactment_prev_title' => ['required'],
            'enactment_date' => ['required'],
            'enactment_president_id' => ['required'],
            'enactment_gov_period_id' => ['required'],
            'enactment_parliament_period_id' => ['required'],
            'enactment_president_letter_number' => ['required'],
            'enactment_president_letter_date' => ['required'],
            'enactment_president_deputy_letter_number' => ['required'],
            'enactment_president_deputy_letter_date' => ['required'],
            'enactment_priority' => ['required'],
            'enactment_register_number' => ['required'],
            'enactment_print_number' => ['required'],
            'enactment_print_date' => ['required'],
            'enactment_prev_register_number' => ['required'],
            'enactment_period' => ['required'],
            'main_commission' => ['array'],
            'ministry_signatures' => ['array'],
            'sub_commission' => ['array'],
            'suggest_resources' => ['array'],
            'type' => ['array'],
            'type_bill_85_review' => ['array'],
            'type_deputy_actions' => ['array'],
            'type_guardian_council' => ['array'],
            'type_promote_law' => ['array'],
            'type_workflow_commission' => ['array'],
            'type_workflow_public_court' => ['array']
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
