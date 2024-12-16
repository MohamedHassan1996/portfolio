<?php

namespace App\Http\Requests\Product\ProductCategory;

use App\Enums\Product\ProductCategoryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;


class UpdateProductCategoryRequest extends FormRequest
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
            'productCategoryId' => 'required',
            'nameEn' =>['required', Rule::unique('product_category_translations', 'name')
            ->ignore($this->productCategoryId, 'product_category_id')->where('locale', 'en')],
            'nameAr' => ['required', Rule::unique('product_category_translations', 'name')
            ->ignore($this->productCategoryId, 'product_category_id')->where('locale', 'ar')],
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
