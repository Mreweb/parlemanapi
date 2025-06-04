<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{

        $allowedExtensions = config('upload.allowed_extensions');
        $maxSize = config('upload.max_size');

        return [
            'file' => [ 'required',  'file',  'mimes:' . implode(',', $allowedExtensions),  'max:' . $maxSize ]
        ];
    }

    public function messages(): array
    {
        $maxSize = config('upload.max_size');
        return [
            'file.required' => 'فایل الزامی است',
            'file.mimes' => 'پسوند فایل نامعتبر است',
            'file.max' => 'اندازه فایل باید کمتر از '. $maxSize. ' کیلوبایت باشد',
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
