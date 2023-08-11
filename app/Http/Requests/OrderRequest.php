<?php

namespace App\Http\Requests;

use App\Models\Course;
use App\Models\Discount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'phone' => ['required', 'string'],
            'type' => ['required', 'integer'],
            'email' => ['required', 'email'],
            'referral_code' => ['nullable', 'string'],
            'discount' => [
                'nullable',
                Rule::exists(Discount::class, 'id')
            ],
        ];
    }
}
