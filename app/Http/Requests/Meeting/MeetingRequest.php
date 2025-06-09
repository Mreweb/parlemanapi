<?php

namespace App\Http\Requests\Meeting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MeetingRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'meeting_title' => ['required'],
            'meeting_description' => ['required'],
            'meeting_status' => ['required'],
            'meeting_end_date' => ['required'],
            'meeting_tasks' => ['required'],
            'meeting_person_id' => ['required'],
            'meeting_president_id' => ['required'],
            'meeting_gov_period_id' => ['required'],
            'meeting_parliament_period_id' => ['required']
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
