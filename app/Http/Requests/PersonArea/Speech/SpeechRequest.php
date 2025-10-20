<?php

namespace App\Http\Requests\PersonArea\Speech;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SpeechRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'speech_person_id' => ['required'],
            'speech_president_id' => ['required'],
            'speech_gov_period_id' => ['required'],
            'speech_parliament_period_id' => ['required'],
            'speech_meeting' => ['required'],
            'speech_type' => ['required'],
            'speech_reading_date' => ['required'],
            'speech_public_court_reading_date' => ['required'],
            'speech_register_number' => ['required'],
            'speech_session_number' => ['required'],
            'speech_subject' => ['required'],
            'speech_summary' => ['required'],
            'speech_worksheet_media_id' => ['required'],
            'speech_to_person_id' => ['required'],
            'speech_ministry_id' => ['required'],
            'speech_designer_person_id' => ['required'],
            'speech_to_person_actions' => ['required'],
            'speech_signature_person_ids' => ['array'],
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
