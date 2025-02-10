<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserActivityLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'activity_type' => ['required', 'in:job_view,application_submitted,profile_update'],
            'description' => ['required', 'string', 'max:500'],
            'activity_data' => ['nullable', 'array'],
            'timestamp' => ['required', 'date']
        ];
    }
} 