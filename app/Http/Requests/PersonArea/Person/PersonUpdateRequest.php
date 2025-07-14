<?php

namespace App\Http\Requests\Person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PersonUpdateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }


    public function rules(): array{
        return [
            'person_id' => ['required'],
            'person_name' => ['required', 'string'  , 'max:255' , 'min:3'],
            'person_last_name' => ['required', 'string'  , 'max:255' , 'min:3'],
            'person_national_code' => ['required', 'string'  , 'max:10' , 'min:10'],
            'person_phone' => ['required', 'string'  , 'max:12' , 'min:10'],
            'person_gender' => ['required', 'string'],
            'person_province_id' => ['required'],
            'person_image' => [''],
            'person_role' => ['required'],
            'username' => ['required', 'string'  , 'max:50' , 'min:3'],
            'password' => [ '']
        ];
    }

    public function messages(): array{
        return [
            'person_name.required' => 'نام الزامی است',
            'person_last_name.required' => 'نام خانوادگی الزامی است',
            'person_national_code.required' => 'کد ملی الزامی است',
            'person_phone.required' => 'تلفن همراه الزامی است',
            'person_gender.required' => 'جنسیت الزامی است',
            'person_province_id.required' => 'شناسه استان الزامی است',
            'username.required' => 'نام کاربری الزامی است',
            'password.required' => 'رمز عبور الزامی است',
            'person_image.required' => 'تصویر کاربر الزامی است',

            'person_name.min' => 'نام  باید بیشتر از 3 کاراکتر باشد',
            'person_name.max' => 'نام  باید کمتر از 255 کاراکتر باشد',

            'person_phone.min' => 'تلفن همراه باید بیشتر از 3 کاراکتر باشد',
            'person_phone.max' => 'تلفن همراه باید کمتر از 255 کاراکتر باشد',

            'person_last_name.min' => 'نام خانوادگی باید بیشتر از 3 کاراکتر باشد',
            'person_last_name.max' => 'نام خانوادگی باید کمتر از 255 کاراکتر باشد',
            'person_national_code.min' => 'کد ملی باید  برابر 10 کاراکتر باشد',
            'person_national_code.max' => 'کد ملی باید برابر 10 کاراکتر باشد',
            'username.min' => 'نام کاربری باید بیشتر از 3 کاراکتر باشد',
            'username.max' => 'نام کاربری باید کمتر از 50 کاراکتر باشد',
            'password.min' => 'رمز عبور باید بیشتر از 3 کاراکتر باشد',
            'password.max' => 'رمز عبور باید کمتر از 50 کاراکتر باشد'

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
