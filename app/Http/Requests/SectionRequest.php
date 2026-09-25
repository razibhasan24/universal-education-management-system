<?php

namespace App\Http\Requests;

use App\Models\Section;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
{
    public function rules(): array
    {
        $section = $this->route('section');

        return [
            'institution_id' => ['required', 'exists:institutions,id'],
            'class_id' => ['required', 'exists:school_classes,id'],
            'name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:0', 'max:65535'],
            'status' => ['nullable', 'string', Rule::in(Section::statuses())],
        ];
    }

    public function messages(): array
    {
        return [
            'institution_id.required' => 'Please select an institution.',
            'institution_id.exists' => 'The selected institution is invalid.',
            'class_id.required' => 'Please select a class.',
            'class_id.exists' => 'The selected class is invalid.',
            'name.required' => 'The section name is required.',
            'name.max' => 'The section name must not exceed 255 characters.',
            'capacity.required' => 'The capacity is required.',
            'capacity.integer' => 'The capacity must be a whole number.',
            'capacity.min' => 'The capacity must be at least 0.',
            'capacity.max' => 'The capacity must not exceed 65535.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
