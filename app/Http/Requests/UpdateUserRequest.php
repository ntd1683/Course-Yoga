<?php

namespace App\Http\Requests;

use App\Enums\UserLevelEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'address' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class, 'email')->ignore($this->user->id)],
            'level' => [
                'required',
                Rule::in(UserLevelEnum::getValues()),
            ],
        ];
    }
}
