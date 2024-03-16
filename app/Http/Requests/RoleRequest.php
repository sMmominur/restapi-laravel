<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponseFormatTrait;

class RoleRequest extends FormRequest
{
    use ApiResponseFormatTrait;
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
        $rules = [
            'name'        => 'required|string|max:30',
            'status'      => 'required|in:active,inactive,deleted',
            'description' => 'required|string|max:100'
        ];

        $requetMethod = $this->getMethod();
        if ($requetMethod !== 'PUT' && $requetMethod !== 'PATCH') {
            $rules['name'] .= '|unique:roles';
        }

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'       => 'The role name field is required.',
            'name.string'         => 'The role name field must be a string.',
            'name.max'            => 'The role name field may not be greater than 30 characters.',
            'name.unique'         => 'The role name has already been taken.',
            'status.required'     => 'The status field is required.',
            'status.in'           => 'The selected status is invalid.Use active or inactive',
            'description.required' => 'The role description field is required.',
            'description.string'  => 'The role description field must be a string.',
            'description.max'     => 'The role description field may not be greater than 100 characters.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // Generate slug from the 'name' field and replace spaces with hyphens
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws Illuminate\Http\Exceptions\HttpResponseException
     */

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($this->validationFailedResponse($validator->errors()), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
