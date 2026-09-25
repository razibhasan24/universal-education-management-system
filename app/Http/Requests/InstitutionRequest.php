<?php

namespace App\Http\Requests;

use App\Models\Institution;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstitutionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'institution_type' => ['required', 'string', Rule::in(Institution::types())],
            'code' => ['nullable', 'string', 'max:50', Rule::unique('institutions', 'code')->ignore($this->route('institution'))],
            'eiin' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:1000'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'status' => ['nullable', 'string', Rule::in(Institution::statuses())],
        ];
    }
}
