<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportSheetCoursesRequest extends FormRequest
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
            'sheet' => ['required', 'string'],
            'sheet_tab_name' => ['required', 'string'],
            'name_title' => ['required', 'string'],
            'name_description' => ['required', 'string'],
            'name_link_embedded' => ['required', 'string'],
            'name_type' => ['required', 'string'],
            'name_price' => ['required', 'string'],
            'name_image' => ['required', 'string'],
            'name_view' => ['required', 'string'],
        ];
    }
}
