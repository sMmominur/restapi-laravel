<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponseFormatTrait;

class IpRequest extends FormRequest
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
            'ip_address' => 'required|string|max:40',
            'status'     => 'required|in:active,inactive',
            'ip_type'    => 'required|in:IPv4,IPv6',
            'remarks'    => 'required|string|max:50'
        ];

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
            'ip_address.required' => 'IP address field is required.',
            'ip_address.string'   => 'IP address field must be a string.',
            'ip_address.max'      => 'IP address field may not be greater than 40 characters.',
            'status.required'     => 'The status field is required.',
            'status.in'           => 'The selected status is invalid.Use active or inactive',
            'ip_type.required'    => 'IP type field is required.',
            'ip_type.in'          => 'The selected IP type is invalid.Use IPv4 or IPv6',
            'remarks.required'    => 'The remarks field is required.',
            'remarks.string'      => 'The remarks field must be a string.',
            'remarks.max'         => 'The remarks field may not be greater than 50 characters.',
        ];
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
