<?php

namespace App\Http\Requests\TripDeputyGovernor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TripDeputyGovernorUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'trip_id' => ['required'],
            'trip_president_id' => ['required'],
            'trip_person_id' => ['required'],
            'trip_gov_period_id' => ['required'],
            'trip_parliament_period_id' => ['required'],
            'trip_start_date' => ['required'],
            'trip_end_date' => ['required'],
            'trip_province_id' => ['required'],
            'trip_description' => ['required'],
            'trip_subject' => ['required'],
            'person_trip_board_person_ids' => ['array']
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
