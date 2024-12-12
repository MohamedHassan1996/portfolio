<?php

namespace App\Http\Requests\Event;

use App\Enums\Blog\BlogStatus;
use App\Enums\Event\EventStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;


class CreateEventRequest extends FormRequest
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
            'titleEn' => ['required', 'unique:event_translations,title,NULL,id,locale,en'],
            'titleAr' => ['required', 'unique:event_translations,title,NULL,id,locale,ar'],
            'descriptionEn' => ['required'],
            'descriptionAr' => ['required'],
            'slugEn' => ['required'],
            'slugAr' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'location' => ['required'],
            'metaDataEn' => ['nullable'],
            'metaDataAr' => ['nullable'],
            'thumbnail' => ['nullable'],
            'isPublished' => ['required', new Enum(EventStatus::class)],
        ];


    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }
}
