<?php

namespace App\Http\Requests\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuestionUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'question_id' => ['required'],
            'question_person_id' => ['required'],
            'question_president_id' => ['required'],
            'question_gov_period_id' => ['required'],
            'question_parliament_period_id' => ['required'],
            'question_meeting' => ['required'],
            'question_reading_date' => ['required'],
            'question_register_number' => ['required'],
            'question_subject' => ['required'],
            'question_summary' => ['required'],
            'question_worksheet_media_id' => ['required'],
            'question_to_person_id' => ['required'],
            'question_commission_id' => ['required'],
            'question_commission_session_date' => ['required'],
            'question_commission_session_result' => ['required'],
            'question_commission_receipt_date' => ['required'],
            'question_check_public_parliament_date' => ['required'],
            'question_check_public_parliament_number' => ['required'],
            'question_check_public_parliament_result' => ['required'],
            'question_check_public_parliament_ministry_id' => ['required'],
            'question_answer_media_id' => ['required'],
            'question_to_person_actions' => ['required'],
            'question_signature_person_ids' => ['array'],
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
