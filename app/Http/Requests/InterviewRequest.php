<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'scheduled_at' => 'required|date|after:now',
            'type' => 'required|in:phone,video,in-person',
            'location' => 'required_if:type,in-person|string|max:255',
            'notes' => 'nullable|string|max:1000'
        ];
    }
} 