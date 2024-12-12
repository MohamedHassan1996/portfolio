<?php

namespace App\Http\Requests\Faq;

use App\Enums\Faq\FaqStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;


class CreateFaqRequest extends FormRequest
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
            'questionEn' => ['required', 'unique:faq_translations,question,NULL,id,locale,en'],
            'questionAr' => ['required', 'unique:faq_translations,question,NULL,id,locale,ar'],
            'answerEn' => ['required'],
            'answerAr' => ['required'],
            'isPublished' => ['required', new Enum(FaqStatus::class)],
            'order' => ['required']
        ];


    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }
}
