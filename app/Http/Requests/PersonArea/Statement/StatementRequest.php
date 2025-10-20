<?php

namespace App\Http\Requests\PersonArea\Statement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StatementRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'statement_person_id' => ['required'],
            'statement_president_id' => ['required'],
            'statement_gov_period_id' => ['required'],
            'statement_parliament_period_id' => ['required'],
            'statement_meeting' => ['required'],
            'statement_type' => ['required'],
            'statement_reading_date' => ['required'],
            'statement_public_court_reading_date' => ['required'],
            'statement_register_number' => ['required'],
            'statement_session_number' => ['required'],
            'statement_subject' => ['required'],
            'statement_summary' => ['required'],
            'statement_worksheet_media_id' => ['required'],
            'statement_to_person_id' => ['required'],
            'statement_ministry_id' => ['required'],
            'statement_designer_person_id' => ['required'],
            'statement_to_person_actions' => ['required'],
            'statement_signature_person_ids' => ['array'],
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
