<?php

namespace App\Http\Requests\Projects;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProjectsRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'project_title' => ['required'],
            'project_register_number' => ['required'],
            'project_create_date' => ['required'],
            'project_priority' => ['required'],
            'project_handle_way' => ['required'],
            'project_topic_relevance' => ['required'],
            'project_government_vote' => ['required'],
            'project_status' => ['required'],
            'project_end_date' => ['required'],
            'project_person_id' => ['required'],
            'project_president_id' => ['required'],
            'project_gov_period_id' => ['required'],
            'project_parliament_period_id' => ['required'],
            'person_projects_participation_ids' => ['array'],
            'person_projects_related_commission_ids' => ['array'],
            'person_projects_special_commission_ids' => ['array']
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
