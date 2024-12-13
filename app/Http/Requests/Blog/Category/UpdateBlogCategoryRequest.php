<?php

namespace App\Http\Requests\Blog\Category;

use App\Enums\Blog\BlogCategoryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateBlogCategoryRequest extends FormRequest
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
            'blogCategoryId' => 'required',
            'nameEn' => ['required', Rule::unique('blog_category_translations', 'name')
            ->ignore($this->blogCategoryId, 'blog_category_id')
            ->where('locale', 'en')],
            'nameAr' => ['required', Rule::unique('blog_category_translations', 'name')
            ->ignore($this->blogCategoryId, 'blog_category_id')
            ->where('locale', 'ar')],
            'slug' => ['required'],
            'description' => ['required'],
            'isActive' => ['required', new Enum(BlogCategoryStatus::class)]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }

}