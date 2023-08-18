<?php

namespace App\Http\Requests;

use App\Enums\UserLevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->level >= 2;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'gender' => ['required', Rule::in([0,1])],
            'birthdate' => ['nullable', 'date'],
            'phone' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'address' => ['required', 'string'],
            'level' => [
                'required',
                Rule::in(UserLevelEnum::getValues()),
            ],
        ];
    }
}
