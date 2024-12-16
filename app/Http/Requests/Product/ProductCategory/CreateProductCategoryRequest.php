<?php

namespace App\Http\Requests\Product\ProductCategory;

use App\Enums\Product\ProductCategoryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;


class CreateProductCategoryRequest extends FormRequest
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
            'nameEn' => ['required', 'unique:product_category_translations,name,NULL,id,locale,en'],
            'nameAr' => ['required', 'unique:product_category_translations,name,NULL,id,locale,ar'],
            'isActive' => ['required', new Enum(ProductCategoryStatus::class)],
            'image' => ['nullable'],
        ];


    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }
}
