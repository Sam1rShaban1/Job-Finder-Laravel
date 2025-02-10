<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'education' => ['required', 'array'],
            'education.*.institution' => ['required', 'string', 'max:255'],
            'education.*.degree' => ['required', 'string', 'max:255'],
            'education.*.field_of_study' => ['required', 'string', 'max:255'],
            'education.*.start_date' => ['required', 'date'],
            'education.*.end_date' => ['nullable', 'date', 'after:education.*.start_date']
        ];
    }
} 