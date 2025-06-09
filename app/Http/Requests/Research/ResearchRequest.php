<?php

namespace App\Http\Requests\Research;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResearchRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'person_research_president_id' => ['required'],
            'person_research_person_id' => ['required'],
            'person_research_gov_period_id' => ['required'],
            'person_research_parliament_period_id' => ['required'],
            'person_research_meeting' => ['required'],
            'person_research_register_number' => ['required'],
            'person_research_register_date' => ['required'],
            'person_research_subject' => ['required'],
            'person_research_summary' => ['required'],
            'person_research_worksheet_media_id' => ['required'],
            'person_research_commission_id' => ['required'],
            'person_research_commission_result' => ['required'],
            'person_research_commission_number' => ['required'],
            'person_research_public_court_date' => ['required'],
            'person_research_public_court_result' => ['required'],
            'person_research_team_result' => ['required'],
            'person_research_team_result_ministry_id' => ['required'],
            'person_research_contents_summary' => ['required'],
            'person_research_team_person_ids' => ['array'],
            'person_research_signatures_person_ids' => ['array'],
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
