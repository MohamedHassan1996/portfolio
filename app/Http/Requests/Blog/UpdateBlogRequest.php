<?php

namespace App\Http\Requests\Blog;

use App\Enums\Blog\BlogStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateBlogRequest extends FormRequest
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
            'blogId' => 'required',
            'titleEn' => ['required', Rule::unique('blog_translations', 'title')
            ->ignore($this->blogId, 'blog_id')
            ->where('locale', 'en')],
            'titleAr' => ['required', Rule::unique('blog_translations', 'title')
            ->ignore($this->blogId, 'blog_id')
            ->where('locale', 'ar')],
            'slugEn' => ['required'],
            'slugAr' => ['required'],
            'descriptionEn' => 'required',
            'descriptionAr' => 'required',
            'contentEn' => ['required'],
            'contentAr' => ['required'],
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
