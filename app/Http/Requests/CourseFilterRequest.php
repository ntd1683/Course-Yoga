<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'numeric', 'min:1', 'max:250'],
            'filter' => ['nullable', 'numeric', 'min:-1', 'max:3'],
            'q' => ['nullable', 'string'],
            'user' => ['nullable', Rule::in([1,0])],
        ];
    }
}
