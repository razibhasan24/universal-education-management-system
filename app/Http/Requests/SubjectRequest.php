<?php

namespace App\Http\Requests;

use App\Models\Subject;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubjectRequest extends FormRequest
{
    public function rules(): array
    {
        $subject = $this->route('subject');

        return [
            'institution_id' => ['required', 'exists:institutions,id'],
            'class_id' => ['required', 'exists:school_classes,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', Rule::unique('subjects', 'code')->ignore($subject)],
            'full_marks' => ['required', 'integer', 'min:1', 'max:65535'],
            'pass_marks' => ['required', 'integer', 'min:0', 'max:65535', 'lte:full_marks'],
            'subject_type' => ['required', 'string', Rule::in(Subject::types())],
            'status' => ['nullable', 'string', Rule::in(Subject::statuses())],
        ];
    }

    public function messages(): array
    {
        return [
            'institution_id.required' => 'Please select an institution.',
            'institution_id.exists' => 'The selected institution is invalid.',
            'class_id.required' => 'Please select a class.',
            'class_id.exists' => 'The selected class is invalid.',
            'name.required' => 'The subject name is required.',
            'name.max' => 'The subject name must not exceed 255 characters.',
            'code.unique' => 'This subject code is already used in this class.',
            'full_marks.required' => 'The full marks are required.',
            'full_marks.integer' => 'The full marks must be a whole number.',
            'full_marks.min' => 'The full marks must be at least 1.',
            'full_marks.max' => 'The full marks must not exceed 65535.',
            'pass_marks.required' => 'The pass marks are required.',
            'pass_marks.integer' => 'The pass marks must be a whole number.',
            'pass_marks.min' => 'The pass marks must be at least 0.',
            'pass_marks.max' => 'The pass marks must not exceed 65535.',
            'pass_marks.lte' => 'The pass marks must be less than or equal to the full marks.',
            'subject_type.required' => 'Please select a subject type.',
            'subject_type.in' => 'The selected subject type is invalid.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
