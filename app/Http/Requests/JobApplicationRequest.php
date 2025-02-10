<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('apply', $this->route('job'));
    }

    public function rules(): array
    {
        return [
            'cover_letter' => ['required', 'string', 'max:2000'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048']
        ];
    }
} 