<?php

namespace App\Http\Requests\Notice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NoticeUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'notice_id' => ['required'],
            'notice_person_id' => ['required'],
            'notice_president_id' => ['required'],
            'notice_gov_period_id' => ['required'],
            'notice_parliament_period_id' => ['required'],
            'notice_meeting' => ['required'],
            'notice_type' => ['required'],
            'notice_reading_date' => ['required'],
            'notice_register_number' => ['required'],
            'notice_session_number' => ['required'],
            'notice_subject' => ['required'],
            'notice_summary' => ['required'],
            'notice_worksheet_media_id' => ['required'],
            'notice_to_person_id' => ['required'],
            'notice_ministry_id' => ['required'],
            'notice_designer_person_id' => ['required'],
            'notice_designer_person_election_id' => ['required'],
            'notice_answer_media_id' => ['required'],
            'notice_to_person_actions' => ['required'],
            'notice_signature_person_ids' => ['array'],
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
