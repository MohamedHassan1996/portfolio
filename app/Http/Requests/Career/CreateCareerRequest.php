<?php

namespace App\Http\Requests\Career;

use App\Enums\Blog\BlogStatus;
use App\Enums\Career\CareerStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;


class CreateCareerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'titleEn' => ['required', 'unique:career_translations,title,NULL,id,locale,en'],
            'titleAr' => ['required', 'unique:career_translations,title,NULL,id,locale,ar'],
            'descriptionEn' => ['required'],
            'descriptionAr' => ['required'],
            'contentEn' => ['required'],
            'contentAr' => ['required'],
            'metaDataAr' => ['nullable'],
            'metaDataEn' => ['nullable'],
            'isActive' => ['required', new Enum(CareerStatus::class)]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }
}