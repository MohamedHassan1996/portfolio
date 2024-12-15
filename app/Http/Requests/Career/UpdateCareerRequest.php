<?php

namespace App\Http\Requests\Career;

use App\Enums\Career\CareerStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateCareerRequest extends FormRequest
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
            'careerId' => 'required',
            'titleEn' => ['required', Rule::unique('career_translations', 'title')
            ->ignore($this->careerId, 'career_id')
            ->where('locale', 'en')],
            'titleAr' => ['required', Rule::unique('career_translations', 'title')
            ->ignore($this->careerId, 'career_id')
            ->where('locale', 'ar')],
            'descriptionEn' => ['required'],
            'descriptionAr' => ['required'],
            'contentEn' => ['required'],
            'contentAr' => ['required'],
            'metaDataAr' => ['nullable'],
            'metaDataEn' => ['nullable'],
            'extraDetailsAr' => ['nullable'],
            'extraDetailsEn' => ['nullable'],
            'slugAr' => ['nullable'],
            'slugEn' => ['nullable'],
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
