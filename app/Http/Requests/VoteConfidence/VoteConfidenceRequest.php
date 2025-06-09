<?php

namespace App\Http\Requests\VoteConfidence;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VoteConfidenceRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'vote_confidence_person_id' => ['required'],
            'vote_confidence_president_id' => ['required'],
            'vote_confidence_gov_period_id' => ['required'],
            'vote_confidence_parliament_period_id' => ['required'],
            'vote_confidence_meeting' => ['required'],
            'vote_confidence_register_number' => ['required'],
            'vote_confidence_commission_id' => ['required'],
            'vote_confidence_commission_meeting_date' => ['required'],
            'vote_confidence_commission_report' => ['required'],
            'vote_confidence_public_court_date' => ['required'],
            'vote_confidence_public_parliament_session_number' => ['required'],
            'vote_confidence_public_parliament_check_result' => ['required'],
            'vote_confidence_ministry_person_name' => ['required'],
            'vote_confidence_ministry_id' => ['required'],
            'vote_confidence_action_summary' => ['required'],
            'vote_confidence_president_contents_summary' => ['required'],
            'vote_confidence_contents_summary' => ['required'],
            'vote_confidence_supporters_summary' => ['required'],
            'vote_confidence_opposing_summary' => ['required'],
            'vote_confidence_opposing_person_ids' => ['array'],
            'vote_confidence_supporters_person_ids' => ['array']
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
