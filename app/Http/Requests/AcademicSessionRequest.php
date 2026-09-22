<?php

namespace App\Http\Requests;

use App\Models\AcademicSession;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AcademicSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'institution_id' => ['required', 'exists:institutions,id'],
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['nullable', 'string', Rule::in(AcademicSession::statuses())],
        ];
    }

    public function messages(): array
    {
        return [
            'institution_id.required' => 'Please select an institution.',
            'institution_id.exists' => 'The selected institution is invalid.',
            'name.required' => 'The session name is required.',
            'name.max' => 'The session name must not exceed 255 characters.',
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}
