<?php

namespace App\Http\Requests\Meeting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MeetingTrackRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'meeting_track_meeting_id' => ['required'],
            'meeting_track_description' => ['required']
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
