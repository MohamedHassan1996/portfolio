<?php

namespace App\Http\Requests\FrontPage;

use App\Enums\FrontPage\FrontPageStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;


class CreateFrontPageRequest extends FormRequest
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
            'titleEn' => ['required', 'unique:front_page_translations,title,NULL,id,locale,en'],
            'titleAr' => ['required', 'unique:front_page_translations,title,NULL,id,locale,ar'],
            'slugEn' => ['required'],
            'slugAr' => ['required'],
            'metaDataEn' => ['nullable'],
            'metaDataAr' => ['nullable'],
            'isActive' => ['required', new Enum(FrontPageStatus::class)],
        ];


    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }
}
