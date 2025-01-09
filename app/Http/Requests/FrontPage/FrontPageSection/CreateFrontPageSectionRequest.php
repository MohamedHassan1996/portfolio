<?php

namespace App\Http\Requests\FrontPage\FrontPageSection;

use App\Enums\FrontPage\FrontPageSectionStatus;
use App\Enums\FrontPage\FrontPageStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;


class CreateFrontPageSectionRequest extends FormRequest
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
            'name' => ['required', 'unique:front_page_sections,name'],
            'contentEn' => ['required'],
            'contentAr' => ['required'],
            'isActive' => ['required', new Enum(FrontPageSectionStatus::class)],
        ];


    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }
}
