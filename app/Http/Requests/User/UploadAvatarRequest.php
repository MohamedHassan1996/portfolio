<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UploadAvatarRequest extends FormRequest
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
            'avatar' => ["sometimes", "required", "image", "mimes:jpeg,jpg,png,gif", "max:2048"],
            //'uploadPath' => '',
        ];
    }

/*public function rules(): array
{
    $rules = [
        'avatar' => [
            'sometimes',
            'required',
            'mimes:jpeg,jpg,png,gif',
            'max:2048',
        ],
        'uploadPath' => '',
    ];

    if ($this->isMethod('post')) {
        // For POST requests, enforce the 'image' rule
        $rules['avatar'][] = 'image';
    } elseif ($this->isMethod('put')) {
        // For PUT requests, allow either 'string' or 'image'
        $rules['avatar'][] = Rule::in(['string', 'image']);
    }

        return $rules;
    }*/


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()
        ], 401));
    }

    /*public function prepareForValidation(): void
    {
        $this->merge([
            'file' => $this->file('avatar'),
            'uploadPath' => $this->uploadPath,
            'oldUploadPath' => $this->oldUploadPath
        ]);
    }*/

   /*public function validated($key = null, $default = null)
    {

        return array_merge(parent::validated(),[
            'file' => $this->file('avatar'),
            'yttttt' => $this->uploadPath,
        ]);
    }*/

}
