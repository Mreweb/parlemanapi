<?php

namespace App\Http\Requests\ElectionLocation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ElectionLocationRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
             'election_location_title' => ['required'],
            'election_location_province_id' => ['required'],
            'election_location_cities' => ['required']
        ];
    }
    public function messages(): array{
        return [
            'election_location_title.required' => 'عنوان حوزه انتخابیه الزامی است',
            'election_location_province_id.required' => 'استان حوزه انتخابیه الزامی است',
            'election_location_cities.required' => 'شهرهای حوزه انتخابیه الزامی است',
        ];
    }
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "class"=> "red",
            "type"=> "Service.Error",
            'success' => false,
            'message' => 'لطفا موارد الزامی را تکمیل کنید',
            'errors' => $validator->errors()
        ], 422));
    }
}
