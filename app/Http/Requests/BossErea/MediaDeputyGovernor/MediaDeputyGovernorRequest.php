<?php

namespace App\Http\Requests\MediaDeputyGovernor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MediaDeputyGovernorRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'media_president_id' => ['required'],
            'media_person_id' => ['required'],
            'media_gov_period_id' => ['required'],
            'media_parliament_period_id' => ['required'],
            'media_start_date' => ['required'],
            'media_end_date' => ['required'],
            'media_province_id' => ['required'],
            'media_description' => ['required'],
            'media_subject' => ['required'],
            'person_media_board_person_ids' => ['array']
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
