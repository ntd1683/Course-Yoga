<?php

namespace App\Http\Requests;

use App\Enums\CourseTypeEnum;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreCourseRequest extends FormRequest
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
            'title' => ['required', 'string', Rule::unique(Course::class, 'title')],
            'description' => ['required','string'],
            'link_embedded' => ['nullable', 'string'],
            'type' => [Rule::in(CourseTypeEnum::asArray())],
            'price' => ['nullable', 'string'],
            'image' => [
                'nullable',
                'image',
                File::types(['jpg', 'png', 'jpeg'])->max(1024 * 30),
            ],
            'view' => ['nullable', 'integer'],
        ];
    }
}
