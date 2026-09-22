<?php

namespace App\Http\Requests;

use App\Models\SchoolClass;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassRequest extends FormRequest
{
    public function rules(): array
    {
        $class = $this->route('schoolClass');

        return [
            'institution_id' => ['required', 'exists:institutions,id'],
            'academic_session_id' => ['required', 'exists:academic_sessions,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', Rule::unique('school_classes', 'code')->ignore($class)],
            'numeric_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
            'status' => ['nullable', 'string', Rule::in(SchoolClass::statuses())],
        ];
    }

    public function messages(): array
    {
        return [
            'institution_id.required' => 'Please select an institution.',
            'institution_id.exists' => 'The selected institution is invalid.',
            'academic_session_id.required' => 'Please select an academic session.',
            'academic_session_id.exists' => 'The selected academic session is invalid.',
            'name.required' => 'The class name is required.',
            'name.max' => 'The class name must not exceed 255 characters.',
            'code.unique' => 'This class code is already used in this institution and session.',
            'numeric_order.integer' => 'The numeric order must be a whole number.',
            'numeric_order.min' => 'The numeric order must be at least 0.',
            'numeric_order.max' => 'The numeric order must not exceed 65535.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
