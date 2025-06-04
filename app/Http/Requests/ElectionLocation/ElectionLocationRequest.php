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
             'election_location_title' => ['required', 'string'  , 'max:255' , 'min:3'],
            'election_location_province_id' => ['required' , 'integer'],
            'election_location_cities' => ['required', 'array'],
        ];
    }
    public function messages(): array{
        return [
            'election_location_title.required' => 'عنوان حوزه انتخابیه الزامی است',
            'election_location_title.min' => 'نام حوزه انتخابیه باید بیشتر از 3 کاراکتر باشد',
            'election_location_title.max' => 'نام حوزه انتخابیه باید کمتر از 255 کاراکتر باشد',
            'election_location_province_id.required' => 'استان حوزه انتخابیه الزامی است',
            'election_location_cities.required' => 'شهرهای حوزه انتخابیه الزامی است',
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
