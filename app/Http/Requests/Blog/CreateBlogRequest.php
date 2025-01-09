<?php

namespace App\Http\Requests\Blog;

use App\Enums\Blog\BlogStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;


class CreateBlogRequest extends FormRequest
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
            'titleEn' => ['required', 'unique:blog_translations,title,NULL,id,locale,en'],
            'titleAr' => ['required', 'unique:blog_translations,title,NULL,id,locale,ar'],
            'slugEn' => ['required'],
            'slugAr' => ['required'],
            'descriptionEn' => ['required'],
            'descriptionAr' => ['required'],
            'contentEn' => ['nullable'],
            'contentAr' => ['nullable'],
            'thumbnail' => ['nullable'],
            'categoryId' => ['required'],
            'metaDataAr' => ['nullable'],
            'metaDataEn' => ['nullable'],
            'isPublished' => ['required', new Enum(BlogStatus::class)]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }
}
