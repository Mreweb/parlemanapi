<?php

namespace App\Http\Requests\Interpellations;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InterpellationUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'interpellation_id' => ['required'],
            'interpellation_president_id' => ['required'],
            'interpellation_person_id' => ['required'],
            'interpellation_gov_period_id' => ['required'],
            'interpellation_parliament_period_id' => ['required'],
            'interpellation_meeting' => ['required'],
            'interpellation_register_number' => ['required'],
            'interpellation_axis' => ['required'],
            'interpellation_summary' => ['required'],
            'interpellation_worksheet_media_id' => ['required'],
            'interpellation_correspondence_worksheet_media_id' => ['required'],
            'interpellation_commission_id' => ['required'],
            'interpellation_commission_meeting_date' => ['required'],
            'interpellation_commission_result' => ['required'],
            'interpellation_receipt_date' => ['required'],
            'interpellation_public_court_date' => ['required'],
            'interpellation_public_parliament_session_number' => ['required'],
            'interpellation_public_parliament_check_result' => ['required'],
            'interpellation_parliament_correspondence' => ['required'],
            'interpellation_audience' => ['required'],
            'interpellation_designer' => ['required'],
            'interpellation_action_summary' => ['required'],
            'interpellation_contents_summary' => ['required'],
            'interpellation_president_contents_summary' => ['required'],
            'interpellation_supporters_contents_summary' => ['required'],
            'interpellation_opponents_contents_summary' => ['required'],
            'interpellation_governors_opinion' => ['required'],
            'interpellation_governors_actions' => ['required'],
            'interpellation_deputies_actions' => ['required'],
            'interpellations_opposing_person_ids' => ['array'],
            'interpellation_supporters_person_ids' => ['array'],
            'interpellation_opt_person_ids' => ['array'],
            'interpellation_return_opt_person_ids' => ['array'],
            'interpellation_signatures_person_ids' => ['array']
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
