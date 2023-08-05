<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->level === 2;
    }

    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string'],
            'site_description' => ['required', 'string'],
            'site_logo' => [
                'nullable',
                'image',
                File::types(['jpg', 'png', 'jpeg'])->max(1024 * 30),
            ],
            'site_favicon' => [
                'nullable',
                'image',
                File::types(['jpg', 'png', 'jpeg'])->max(1024 * 30),
            ],
            'site_language' => ['nullable', 'string'],
            'site_phone' => ['nullable', 'string'],
            'site_email' => ['nullable', 'string'],
            'site_address' => ['nullable', 'string'],
        ];
    }
}
