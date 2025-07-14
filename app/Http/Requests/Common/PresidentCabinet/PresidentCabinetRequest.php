<?php

namespace App\Http\Requests\PresidentCabinet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PresidentCabinetRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'president_id' => ['required'],
            'cabinet' => ['required'],
            'cabinet_person_id' => ['required']
        ];
    }
    public function messages(): array{
        return [
            'president_id.required' => 'شناسه رئیس جمهور الزامی است',
            'cabinet.required' => 'سمت کابینه رئیس جمهور الزامی است',
            'cabinet_person_id.required' => 'شناسه فرد الزامی است',
        ];
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
